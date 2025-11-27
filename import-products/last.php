<?php
/**
 * Optimized WooCommerce Product Importer (Option B - single file)
 *
 * Instructions:
 *  - Place this file in a web-accessible folder inside your WP install (or adjust paths accordingly).
 *  - Ensure PhpSpreadsheet is available (composer autoload or vendor path).
 *  - Access via browser: importer.php?page=1
 *
 * Key improvements:
 *  - Unlimited execution time & increased memory
 *  - Increased HTTP timeouts (WordPress Requests/CURL)
 *  - More reliable attachment checks + transient caching
 *  - Pre-check remote image size/content-type and skip huge files
 *  - Retry logic for image downloads
 *  - Uses wp_remote_get + media_handle_sideload for safer uploads
 *
 * NOTE: Test on staging first. Backup your DB before mass imports.
 */

// Load WordPress
require_once __DIR__ . '/../wp-load.php';

// required admin includes for media functions
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

// Composer autoload (PhpSpreadsheet)
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as SpreadsheetException;

/**
 * Environment / Safety settings
 */
@set_time_limit(0);                         // remove execution time limit
@ini_set('max_execution_time', '0');
@ini_set('memory_limit', '2048M');          // increase memory for big spreadsheets/images

// Increase WP HTTP timeout and tweak curl
add_filter('http_request_timeout', function($t) { return 60; }); // seconds
add_filter('http_request_args', function($args) {
    $args['timeout'] = 60;
    // allow redirects
    $args['redirection'] = 5;
    return $args;
});
add_filter('http_api_curl', function($handle) {
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($handle, CURLOPT_TIMEOUT, 60);
    curl_setopt($handle, CURLOPT_FOLLOWLOCATION, true);
});

/**
 * ProductImporter class - optimized
 */
class ProductImporterOptimized {
    private $base_image_url = 'https://zino.ir/Content/Upload/Product/'; // change if needed
    private $batch_size = 500;
    private $max_image_size = 5 * 1024 * 1024; // 5 MB
    private $image_retry = 3;
    private $transient_prefix = 'pi_attachment_cache_';

    public function import_products($excel_file_path, $page = 1) {
        if (!file_exists($excel_file_path)) {
            return $this->result_error("File not found: {$excel_file_path}");
        }

        // Reader: use readDataOnly to speed-up
        try {
            $reader = IOFactory::createReaderForFile($excel_file_path);
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($excel_file_path);
        } catch (SpreadsheetException $e) {
            return $this->result_error('Excel reading error: ' . $e->getMessage());
        }

        $worksheet = $spreadsheet->getActiveSheet();

        // Collect rows lazily to count products and pick the batch
        $headers = [];
        $products_data = [];
        $row_index = 0;
        $product_rows_total = 0;

        foreach ($worksheet->getRowIterator() as $row) {
            $row_index++;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            // header
            if ($row_index == 1) {
                foreach ($cellIterator as $cell) {
                    $headers[] = trim((string)$cell->getValue());
                }
                continue;
            }

            $rowData = [];
            $colIndex = 0;
            foreach ($cellIterator as $cell) {
                if (isset($headers[$colIndex])) {
                    $rowData[$headers[$colIndex]] = $cell->getValue();
                }
                $colIndex++;
            }

            // only rows with SKU ('کد محصول') count
            if (!empty($rowData['کد محصول'])) {
                $product_rows_total++;
                // determine if this row belongs to requested batch
                $start_index = ($page - 1) * $this->batch_size + 1; // 1-based
                $end_index = $page * $this->batch_size;
                if ($product_rows_total >= $start_index && $product_rows_total <= $end_index) {
                    $products_data[] = $rowData;
                }
            }
        }

        $total_products = $product_rows_total;
        $total_pages = (int)ceil($total_products / $this->batch_size);
        $has_more = $page < $total_pages;

        $results = [
            'success' => 0,
            'failed' => 0,
            'errors' => [],
            'page' => $page,
            'total_pages' => $total_pages,
            'total_products' => $total_products,
            'has_more' => $has_more,
            'processed_in_batch' => count($products_data),
        ];

        if (empty($products_data)) {
            $results['errors'][] = "No products found in batch {$page}";
            return $results;
        }

        // Process each product in the batch
        foreach ($products_data as $index => $product_data) {
            $absolute_index = (($page - 1) * $this->batch_size) + $index + 1;
            echo "Processing product {$absolute_index}/{$total_products}: " . esc_html($product_data['نام محصول'] ?? '(no name)') . "<br>";
            flush();

            $import_result = $this->import_single_product($product_data);

            if ($import_result['success']) {
                $results['success']++;
                echo "✓ Success: Product ID " . intval($import_result['product_id']) . " (" . esc_html($import_result['action']) . ")<br>";
            } else {
                $results['failed']++;
                $results['errors'][] = "Product " . ($product_data['نام محصول'] ?? $product_data['کد محصول']) . ": " . $import_result['error'];
                echo "✗ Failed: " . esc_html($import_result['error']) . "<br>";
            }

            echo "<br>";
            flush();
        }

        return $results;
    }

