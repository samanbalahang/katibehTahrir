<?php

/**
 * Sidebar
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/sidebar.php.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce\Templates
 * @version 	1.6.4
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
?>

<aside id="secondary" class="widget-area" role="complementary">

	<div class="widget woocommerce widget_product_search mb-8 p-4 border rounded shadow">
		<h3 class="widget-title text-xl font-semibold mb-3 border-b pb-2"><?php esc_html_e('Search Products', 'tahrirone'); ?></h3>
		<?php the_widget('WC_Widget_Product_Search'); ?>
	</div>

	<div class="widget woocommerce widget_product_categories mb-8 p-4 border rounded shadow">
		<h3 class="widget-title text-xl font-semibold mb-3 border-b pb-2"><?php esc_html_e('Product Categories', 'tahrirone'); ?></h3>

		<?php
		$args = array(
			'taxonomy'     => 'product_cat',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'show_count'   => 1, // Show product count
			'hierarchical' => 1,
			'title_li'     => '',
			'hide_empty'   => 1 // Only list categories that have products
		);
		?>
		<ul class="product-categories list-none space-y-1">
			<?php wp_list_categories($args); ?>
		</ul>
	</div>

	<div class="widget woocommerce widget_price_filter mb-8 p-4 border rounded shadow">
		<h3 class="widget-title text-xl font-semibold mb-3 border-b pb-2"><?php esc_html_e('Filter by Price', 'tahrirone'); ?></h3>
		<?php the_widget('WC_Widget_Price_Filter'); ?>

		<form method="get" action="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="mt-4">
			<button type="submit" class="button btn bg-primary hover:bg-secondary text-white font-bold py-2 px-4 rounded w-full">
				<?php esc_html_e('Filter', 'tahrirone'); ?>
			</button>
		</form>
	</div>
	<div class="widget woocommerce widget_products mb-8 p-4 border rounded shadow">
		<h3 class="widget-title text-xl font-semibold mb-3 border-b pb-2"><?php esc_html_e('Random Products', 'tahrirone'); ?></h3>
		<?php
		the_widget('WC_Widget_Products', array(
			'title'      => '',
			'number'     => 5, // List 5 products
			'orderby'    => 'rand', // Order them randomly
			'show_rating' => true,
		));
		?>
	</div>
</aside>