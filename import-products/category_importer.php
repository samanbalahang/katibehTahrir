<?php
// ... (بارگذاری wp-load.php و autoload.php بدون تغییر)
require_once __DIR__ . '/../wp-load.php';

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    die("Composer's autoloader not found. Please ensure PhpSpreadsheet is installed.");
}

use PhpOffice\PhpSpreadsheet\IOFactory;

ini_set('memory_limit', '512M');
set_time_limit(3600); 

class ProductCategoryUpdater {
    
    private $batch_size = 500;
    
    // ... (تابع import_products بدون تغییر باقی می‌ماند)

    public function update_categories_from_excel($excel_file_path, $page = 1) {
        // ... (منطق خواندن اکسل و batch processing در اینجا قرار می‌گیرد و بدون تغییر است)
        // ... (برای صرفه جویی در فضای پاسخ، این بخش طولانی را حذف می‌کنیم)
        // ...
        
        if (!file_exists($excel_file_path)) {
            return ['success' => 0, 'failed' => 0, 'errors' => ['File not found: ' . $excel_file_path], 'has_more' => false];
        }
        
        try {
            $spreadsheet = IOFactory::load($excel_file_path);
            $worksheet = $spreadsheet->getActiveSheet();
            
            $products_data = [];
            $headers = [];
            $row_count = 0;
            
            foreach ($worksheet->getRowIterator() as $row) {
                $rowData = [];
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(false);
                
                if ($row->getRowIndex() == 1) {
                    foreach ($cellIterator as $cell) {
                        $headers[] = trim($cell->getValue());
                    }
                    continue;
                }
                
                $colIndex = 0;
                foreach ($cellIterator as $cell) {
                    if (isset($headers[$colIndex])) {
                        $rowData[$headers[$colIndex]] = $cell->getCalculatedValue(); 
                    }
                    $colIndex++;
                }
                
                if (!empty($rowData['کد محصول'])) {
                    $row_count++;
                    $start_index = ($page - 1) * $this->batch_size;
                    $end_index = $page * $this->batch_size;
                    
                    if ($row_count > $start_index && $row_count <= $end_index) {
                        $products_data[] = $rowData;
                    }
                }
            }
            
            $total_products = $row_count;
            $total_pages = ceil($total_products / $this->batch_size);
            $has_more = $page < $total_pages;
            
            $results = [
                'success' => 0, 'failed' => 0, 'errors' => [], 'page' => $page,
                'total_pages' => $total_pages, 'total_products' => $total_products,
                'has_more' => $has_more, 'processed_in_batch' => count($products_data)
            ];
            
            if (empty($products_data)) {
                $results['errors'][] = "No products found in batch {$page}";
                return $results;
            }
            
            foreach ($products_data as $index => $product_data) {
                $absolute_index = (($page - 1) * $this->batch_size) + $index + 1;
                echo "Processing product {$absolute_index}/{$total_products}: " . $product_data['نام محصول'] . " (SKU: " . $product_data['کد محصول'] . ")<br>";
                flush();
                
                $import_result = $this->update_single_product_categories($product_data);
                
                if ($import_result['success']) {
                    $results['success']++;
                    echo "✓ Success: Product ID " . $import_result['product_id'] . " (" . $import_result['action'] . ")<br>";
                } else {
                    $results['failed']++;
                    $results['errors'][] = "Product " . $product_data['نام محصول'] . " (SKU: " . $product_data['کد محصول'] . "): " . $import_result['error'];
                    echo "✗ Failed: " . $import_result['error'] . "<br>";
                }
                
                echo "<br>";
                flush();
            }
            
            return $results;
            
        } catch (Exception $e) {
            return ['success' => 0, 'failed' => 0, 'errors' => ['Excel reading error: ' . $e->getMessage()], 'has_more' => false];
        }
    }


    // **تابع جدید: تمیز کردن نام دسته بندی**
    private function clean_category_name($name) {
        // حذف فضاهای اضافی (چند فاصله متوالی، فاصله در ابتدا و انتها)
        $name = trim($name);
        $name = preg_replace('/\s+/', ' ', $name);
        
        // اگر کاراکترهای خاص فارسی دارید (مثل ی عربی و ک فارسی)، می‌توانید اینجا یکسان‌سازی کنید.
        
        return $name;
    }