    private function import_single_product($data) {
        try {
            $sku = trim((string)($data['کد محصول'] ?? ''));
            if (empty($sku)) {
                return ['success' => false, 'error' => 'SKU is empty'];
            }

            $existing_product_id = $this->find_product_by_sku($sku);
            if ($existing_product_id) {
                // Skip existing product
                return ['success' => true, 'product_id' => $existing_product_id, 'action' => 'skipped (exists)'];
            }

            // Create new simple product
            $product = new WC_Product_Simple();

            $product->set_name(sanitize_text_field($data['نام محصول'] ?? ''));
            $product->set_sku($sku);

            if (!empty($data['قیمت واحد'])) {
                $product->set_regular_price( (string) floatval($data['قیمت واحد']) );
            }

            $product->set_manage_stock(true);
            $product->set_stock_quantity(intval($data['موجودی'] ?? 0));

            $status = 'publish';
            if (isset($data['متوقف شده']) && (string)$data['متوقف شده'] == '1') {
                $status = 'draft';
            }
            if (isset($data['حذف شده']) && (string)$data['حذف شده'] == '1') {
                $status = 'trash';
            }
            $product->set_status($status);

            // Save product (returns post ID)
            $product_id = $product->save();

            if (!$product_id) {
                return ['success' => false, 'error' => 'Failed to save product'];
            }

            // meta
            $this->add_product_meta($product_id, $data);

            // categories
            $this->handle_product_categories($product_id, $data['دسته بندی'] ?? '');

            // brand (taxonomy product_brand)
            $this->handle_product_brand($product_id, $data['نام برند'] ?? '');

            // Images (safe, optimized)
            if (!empty($data['تصاویر'])) {
                $this->handle_product_images($product_id, $data['تصاویر']);
            } else {
                echo "No images provided for product.<br>";
            }

            return ['success' => true, 'product_id' => $product_id, 'action' => 'created'];

        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Exception: ' . $e->getMessage()];
        }
    }

    private function add_product_meta($product_id, $data) {
        if (!empty($data['شناسه'])) {
            update_post_meta($product_id, '_gtin', sanitize_text_field($data['شناسه']));
        }
        if (!empty($data['نام مستعار'])) {
            update_post_meta($product_id, '_product_alias', sanitize_text_field($data['نام مستعار']));
        }
        if (!empty($data['واحد اصلی'])) {
            update_post_meta($product_id, '_main_unit', sanitize_text_field($data['واحد اصلی']));
        }

        update_post_meta($product_id, '_stock', intval($data['موجودی'] ?? 0));
    }

    private function handle_product_categories($product_id, $category_string) {
        if (empty($category_string)) return;
        // allow comma separated list of categories
        $categories = array_map('trim', explode(',', $category_string));
        $term_ids = [];
        foreach ($categories as $cat) {
            if (empty($cat)) continue;
            $term_id = $this->get_or_create_category($cat);
            if ($term_id) $term_ids[] = intval($term_id);
        }
        if (!empty($term_ids)) {
            wp_set_object_terms($product_id, $term_ids, 'product_cat');
            echo "Categories set: " . esc_html($category_string) . "<br>";
        }
    }

    private function handle_product_brand($product_id, $brand_name) {
        if (empty($brand_name)) return;
        if (!taxonomy_exists('product_brand')) {
            echo "Brand taxonomy 'product_brand' does not exist, skipping brand.<br>";
            return;
        }
        $term_id = $this->get_or_create_brand($brand_name);
        if ($term_id) {
            wp_set_object_terms($product_id, [$term_id], 'product_brand');
            echo "Brand set: " . esc_html($brand_name) . "<br>";
        }
    }

    private function get_or_create_category($name) {
        $exists = term_exists($name, 'product_cat');
        if ($exists && isset($exists['term_id'])) return $exists['term_id'];

        $insert = wp_insert_term($name, 'product_cat');
        if (!is_wp_error($insert) && isset($insert['term_id'])) return $insert['term_id'];

        if (is_wp_error($insert)) {
            echo "Error creating category '{$name}': " . $insert->get_error_message() . "<br>";
        }
        return false;
    }

    private function get_or_create_brand($name) {
        $exists = term_exists($name, 'product_brand');
        if ($exists && isset($exists['term_id'])) return $exists['term_id'];

        $insert = wp_insert_term($name, 'product_brand');
        if (!is_wp_error($insert) && isset($insert['term_id'])) return $insert['term_id'];

        if (is_wp_error($insert)) {
            echo "Error creating brand '{$name}': " . $insert->get_error_message() . "<br>";
        }
        return false;
    }

