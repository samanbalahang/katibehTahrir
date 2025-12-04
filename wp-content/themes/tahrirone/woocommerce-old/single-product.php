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
					<img src="<?= get_template_directory_uri() ?>/assets/images/services.png" alt="services" class="grayscale hover:filter-none hover:grayscale-0 w-35/100 block mx-auto">
					<span>
						ضمانت بازگشت کالا

					</span>
				</div>
				<div class="w-full flex flex-col justify-center items-center border-b mb-4">
					<img src="<?= get_template_directory_uri() ?>/assets/images/zemanat.png" alt="zemanat" class="grayscale hover:filter-none hover:grayscale-0 w-35/100 block mx-auto">
					<span>
						ضمانت اصالت کالا
					</span>
				</div>
				<div class="w-full flex flex-col justify-center items-center border-b mb-4">
					<img src="<?= get_template_directory_uri() ?>/assets/images/esalat.png" alt="esalat" class="grayscale hover:filter-none hover:grayscale-0 w-35/100 block mx-auto">
					<span>
						خدمات پس از خرید
					</span>
				</div>
				<div class="w-full flex flex-col justify-center items-center border-b mb-4">
					<img src="<?= get_template_directory_uri() ?>/assets/images/fast.png" alt="fast" class="grayscale hover:filter-none hover:grayscale-0 w-35/100 block mx-auto">
					<span>
						تحویل سریع و آسان
					</span>
				</div>
			</div>
		</aside>
	</div>
</div>
<div class="w-full my-14">
	<div class="rotate-180 translate-y-1">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="h-10 w-full">
			<path class="fill-gray-400" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"></path>
			<path class="fill-gray-400" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"></path>
			<path class="fill-gray-400" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"></path>
		</svg>
	</div>
	<div class="bg-gray-400">
		<div class="container mx-auto py-5">
			<?php
			woocommerce_output_related_products();
			?>
		</div>
	</div>
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" class="h-10 w-full">
		<path class="fill-gray-400" opacity="0.33" d="M473,67.3c-203.9,88.3-263.1-34-320.3,0C66,119.1,0,59.7,0,59.7V0h1000v59.7 c0,0-62.1,26.1-94.9,29.3c-32.8,3.3-62.8-12.3-75.8-22.1C806,49.6,745.3,8.7,694.9,4.7S492.4,59,473,67.3z"></path>
		<path class="fill-gray-400" opacity="0.66" d="M734,67.3c-45.5,0-77.2-23.2-129.1-39.1c-28.6-8.7-150.3-10.1-254,39.1 s-91.7-34.4-149.2,0C115.7,118.3,0,39.8,0,39.8V0h1000v36.5c0,0-28.2-18.5-92.1-18.5C810.2,18.1,775.7,67.3,734,67.3z"></path>
		<path class="fill-gray-400" d="M766.1,28.9c-200-57.5-266,65.5-395.1,19.5C242,1.8,242,5.4,184.8,20.6C128,35.8,132.3,44.9,89.9,52.5C28.6,63.7,0,0,0,0 h1000c0,0-9.9,40.9-83.6,48.1S829.6,47,766.1,28.9z"></path>
	</svg>
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