    // تابع اصلی برای به‌روزرسانی دسته‌بندی‌ها (اصلاح شده برای Uncategorized)
    private function update_single_product_categories($data) {
        try {
            $sku = $data['کد محصول'];
            $existing_product_id = $this->find_product_by_sku($sku);
            
            if (!$existing_product_id) {
                return ['success' => false, 'error' => "Product with SKU '{$sku}' not found. Cannot update categories."];
            }
            
            $product_id = $existing_product_id;
            
            // استخراج نام دسته‌ها از ستون‌های اکسل
            $main_category = isset($data['دسته بندی']) ? trim($data['دسته بندی']) : '';
            $sub_category = isset($data['نام گروه']) ? trim($data['نام گروه']) : '';
            
            if (empty($main_category) && empty($sub_category)) {
                 // **انتساب به Uncategorized در صورت خالی بودن دسته‌بندی**
                 $default_cat_id = get_option('default_product_cat'); 
                 
                 if ($default_cat_id) {
                     wp_set_object_terms($product_id, [(int)$default_cat_id], 'product_cat', true); 
                     echo "Assigned to default category (Uncategorized).<br>";
                     return ['success' => true, 'product_id' => $product_id, 'action' => 'assigned to Uncategorized'];
                 } else {
                     return ['success' => true, 'product_id' => $product_id, 'action' => 'categories skipped (default not found)'];
                 }
            }

            // اگر دسته‌بندی در اکسل وجود دارد، منطق سلسله مراتبی را اجرا می‌کنیم
            $this->handle_product_categories_hierarchy($product_id, $main_category, $sub_category);
            
            return ['success' => true, 'product_id' => $product_id, 'action' => 'categories updated'];
            
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
    
    // مدیریت سلسله مراتب دسته‌بندی (اصلاح شده برای استفاده از تمیزکاری)
    private function handle_product_categories_hierarchy($product_id, $parent_cat_name_raw, $child_cat_name_raw) {
        
        // **اعمال تمیزکاری**
        $parent_cat_name = $this->clean_category_name($parent_cat_name_raw);
        $child_cat_name = $this->clean_category_name($child_cat_name_raw);
        
        if (empty($parent_cat_name)) {
            echo "Error: Parent category name is empty after cleaning.<br>";
            return;
        }
        
        // ۱. اطمینان از وجود دسته اصلی (والد)
        $parent_id = $this->get_or_create_category_with_parent($parent_cat_name, 0);

        if (!$parent_id) {
            return;
        }
        
        $target_category_id = $parent_id;

        if (!empty($child_cat_name)) {
            // ۲. اطمینان از وجود زیردسته (فرزند)
            $child_id = $this->get_or_create_category_with_parent($child_cat_name, $parent_id);

            if ($child_id) {
                $target_category_id = $child_id;
                echo "Subcategory handled: " . $parent_cat_name . " > " . $child_cat_name . " (ID: " . $child_id . ")<br>";
            } else {
                 echo "Could not create child category. Assigning to parent: " . $parent_cat_name . " (ID: " . $parent_id . ")<br>";
            }
        } else {
            echo "Only parent category set: " . $parent_cat_name . " (ID: " . $parent_id . ")<br>";
        }

        // ۳. انتساب دسته‌بندی به محصول
        $result = wp_set_object_terms($product_id, [$target_category_id], 'product_cat', true);
        
        if (is_wp_error($result)) {
            echo "Error assigning category to product: " . $result->get_error_message() . "<br>";
        }
    }

    private function get_or_create_category_with_parent($category_name, $parent_id = 0) {
        // جستجوی دسته‌بندی بر اساس نام و والد
        $term = term_exists($category_name, 'product_cat', $parent_id);
        
        if ($term && !is_wp_error($term) && $term['term_id']) {
            return $term['term_id'];
        }
        
        // ایجاد دسته‌بندی جدید
        $new_term = wp_insert_term(
            $category_name, 
            'product_cat', 
            array(
                'parent' => $parent_id
            )
        );
        
        if (!is_wp_error($new_term)) {
            echo "New category created: " . $category_name . " (Parent: " . $parent_id . ")<br>";
            return $new_term['term_id'];
        }
        
        echo "Error creating category '{$category_name}' (Parent: {$parent_id}): " . $new_term->get_error_message() . "<br>";
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


// --- بخش اجرای اسکریپت ---

// ... (بخش اجرای اسکریپت در اینجا قرار می‌گیرد و بدون تغییر است)
echo "<h2>🔄 WooCommerce Category Update Started</h2>";
echo "Memory usage: " . round(memory_get_usage() / 1024 / 1024, 2) . " MB<br>";
echo "Time: " . date('Y-m-d H:i:s') . "<br><hr>";

$importer = new ProductCategoryUpdater();
$current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$excel_path = __DIR__ . '/products.xlsx';

$results = $importer->update_categories_from_excel($excel_path, $current_page);

echo "<hr><h2>Import Results - Batch {$results['page']}/{$results['total_pages']}</h2>";
echo "Total Products in Excel: " . $results['total_products'] . "<br>";
echo "Processed in this batch: " . $results['processed_in_batch'] . "<br>";
echo "Successful: " . $results['success'] . "<br>";
echo "Failed: " . $results['failed'] . "<br>";
echo "Has more batches: " . ($results['has_more'] ? 'Yes' : 'No') . "<br>";

if (!empty($results['errors'])) {
    echo "<h3>Errors:</h3>";
    foreach ($results['errors'] as $error) {
        echo "- " . $error . "<br>";
    }
}

if ($results['has_more']) {
    $next_page = $current_page + 1;
    echo "<br><div style='margin: 20px 0;'>";
    echo "<a href='?page={$next_page}' style='background: #0073aa; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;'>";
    echo "Import Next Batch ({$next_page}/{$results['total_pages']})";
    echo "</a>";
    echo "</div>";
} else {
    echo "<br><div style='margin: 20px 0; padding: 10px; background: #46b450; color: white;'>";
    echo "✅ All batches completed successfully!";
    echo "</div>";
}

echo "<br>Import completed at: " . date('Y-m-d H:i:s');
?>