    /**
     * Optimized image handling:
     *  - split image list
     *  - skip already existing attachments (by filename/guid) using DB + transient cache
     *  - pre-check remote headers (size/type)
     *  - download via wp_remote_get into temp file, then sideload using media_handle_sideload
     *  - retry logic
     */
    private function handle_product_images($product_id, $images_string) {
        $gallery_ids = [];

        $image_files = array_map('trim', explode(',', $images_string));
        echo "Found " . count($image_files) . " images to import<br>";

        foreach ($image_files as $index => $image_file) {
            if (empty($image_file)) continue;

            $image_url = $this->absolute_image_url($image_file);

            // check cache / DB to skip duplicates
            $existing = $this->get_attachment_by_url_cached($image_url);
            if ($existing) {
                echo "Image exists, skipping download: {$existing}<br>";
                if ($index === 0) {
                    set_post_thumbnail($product_id, $existing);
                } else {
                    $gallery_ids[] = $existing;
                }
                continue;
            }

            echo "Processing image: {$image_url}<br>";

            // pre-check headers: size & type
            $headers_ok = $this->check_remote_image_headers($image_url);
            if ($headers_ok !== true) {
                echo "Skipped image: {$headers_ok}<br>";
                continue;
            }

            // attempt download + sideload with retries
            $attempt = 0;
            $uploaded_id = false;
            while ($attempt < $this->image_retry && !$uploaded_id) {
                $attempt++;
                $uploaded_id = $this->download_and_sideload_image($image_url, $product_id);
                if ($uploaded_id && !is_wp_error($uploaded_id)) {
                    echo "Uploaded image: {$uploaded_id} (attempt {$attempt})<br>";
                    // cache attachment ID
                    $this->cache_attachment_id($image_url, $uploaded_id);
                    if ($index === 0) {
                        set_post_thumbnail($product_id, $uploaded_id);
                    } else {
                        $gallery_ids[] = $uploaded_id;
                    }
                    break;
                } else {
                    $msg = is_wp_error($uploaded_id) ? $uploaded_id->get_error_message() : 'Unknown error';
                    echo "Image upload attempt {$attempt} failed: {$msg}<br>";
                    // short delay before retrying
                    sleep(1);
                }
            }

            if (!$uploaded_id || is_wp_error($uploaded_id)) {
                echo "Failed to import image after {$this->image_retry} attempts: {$image_url}<br>";
            }
        }

        if (!empty($gallery_ids)) {
            update_post_meta($product_id, '_product_image_gallery', implode(',', $gallery_ids));
            echo "Gallery saved with " . count($gallery_ids) . " images<br>";
        }
    }

    private function absolute_image_url($image_file) {
        // if the image_file already contains http(s), return it, otherwise prepend base URL
        $image_file = trim($image_file);
        if (preg_match('/^https?:\/\//i', $image_file)) {
            return $image_file;
        }
        return rtrim($this->base_image_url, '/') . '/' . ltrim($image_file, '/');
    }

    private function check_remote_image_headers($image_url) {
        // Use HEAD via wp_remote_head if supported, fallback to wp_remote_get with range
        $response = wp_remote_head($image_url, ['timeout' => 20, 'redirection' => 5]);

        if (is_wp_error($response) || wp_remote_retrieve_response_code($response) >= 400) {
            // try GET with small range
            $response = wp_remote_get($image_url, ['timeout' => 20, 'redirection' => 5, 'headers' => ['Range' => 'bytes=0-1024']]);
            if (is_wp_error($response) || wp_remote_retrieve_response_code($response) >= 400) {
                return "Remote file not reachable (HTTP error).";
            }
        }

        $headers = wp_remote_retrieve_headers($response);
        // content length check
        if (isset($headers['content-length'])) {
            $length = intval($headers['content-length']);
            if ($length > $this->max_image_size) {
                return "Image too large ({$this->format_bytes($length)}), max is {$this->format_bytes($this->max_image_size)}.";
            }
        }

        // content type check
        $ctype = '';
        if (isset($headers['content-type'])) {
            $ctype = strtolower($headers['content-type']);
            if (stripos($ctype, 'image/') === false) {
                return "Remote file is not an image (Content-Type: {$ctype}).";
            }
        }

        return true;
    }

