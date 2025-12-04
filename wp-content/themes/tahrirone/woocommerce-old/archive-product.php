<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');

// --- BEGIN CONTENT WRAPPER AND BREADCRUMBS ---
// do_action( 'woocommerce_before_main_content' );
// --- END CONTENT WRAPPER AND BREADCRUMBS ---

// Custom Category Header Display
if (is_product_category()) {
    $current_category = get_queried_object();

    if ($current_category && property_exists($current_category, 'name')) {
?>
        <div class="bg-primary py-15">
            <h1 class="text-center font-bold">
                <?= esc_html($current_category->name);  ?>
            </h1>
        </div>
<?php
    }
}
?>
<div class="container mx-auto mt-15">
    <div class="flex flex-wrap">
        <div class="w-full md:w-20/100">
            <?php
            do_action('woocommerce_sidebar');
            ?>
        </div>
        
        <div class="w-full md:w-80/100">
            <?php
            // Hook: woocommerce_shop_loop_header (standard practice is to use hooks here)
            // If you insist on custom code, it goes inside the loop check.

            if (woocommerce_product_loop()) {

                // --- 🚩 CONSOLIDATED VARIABLE DEFINITIONS (FIXED BLOCK) 🚩 ---
                global $wp_query;

                // Pagination Variables
                $paged = max(1, $wp_query->get('paged'));
                $per_page = $wp_query->get('posts_per_page');
                $total  = $wp_query->found_posts;
                $current = $paged;
                
                // Orderby Variables
                $default_orderby = apply_filters(
                    'woocommerce_default_catalog_orderby',
                    get_option( 'woocommerce_default_catalog_orderby', '' )
                );
                
                // Get current orderby from URL, or use default
                $orderby = isset($_GET['orderby'])
                    ? wc_clean(wp_unslash($_GET['orderby'])) 
                    : $default_orderby;

                // Define $orderedby (for result count display) based on $orderby
                $orderedby = $orderby;

                // Handle 'menu_order' for both $orderby and $orderedby (Standard WooCommerce logic)
                if ('menu_order' === $orderby) {
                    $orderby = '';
                } 
                if ('menu_order' === $orderedby) {
                    $orderedby = '';
                } else {
                    $orderedby = is_string($orderedby) ? $orderedby : '';
                }
                
                // Sorting Options (FIXED: Using old filter with fallback for compatibility)
                $catalog_orderby_options = apply_filters('woocommerce_catalog_orderby', array());
                
                if (empty($catalog_orderby_options)) {
                    $catalog_orderby_options = array(
                        'menu_order' => __('Default sorting', 'woocommerce'),
                        'popularity' => __('Sort by popularity', 'woocommerce'),
                        'rating'   => __('Sort by average rating', 'woocommerce'),
                        'date'    => __('Sort by latest', 'woocommerce'),
                        'price'   => __('Sort by price: low to high', 'woocommerce'),
                        'price-desc' => __('Sort by price: high to low', 'woocommerce'),
                    );
                }

                // ID and Label Variables (Required for the Form)
                $id_suffix = wp_unique_id();
                $show_default_orderby = 'menu_order' === apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));
                $use_label = apply_filters('woocommerce_loop_product_orderby_label', $show_default_orderby);
                
                // --- 🚩 END CONSOLIDATED VARIABLE DEFINITIONS 🚩 ---
                
                // woocommerce_before_shop_loop contents (Result Count and Sorting Form)
            ?>
                <div class="w-full my-5">
                    <div class="flex flex-wrap items-center">
                        <div class="w-full md:w-50/100">
                            <p class="woocommerce-result-counts" role="alert" aria-relevant="all" <?php echo (empty($orderedby) || 1 === intval($total)) ? '' : 'data-is-sorted-by="true"'; ?>>
                                <?php
                                // phpcs:disable WordPress.Security
                                if (1 === intval($total)) {
                                    _e('Showing the single result', 'woocommerce');
                                } elseif ($total <= $per_page || -1 === $per_page) {
                                    $orderedby_placeholder = empty($orderedby) ? '%2$s' : '<span class="screen-reader-text">%2$s</span>';
                                    /* translators: 1: total results 2: sorted by */
                                    printf(_n('Showing all %1$d result', 'Showing all %1$d results', $total, 'woocommerce') . $orderedby_placeholder, $total, esc_html($orderedby));
                                } else {
                                    $first         = ($per_page * $current) - $per_page + 1;
                                    $last         = min($total, $per_page * $current);
                                    $orderedby_placeholder = empty($orderedby) ? '%4$s' : '<span class="screen-reader-text">%4$s</span>';
                                    /* translators: 1: first result 2: last result 3: total results 4: sorted by */
                                    printf(_nx('Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'woocommerce') . $orderedby_placeholder, $first, $last, $total, esc_html($orderedby));
                                }
                                // phpcs:enable WordPress.Security
                                ?>
                            </p>
                        </div>
                        
                        <div class="w-full md:w-50/100">
                            <form class="woocommerce-ordering text-left" method="get">
                                <div class="bg-gray-300 px-5 w-fit p-2 rounded mr-auto">
                                    <?php if ($use_label) : ?>
                                        <label for="woocommerce-orderby-<?php echo esc_attr($id_suffix); ?>"><?php echo esc_html__('Sort by', 'woocommerce'); ?></label>
                                    <?php endif; ?>
                                    <select
                                        name="orderby"
                                        class="orderby"
                                        <?php if ($use_label) : ?>
                                        id="woocommerce-orderby-<?php echo esc_attr($id_suffix); ?>"
                                        <?php else : ?>
                                        aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>"
                                        <?php endif; ?>>
                                        <?php foreach ($catalog_orderby_options as $id => $name) : ?>
                                            <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="paged" value="1" />
                                    <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
                                </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            <?php
                // --- RUN STANDARD WOOCOMMERCE BEFORE LOOP HOOKS ---
                // do_action('woocommerce_before_shop_loop');
                // --- END HOOKS ---
                
                woocommerce_product_loop_start();

                if (wc_get_loop_prop('total')) {
                    while (have_posts()) {
						?>
						<div class="rounded-2xl border min-h-100 mb-4 overflow-hidden">
						<?php
                        the_post();
                        do_action('woocommerce_shop_loop');
                        wc_get_template_part('content', 'product');
						?>
						</div>
						<?php
                    }
                }

                woocommerce_product_loop_end();
                
                do_action('woocommerce_after_shop_loop');
            } else {
                do_action('woocommerce_no_products_found');
            }

            // do_action('woocommerce_after_main_content');
            ?>
        </div>
    </div>
</div>

<?php
get_footer('shop');