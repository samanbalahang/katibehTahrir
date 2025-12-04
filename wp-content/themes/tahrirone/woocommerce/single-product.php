<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

get_header('shop'); ?>

<div class="bg-gray-300 py-5">
	<div class="container mx-auto">
		<?php woocommerce_breadcrumb(); ?>
	</div>
</div>
<div class="container mx-auto">
	<div class="flex flex-wrap">
		<div class="w-full md:w-90/100">
			<?php while (have_posts()) : ?>
				<?php the_post(); ?>
				<?php wc_get_template_part('content', 'single-product'); ?>
			<?php endwhile; // end of the loop. 
			?>
		</div>
		<aside class="w-full md:w-10/100">
			<div class="flex flex-col pt-4 justify-center items-center">
				<div class="w-full flex flex-col justify-center items-center border-b mb-4">
					<img src="<?= get_template_directory_uri() ?>/assets/images/services.png" alt="services" class="w-full grayscale hover:filter-none hover:grayscale-0 ">
					<span>
						ضمانت بازگشت کالا

					</span>
				</div>
				<div class="w-full flex flex-col justify-center items-center border-b mb-4">
					<img src="<?= get_template_directory_uri() ?>/assets/images/zemanat.png" alt="zemanat" class="w-full grayscale hover:filter-none hover:grayscale-0 ">
					<span>
						ضمانت اصالت کالا
					</span>
				</div>
				<div class="w-full flex flex-col justify-center items-center border-b mb-4">
					<img src="<?= get_template_directory_uri() ?>/assets/images/esalat.png" alt="esalat" class="w-full grayscale hover:filter-none hover:grayscale-0 ">
					<span>
						خدمات پس از خرید
					</span>
				</div>
				<div class="w-full flex flex-col justify-center items-center border-b mb-4">
					<img src="<?= get_template_directory_uri() ?>/assets/images/fast.png" alt="fast" class="w-full grayscale hover:filter-none hover:grayscale-0 ">
					<span>
						تحویل سریع و آسان
					</span>
				</div>
			</div>
		</aside>
	</div>
</div>
<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
// do_action('woocommerce_after_main_content');
?>

<?php
/**
 * woocommerce_sidebar hook.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
// do_action('woocommerce_sidebar');
?>

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