    private function download_and_sideload_image($image_url, $post_id) {
        // create a temp file name
        $tmp = download_url($image_url, 60); // uses WP temp file download; returns file path or WP_Error

        if (is_wp_error($tmp)) {
            return $tmp;
        }

        // assemble sideload array expected by media_handle_sideload
        $file_array = [];
        // filename from URL
        $filename = basename(parse_url($image_url, PHP_URL_PATH));
        if (empty($filename)) {
            // fallback name
            $filename = 'import_' . time() . '.jpg';
        }
        $file_array['name'] = $filename;
        $file_array['tmp_name'] = $tmp;

        // do the sideload
        $attach_id = media_handle_sideload($file_array, $post_id, null);

        // If error, clean up temp file
        if (is_wp_error($attach_id)) {
            @unlink($tmp);
            return $attach_id;
        }

        return $attach_id;
    }

    private function get_attachment_by_url_cached($url) {
        // transient key based on filename
        $filename = basename(parse_url($url, PHP_URL_PATH));
        if (empty($filename)) return false;

        $tkey = $this->transient_prefix . md5($filename);
        $cached = get_transient($tkey);
        if ($cached) {
            return $cached;
        }

        $attachment_id = $this->get_attachment_by_filename($filename);
        if ($attachment_id) {
            // cache for 1 hour
            set_transient($tkey, $attachment_id, HOUR_IN_SECONDS);
            return $attachment_id;
        }
        return false;
    }

    private function cache_attachment_id($url, $attachment_id) {
        $filename = basename(parse_url($url, PHP_URL_PATH));
        if (empty($filename)) return;
        $tkey = $this->transient_prefix . md5($filename);
        set_transient($tkey, intval($attachment_id), HOUR_IN_SECONDS);
    }

    private function get_attachment_by_filename($filename) {
        global $wpdb;
        $like = '%' . $wpdb->esc_like($filename);
        // Check _wp_attached_file meta
        $query = $wpdb->prepare(
            "SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s LIMIT 1",
            $like
        );
        $id = $wpdb->get_var($query);
        if ($id) {
            $post = get_post($id);
            if ($post && $post->post_type === 'attachment') return intval($id);
        }

        // fallback: check guid in posts table
        $query2 = $wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND guid LIKE %s LIMIT 1",
            $like
        );
        $id2 = $wpdb->get_var($query2);
        if ($id2) return intval($id2);

        return false;
    }

    private function find_product_by_sku($sku) {
        global $wpdb;
        $query = $wpdb->prepare("SELECT post_id FROM {$wpdb->postmeta} WHERE meta_key = '_sku' AND meta_value = %s LIMIT 1", $sku);
        $id = $wpdb->get_var($query);
        return $id ? intval($id) : false;
    }

    private function result_error($msg) {
        return [
            'success' => 0,
            'failed' => 0,
            'errors' => [$msg],
            'has_more' => false,
        ];
    }

    private function format_bytes($size) {
        if ($size >= 1073741824) return round($size / 1073741824, 2) . ' GB';
        if ($size >= 1048576) return round($size / 1048576, 2) . ' MB';
        if ($size >= 1024) return round($size / 1024, 2) . ' KB';
        return $size . ' bytes';
    }
}

/**
 * Bootstrap: run importer
 */
echo "<h2>Optimized Product Importer</h2>";
echo "Memory usage: " . round(memory_get_usage() / 1024 / 1024, 2) . " MB<br>";
echo "Time: " . date('Y-m-d H:i:s') . "<br><hr>";

$importer = new ProductImporterOptimized();

// current page via GET
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$excel_path = __DIR__ . '/products.xlsx';

$results = $importer->import_products($excel_path, $current_page);

echo "<hr><h2>Import Results - Batch {$results['page']}/" . ($results['total_pages'] ?? 0) . "</h2>";
echo "Total Products in Excel: " . ($results['total_products'] ?? 0) . "<br>";
echo "Processed in this batch: " . ($results['processed_in_batch'] ?? 0) . "<br>";
echo "Successful: " . ($results['success'] ?? 0) . "<br>";
echo "Failed: " . ($results['failed'] ?? 0) . "<br>";
echo "Has more batches: " . (($results['has_more'] ?? false) ? 'Yes' : 'No') . "<br>";

if (!empty($results['errors'])) {
    echo "<h3>Errors:</h3>";
    foreach ($results['errors'] as $error) {
        echo "- " . esc_html($error) . "<br>";
    }
}

if (!empty($results['has_more'])) {
    $next_page = $current_page + 1;
    echo "<br><div style='margin: 20px 0;'>";
    echo "<a href='?page={$next_page}' style='background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;'>";
    echo "Import Next Batch ({$next_page}/" . ($results['total_pages'] ?? 0) . ")";
    echo "</a>";
    echo "</div>";
} else {
    echo "<br><div style='margin: 20px 0; padding: 10px; background: #46b450; color: white; display: inline-block;'>";
    echo "✅ All batches completed (or no more batches).";
    echo "</div>";
}

echo "<br>Import finished at: " . date('Y-m-d H:i:s') . "<br>";
// (no PHP closing tag - intentional)