<?php
/**
 * Script for importing products - Complete version
 */

// مسیر صحیح برای wp-load.php بر اساس ساختار پوشه شما
require_once __DIR__ . '/../wp-load.php';

// include فایل‌های لازم برای آپلود تصاویر
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

// اگر از کامپوزر استفاده می‌کنید
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductImporter {
    
    private $base_image_url = 'https://zino.ir/Content/Upload/Product/';
    
    public function import_products($excel_file_path) {
        // بررسی وجود فایل
        if (!file_exists($excel_file_path)) {
            return ['success' => 0, 'failed' => 0, 'errors' => ['File not found: ' . $excel_file_path]];
        }
        
        try {
            $spreadsheet = IOFactory::load($excel_file_path);
            $worksheet = $spreadsheet->getActiveSheet();
            
            $products_data = [];
            $headers = [];
            
            foreach ($worksheet->getRowIterator() as $row) {
                $rowData = [];
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                
                if ($row->getRowIndex() == 1) {
                    // خواندن هدرها
                    foreach ($cellIterator as $cell) {
                        $headers[] = trim($cell->getValue());
                    }
                    continue;
                }
                
                // خواندن داده‌ها
                $colIndex = 0;
                foreach ($cellIterator as $cell) {
                    if (isset($headers[$colIndex])) {
                        $rowData[$headers[$colIndex]] = $cell->getValue();
                    }
                    $colIndex++;
                }
                
                // فقط ردیف‌هایی که کد محصول دارند را پردازش کنیم
                if (!empty($rowData['کد محصول'])) {
                    $products_data[] = $rowData;
                }
            }
            
            $results = [
                'success' => 0,
                'failed' => 0,
                'errors' => []
            ];
            
            foreach ($products_data as $index => $product_data) {
                echo "Processing product " . ($index + 1) . "/" . count($products_data) . ": " . $product_data['نام محصول'] . "<br>";
                flush();
                
                $import_result = $this->import_single_product($product_data);
                
                if ($import_result['success']) {
                    $results['success']++;
                    echo "✓ Success: Product ID " . $import_result['product_id'] . " (" . $import_result['action'] . ")<br>";
                } else {
                    $results['failed']++;
                    $results['errors'][] = "Product " . $product_data['نام محصول'] . ": " . $import_result['error'];
                    echo "✗ Failed: " . $import_result['error'] . "<br>";
                }
                
                echo "<br>";
                flush();
            }
            
            return $results;
            
        } catch (Exception $e) {
            return ['success' => 0, 'failed' => 0, 'errors' => ['Excel reading error: ' . $e->getMessage()]];
        }
    }
    
    private function import_single_product($data) {
        try {
            // بررسی اینکه محصول از قبل وجود دارد یا نه
            $existing_product_id = $this->find_product_by_sku($data['کد محصول']);
            
            if ($existing_product_id) {
                $product_id = $existing_product_id;
                $product = wc_get_product($product_id);
                $action = 'updated';
            } else {
                $product = new WC_Product_Simple();
                $action = 'created';
            }
            
            // تنظیم اطلاعات پایه محصول
            $product->set_name($data['نام محصول']);
            $product->set_sku($data['کد محصول']);
            
            // تنظیم قیمت
            if (!empty($data['قیمت واحد'])) {
                $product->set_regular_price(floatval($data['قیمت واحد']));
            }
            
            // تنظیم موجودی
            $product->set_manage_stock(true);
            $product->set_stock_quantity(intval($data['موجودی']));
            
            // وضعیت محصول
            $status = 'publish';
            if (isset($data['متوقف شده']) && $data['متوقف شده'] == 1) {
                $status = 'draft';
            }
            if (isset($data['حذف شده']) && $data['حذف شده'] == 1) {
                $status = 'trash';
            }
            $product->set_status($status);
            
            // ذخیره محصول
            $product_id = $product->save();
            
            // اضافه کردن متا فیلدها
            $this->add_product_meta($product_id, $data);
            
            // مدیریت تصاویر
            $this->handle_product_images($product_id, $data['تصاویر']);
            
            // مدیریت دسته‌بندی
            $this->handle_product_categories($product_id, $data['دسته بندی']);
            
            // مدیریت برند
            $this->handle_product_brand($product_id, $data);
            
            return ['success' => true, 'product_id' => $product_id, 'action' => $action];
            
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    private function add_product_meta($product_id, $data) {
        // ذخیره شناسه (GTIN/EAN/UPC)
        if (!empty($data['شناسه'])) {
            update_post_meta($product_id, '_gtin', sanitize_text_field($data['شناسه']));
        }
        
        // ذخیره نام مستعار
        if (!empty($data['نام مستعار'])) {
            update_post_meta($product_id, '_product_alias', sanitize_text_field($data['نام مستعار']));
        }
        
        // ذخیره واحد اصلی
        if (!empty($data['واحد اصلی'])) {
            update_post_meta($product_id, '_main_unit', sanitize_text_field($data['واحد اصلی']));
        }
        
        // سایر فیلدها
        update_post_meta($product_id, '_stock', intval($data['موجودی']));
    }
    
    private function handle_product_images($product_id, $images_string) {
        $gallery_ids = [];
        
        if (empty($images_string)) {
            echo "No images to import<br>";
            return; // هیچ عکسی اضافه نمی‌کنیم
        }
        
        // جدا کردن عکس‌ها با کاما
        $image_files = explode(',', $images_string);
        echo "Found " . count($image_files) . " images to import<br>";
        
        foreach ($image_files as $index => $image_file) {
            $image_file = trim($image_file);
            
            if (empty($image_file)) {
                continue;
            }
            
            echo "Processing image: " . $image_file . "<br>";
            $image_url = $this->base_image_url . $image_file;
            $attachment_id = $this->upload_image_from_url($image_url, $product_id);
            
            if ($attachment_id && !is_wp_error($attachment_id)) {
                if ($index === 0) {
                    // اولین عکس به عنوان تصویر شاخص
                    set_post_thumbnail($product_id, $attachment_id);
                    echo "Set as featured image: " . $attachment_id . "<br>";
                } else {
                    // بقیه عکس‌ها به گالری اضافه شوند
                    $gallery_ids[] = $attachment_id;
                    echo "Added to gallery: " . $attachment_id . "<br>";
                }
            } else {
                echo "Failed to upload image: " . $image_url . "<br>";
                if (is_wp_error($attachment_id)) {
                    echo "Error: " . $attachment_id->get_error_message() . "<br>";
                }
            }
        }
        
        // ذخیره گالری تصاویر
        if (!empty($gallery_ids)) {
            update_post_meta($product_id, '_product_image_gallery', implode(',', $gallery_ids));
            echo "Gallery saved with " . count($gallery_ids) . " images<br>";
        }
    }
    
    private function upload_image_from_url($image_url, $product_id) {
        // بررسی اینکه آیا عکس از قبل وجود دارد
        $existing_attachment = $this->get_attachment_by_url($image_url);
        if ($existing_attachment) {
            echo "Image already exists: " . $existing_attachment . "<br>";
            return $existing_attachment;
        }
        
        echo "Downloading image from: " . $image_url . "<br>";
        
        // آپلود عکس جدید
        $upload = media_sideload_image($image_url, $product_id, get_the_title($product_id), 'id');
        
        if (is_wp_error($upload)) {
            error_log('Error uploading image: ' . $upload->get_error_message());
            echo "Upload error: " . $upload->get_error_message() . "<br>";
            return false;
        }
        
        echo "Image uploaded successfully: " . $upload . "<br>";
        return $upload;
    }
    
    private function get_attachment_by_url($url) {
        global $wpdb;
        
        // جستجو بر اساس نام فایل
        $filename = basename($url);
        $query = $wpdb->prepare(
            "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s",
            '%' . $filename
        );
        
        $attachment_id = $wpdb->get_var($query);
        
        if ($attachment_id) {
            // همچنین بررسی کنید که attachment واقعاً وجود دارد
            $attachment = get_post($attachment_id);
            if ($attachment && $attachment->post_type == 'attachment') {
                return $attachment_id;
            }
        }
        
        return false;
    }
    
    private function handle_product_categories($product_id, $category_name) {
        if (empty($category_name)) {
            return;
        }
        
        $category_id = $this->get_or_create_category($category_name);
        
        if ($category_id) {
            wp_set_object_terms($product_id, [$category_id], 'product_cat');
            echo "Category set: " . $category_name . " (ID: " . $category_id . ")<br>";
        }
    }
    
    private function handle_product_brand($product_id, $data) {
        if (!empty($data['نام برند'])) {
            // اگر از تاکسونومی برند استفاده می‌کنید
            $brand_id = $this->get_or_create_brand($data['نام برند']);
            
            if ($brand_id) {
                wp_set_object_terms($product_id, [$brand_id], 'product_brand');
                echo "Brand set: " . $data['نام برند'] . " (ID: " . $brand_id . ")<br>";
            }
        }
    }
    
    private function get_or_create_category($category_name) {
        $term = term_exists($category_name, 'product_cat');
        
        if ($term) {
            return $term['term_id'];
        }
        
        $new_term = wp_insert_term($category_name, 'product_cat');
        
        if (!is_wp_error($new_term)) {
            return $new_term['term_id'];
        }
        
        echo "Error creating category: " . $new_term->get_error_message() . "<br>";
        return false;
    }
    
    private function get_or_create_brand($brand_name) {
        // بررسی وجود تاکسونومی برند
        $taxonomy_exists = taxonomy_exists('product_brand');
        
        if (!$taxonomy_exists) {
            echo "Product brand taxonomy does not exist<br>";
            return false;
        }
        
        $term = term_exists($brand_name, 'product_brand');
        
        if ($term) {
            return $term['term_id'];
        }
        
        $new_term = wp_insert_term($brand_name, 'product_brand');
        
        if (!is_wp_error($new_term)) {
            return $new_term['term_id'];
        }
        
        echo "Error creating brand: " . $new_term->get_error_message() . "<br>";
        return false;
    }
    
    private function find_product_by_sku($sku) {
        global $wpdb;
        
        $product_id = $wpdb->get_var($wpdb->prepare("
            SELECT post_id FROM $wpdb->postmeta 
            WHERE meta_key = '_sku' AND meta_value = %s
        ", $sku));
        
        return $product_id;
    }
}

// اجرای اسکریپت
echo "<h2>Product Import Started</h2>";
echo "Memory usage: " . round(memory_get_usage() / 1024 / 1024, 2) . " MB<br>";
echo "Time: " . date('Y-m-d H:i:s') . "<br><hr>";

$importer = new ProductImporter();

// مسیر فایل اکسل - در همان پوشه اسکریپت
$excel_path = __DIR__ . '/products.xlsx';

$results = $importer->import_products($excel_path);

echo "<hr><h2>Import Results</h2>";
echo "Successful: " . $results['success'] . "<br>";
echo "Failed: " . $results['failed'] . "<br>";

if (!empty($results['errors'])) {
    echo "<h3>Errors:</h3>";
    foreach ($results['errors'] as $error) {
        echo "- " . $error . "<br>";
    }
}

echo "<br>Import completed at: " . date('Y-m-d H:i:s');
?>