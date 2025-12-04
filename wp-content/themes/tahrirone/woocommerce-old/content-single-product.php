<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('flex flex-wrap w-full items-center', $product); ?>>
	<div class="w-full md:w-20/100">
		<div class="w-full flex flex-col">
			<div class="p-4">
				<?php
				/**
				 * Hook: woocommerce_before_single_product_summary.
				 *
				 * @hooked woocommerce_show_product_sale_flash - 10
				 * @hooked woocommerce_show_product_images - 20
				 */
				do_action('woocommerce_before_single_product_summary');
				?>
			</div>
		</div>
	</div>
	<div class="w-full md:w-80/100">
		<div class="summary entry-summary">
			<?php
			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			do_action('woocommerce_single_product_summary');
			?>
		</div>
	</div>
	<div class="w-full md:w-80/100">
		<div class="p-4">
			<form class="cart flex gap-4 items-center" action="[product_page_url]" method="post" enctype="multipart/form-data">
				<div class="quantity w-fit">
					<label class="screen-reader-text" for="quantity_65778a...">Quantity</label>
					<input type="number"
						id="quantity_65778a..."
						class="input-text qty text border p-4 rounded"
						step="1" min="1" max=""
						name="quantity"
						value="1"
						title="Qty"
						size="4"
						placeholder=""
						inputmode="numeric" />
				</div>
				<button type="submit" name="add-to-cart" value="[product_id]" class="single_add_to_cart_button button alt bg-green-400 text-white w-full rounded p-4 bold cursor-pointer">افزودن به سبد خرید</button>
			</form>
			<div class="accordion-container my-5">
				<div class="accordion-item">
					<button class="accordion-header text-right!">
						نظرات مشتریان
					</button>
					<div class="accordion-content">
						<?php
						/**
						 * Display the Average Star Rating and Review Count using WooCommerce native functions.
						 * This code should be placed within The Loop on a single product page.
						 */

						// 1. Ensure we have a valid WooCommerce product object
						global $product;

						if (! is_a($product, 'WC_Product')) {
							// If $product isn't set, try to get it from the global post object
							$product = wc_get_product(get_the_ID());
						}

						if ($product) :

							// 2. Get the average rating and review count using built-in methods
							$average_rating = $product->get_average_rating();
							$review_count   = $product->get_review_count();

							if ($review_count > 0) :
								// If there are reviews, display the summary
						?>
								<div class="product-rating-summary woocommerce-summary">
									<h2>Customer Ratings</h2>

									<div class="rating-display">
										<?php echo wc_get_rating_html($average_rating); ?>

										<span class="rating-text">
											Average:
											<strong><?php echo esc_html($average_rating); ?> / 5</strong>
											based on
											<strong><?php echo esc_html($review_count); ?></strong>
											<?php echo _n('review', 'reviews', $review_count, 'woocommerce'); ?>
										</span>
									</div>

									<p class="view-all-reviews">
										<a href="#reviews" class="woocommerce-review-link">
											<?php echo esc_html($review_count); ?> reviews
										</a>
									</p>
								</div>
							<?php else :
								// If there are no ratings, prompt the user to be the first
							?>
								<p class="no-rating-message">
									There are no reviews yet. <a href="#review_form">Be the first to review!</a>
								</p>
							<?php endif; ?>

						<?php endif; ?>
						<?php
						/**
						 * Conditionally displays the comment/review form 
						 * based on the product's settings.
						 */

						// 1. Check if the current post (product) is open for comments/reviews.
						// This checks the standard WordPress 'Allow comments' setting.
						if (comments_open()) :

							// 2. Check if the product has the 'reviews' feature supported by the theme/WooCommerce.
							// This function is required to load the necessary scripts and functions.
							if (post_type_supports('product', 'comments')) :

								// 3. Call the WordPress function to display the comment form.
								// For products, this function handles both the standard comment form 
								// and the WooCommerce review form template.
								comments_template();

							endif; // End check for post type support

						// If comments are closed, you might want to display a message.
						else :
							// This often happens if the 'Enable reviews' setting is unchecked in the WooCommerce settings.
						?>
							<p class="woocommerce-no-reviews">
								<?php esc_html_e('Reviews are closed for this product.', 'your-text-domain'); ?>
							</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>