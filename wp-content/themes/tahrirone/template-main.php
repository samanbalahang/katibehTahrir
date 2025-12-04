<?php
/*
* Template name: banta
*/
get_header();
?>
<main class="w-full mt-8">
    <div class="container mx-auto">
        <section class="first-sliders w-full slider">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/3 px-2 mb-8">
                    <!-- Swiper -->
                    <div class="swiper mySwipera">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="w-full rounded-xl overflow-hidden">
                                    <?php
                                    $image = get_field("slide1");
                                    ?>
                                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="w-full rounded-xl overflow-hidden">
                                    <?php
                                    $image = get_field("slide2");
                                    ?>
                                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-8">
                    <!-- Swiper -->
                    <div class="swiper mySwiperb">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="w-full rounded-xl overflow-hidden">
                                    <?php
                                    $image = get_field("slide3");
                                    ?>
                                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="w-full rounded-xl overflow-hidden">
                                    <?php
                                    $image = get_field("slide4");
                                    ?>
                                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-8">
                    <!-- Swiper -->
                    <div class="swiper mySwiperc">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="w-full rounded-xl overflow-hidden">
                                    <?php
                                    $image = get_field("slide5");
                                    ?>
                                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="w-full rounded-xl overflow-hidden">
                                    <?php
                                    $image = get_field("slide6");
                                    ?>
                                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full my-8 category">
            <div class="flex flex-wrap">
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
                <div class="w-1/2 md:w-1/5 px-2">
                    <div class="overflow-hidden rounded-xl">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cat.jpg" alt="دسته بندی" class="w-full">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <section class="shegeft">
            <div class="flex justify-between items-center">
                <h2 class="font-bold md:text-2xl shegeft-title">
                    <?= the_field("shegeft") ?>
                </h2>
                <a href="<?= the_field("shegeftall") ?>" class="flex  border rounded-full p-2">
                    <?php $field = get_field_object('shegeftall');
                    echo $field['label'];
                    ?>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#1f1f1f">
                        <path d="M395-276 191-480l204-204 20 20-170 170h524v28H245l170 170-20 20Z" />
                    </svg>
                </a>
            </div>
            <div class="flex flex-wrap mt-10 mb-5">
                <div class="w-full md:w-10/100 px-4">
                    <?php
                    $image = get_field("shegeftper");
                    ?>
                    <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                </div>
                <div class="w-full md:w-90/100 px-4">
                    <!-- Swiper -->
                    <div class="swiper shegeftSwiper">
                        <div class="swiper-wrapper">
                            <?php
                            $sale_product_ids = wc_get_product_ids_on_sale();
                            $args = array(
                                'post_type'      => 'product',
                                'post_status'    => 'publish',
                                'order'          => 'DESC',
                                'posts_per_page' => 9,
                                'post__in'       => $sale_product_ids,
                            );
                            $productsLoop = new WP_Query($args);
                            // ---------------------------------------------------------------------
                            // Conditional Fallback Query: Show Random Products if Primary Fails
                            // ---------------------------------------------------------------------
                            $is_fallback = false;
                            // Check if the primary loop failed (no products on sale found)
                            if (! $productsLoop->have_posts()) {

                                $is_fallback = true;
                                $fallback_args  = array(
                                    'post_type'      => 'product',
                                    'post_status'    => 'publish',
                                    'tax_query'      => array(
                                        array(
                                            'taxonomy' => 'product_cat',
                                            'field'    => 'slug',
                                            'terms'    => 'shegeft',
                                        ),
                                    ),
                                    'posts_per_page' => 9,
                                    'order'          => 'DESC',
                                    'orderby'        => 'date',
                                );

                                // Re-assign productsLoop to the new fallback query
                                $productsLoop = new WP_Query($fallback_args);

                                // If even the fallback query finds nothing, exit
                                if (! $productsLoop->have_posts()) {
                                    return;
                                }
                            }


                            // ---------------------------------------------------------------------
                            // Display Logic
                            // ---------------------------------------------------------------------
                            if ($productsLoop->have_posts()) :
                                while ($productsLoop->have_posts()) : $productsLoop->the_post();

                                    $product = wc_get_product(get_the_ID());

                                    // --- Price Retrieval ---
                                    $regular_price = $product->get_regular_price();
                                    $sale_price    = $product->get_sale_price();
                                    // Use sale price if available, otherwise regular price
                                    $current_price = !empty($sale_price) ? $sale_price : $regular_price;
                                    $is_on_sale    = $product->is_on_sale();

                                    // --- Apply Toman Conversion ---
                                    // Assuming format_toman_price() is available and correctly formats the number with commas and Toman suffix/unit.
                                    $toman_regular_price = format_toman_price($regular_price);
                                    $toman_current_price = format_toman_price($current_price);

                                    // --- Calculate Discount Percentage (not used in this specific HTML structure, but kept for completeness) ---
                                    $discount_percentage = 0;
                                    if ($is_on_sale && !empty($regular_price) && floatval($regular_price) > 0) {
                                        $discount_amount = floatval($regular_price) - floatval($sale_price);
                                        $discount_percentage = round(($discount_amount / floatval($regular_price)) * 100);
                                    }
                            ?>
                                    <div class="swiper-slide">
                                        <div class="border rounded-xl flex flex-col bg-white p-4 overflow-hidden group">
                                            <!-- Product Image Link -->
                                            <a href="<?= get_permalink() ?>" class="block overflow-hidden rounded-lg">
                                                <?= woocommerce_get_product_thumbnail(); ?>
                                            </a>

                                            <!-- Product Title -->
                                            <h2 class="font-bold my-2">
                                                <a href="<?= get_permalink() ?>" class="hover:text-blue-600 transition-colors">
                                                    <?= get_the_title(); ?>
                                                </a>
                                            </h2>

                                            <!-- Price Section (Toman Price is assumed to be formatted already by format_toman_price) -->
                                            <div class="flex justify-center gap-1 items-center mt-auto">

                                                <!-- Regular Price (Strikethrough) -->
                                                <p class="text-secondary line-through text-xs">
                                                    <?php if ($is_on_sale) : ?>
                                                        <!-- Display the converted regular price, which now includes formatting -->
                                                        <?= $toman_regular_price ?>
                                                    <?php endif; ?>
                                                </p>

                                                <!-- Current Price -->
                                                <p class="bg-primary text-darkprim px-2 py-2 font-bold rounded-lg flex items-center">
                                                    <span>
                                                        <?= $toman_current_price; ?>
                                                    </span>
                                                    <span class="mr-1">
                                                        تومان
                                                    </span>
                                                </p>

                                            </div>

                                            <!-- Action Buttons (Add to Cart / Social) -->
                                            <div class="slider-addtocard flex justify-between items-center mt-3">

                                                <!-- Add to Cart Button (linked to product page for simplicity) -->
                                                <a href="<?= get_permalink() ?>" class="addtocard-button flex items-center justify-center p-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition-colors flex-grow">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor" class="ml-2">
                                                        <path d="M296-126q-23 0-38.5-15.5T242-180q0-23 15.5-38.5T296-234q23 0 38.5 15.5T350-180q0 23-15.5 38.5T296-126Zm368 0q-23 0-38.5-15.5T610-180q0-23 15.5-38.5T664-234q23 0 38.5 15.5T718-180q0 23-15.5 38.5T664-126ZM232-746l110 232h261q9 0 16-4.5t12-12.5l103-187q6-11 1-19.5t-17-8.5H232Zm-14-28h500q27 0 40.5 21.5T760-708L654-514q-8 13-20.5 20.5T606-486H324l-50 92q-8 12-.5 26t22.5 14h422v28H296q-32 0-47.5-26.5T248-406l62-110-148-310H92v-28h88l38 80Zm124 260h280-280Z" />
                                                    </svg>
                                                    <span>
                                                        افزودن به سبد خرید
                                                    </span>
                                                </a>

                                                <!-- Social Icons (Favorites, Quick View, Share) -->
                                                <div class="flex slider-social space-x-2 mr-2">

                                                    <!-- Favorites Icon -->
                                                    <a href="#" class="text-gray-500 hover:text-red-500 transition-colors p-2 rounded-full border border-gray-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                                            <path d="m480-190-22-20q-97-89-160.5-152t-100-110.5Q161-520 146.5-558T132-634q0-71 48.5-119.5T300-802q53 0 99 28.5t81 83.5q35-55 81-83.5t99-28.5q71 0 119.5 48.5T828-634q0 38-14.5 76t-51 85.5Q726-425 663-362T502-210l-22 20Zm0-38q96-87 158-149t98-107.5q36-45.5 50-80.5t14-69q0-60-40-100t-100-40q-48 0-88.5 27.5T494-660h-28q-38-60-78-87t-88-27q-59 0-99.5 40T160-634q0 34 14 69t50 80.5q36 45.5 98 107T480-228Zm0-273Z" />
                                                        </svg>
                                                    </a>

                                                    <!-- Quick View Icon -->
                                                    <a href="<?= get_permalink() ?>" class="text-gray-500 hover:text-blue-500 transition-colors p-2 rounded-full border border-gray-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                                            <path d="M778-164 528-414q-30 26-69 40t-77 14q-92.23 0-156.12-63.84-63.88-63.83-63.88-156Q162-672 225.84-736q63.83-64 156-64Q474-800 538-736.12q64 63.89 64 156.12 0 41-15 80t-39 66l250 250-20 20ZM382-388q81 0 136.5-55.5T574-580q0-81-55.5-136.5T382-772q-81 0-136.5 55.5T190-580q0 81 55.5 136.5T382-388Z" />
                                                        </svg>
                                                    </a>

                                                    <!-- Share Icon -->
                                                    <a href="<?= get_permalink() ?>" class="text-gray-500 hover:text-green-500 transition-colors p-2 rounded-full border border-gray-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor">
                                                            <path d="M572-212v-28h130L557-385l20-20 143 143v-123h28v173H572Zm-340 0-20-20 488-488H572v-28h176v173h-28v-125L232-212Zm146-351L212-729l19-19 166 166-19 19Z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-4 porfroshtarin">
            <h2 class="font-bold text-xl text-center">
                <span class="rounded-full px-4 line-left-right">
                    <?= the_field("selltitle") ?>
                </span>
            </h2>
            <div class="px-13 relative sellerSwiper-parent my-8">
                <!-- Swiper -->
                <div class="swiper sellerSwiper">
                    <div class="swiper-wrapper">
                        <?php


                        // --- Dynamic Query Logic (Best-Seller/Random Fallback) ---
                        $args_bestseller = array(
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'posts_per_page' => 9,
                            'orderby'        => 'meta_value_num',
                            'meta_key'       => 'total_sales',
                            'order'          => 'DESC',
                            'meta_query'     => array(
                                array(
                                    'key'     => 'total_sales',
                                    'value'   => 0,
                                    'compare' => '>',
                                    'type'    => 'NUMERIC'
                                )
                            )
                        );
                        $productsLoop = new WP_Query($args_bestseller);

                        if (!$productsLoop->have_posts()) {
                            $args_random = array(
                                'post_type'      => 'product',
                                'post_status'    => 'publish',
                                'tax_query'      => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'slug',
                                        'terms'    => 'porfroshtarin',
                                    ),
                                ),
                                'posts_per_page' => 9,
                                'orderby'        => 'rand'
                            );
                            $productsLoop = new WP_Query($args_random);
                        }


                        if ($productsLoop->have_posts()) :
                            while ($productsLoop->have_posts()) : $productsLoop->the_post();

                                $product = wc_get_product(get_the_ID());

                                // --- Price Retrieval ---
                                $regular_price = $product->get_regular_price();
                                $sale_price    = $product->get_sale_price();
                                $current_price = !empty($sale_price) ? $sale_price : $regular_price;
                                $is_on_sale    = $product->is_on_sale();

                                // --- Apply Toman Conversion ---
                                $toman_regular_price = format_toman_price($regular_price);
                                $toman_current_price = format_toman_price($current_price);

                                // --- Calculate Discount Percentage (Only needed if on sale) ---
                                $discount_percentage = 0;
                                if ($is_on_sale && !empty($regular_price) && floatval($regular_price) > 0) {
                                    $discount_amount = floatval($regular_price) - floatval($sale_price);
                                    // Calculate percentage and round it up/down as needed
                                    $discount_percentage = round(($discount_amount / floatval($regular_price)) * 100);
                                }

                                // --- Start Product HTML Output ---
                        ?>
                                <div class="swiper-slide">
                                    <div class="rounded-xl border overflow-hidden p-4 relative group">
                                        <a href="<?= get_permalink() ?>">
                                            <?= woocommerce_get_product_thumbnail(); ?>
                                        </a>
                                        <h2 class="font-bold my-2">
                                            <a href="<?= get_permalink() ?>">
                                                <?= get_the_title(); ?>
                                            </a>
                                        </h2>
                                        <hr>

                                        <a href="<?= get_permalink() ?>">
                                            <div class="flex justify-end my-5">
                                                <div class="flex flex-col">

                                                    <?php if ($is_on_sale) : ?>
                                                        <span class="line-through">
                                                            <?= $toman_regular_price ?>
                                                        </span>
                                                    <?php endif; ?>

                                                    <span class="font-bold">
                                                        <?= $toman_current_price ?> تومان
                                                    </span>
                                                </div>

                                                <?php if ($is_on_sale && $discount_percentage > 0) : ?>
                                                    <span
                                                        class="bg-darkprim flex justify-center items-center text-white rounded-full px-4">
                                                        <?= $discount_percentage ?>%
                                                    </span>
                                                <?php endif; ?>

                                            </div>
                                        </a>

                                        <div
                                            class="absolute w-35/100 rounded-full border flex justify-between items-center p-4 -top-20 left-50/100 -translate-x-50/100 bg-white group-hover:top-50/100 duration-220 ">
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                                                    <path d="m480-190-22-20q-97-89-160.5-152t-100-110.5Q161-520 146.5-558T132-634q0-71 48.5-119.5T300-802q53 0 99 28.5t81 83.5q35-55 81-83.5t99-28.5q71 0 119.5 48.5T828-634q0 38-14.5 76t-51 85.5Q726-425 663-362T502-210l-22 20Zm0-38q96-87 158-149t98-107.5q36-45.5 50-80.5t14-69q0-60-40-100t-100-40q-48 0-88.5 27.5T494-660h-28q-38-60-78-87t-88-27q-59 0-99.5 40T160-634q0 34 14 69t50 80.5q36 45.5 98 107T480-228Zm0-273Z"></path>
                                                </svg>
                                            </a>
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                                                    <path d="M778-164 528-414q-30 26-69 40t-77 14q-92.23 0-156.12-63.84-63.88-63.83-63.88-156Q162-672 225.84-736q63.83-64 156-64Q474-800 538-736.12q64 63.89 64 156.12 0 41-15 80t-39 66l250 250-20 20ZM382-388q81 0 136.5-55.5T574-580q0-81-55.5-136.5T382-772q-81 0-136.5 55.5T190-580q0 81 55.5 136.5T382-388Z"></path>
                                                </svg>
                                            </a>
                                            <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f">
                                                    <path d="M572-212v-28h130L557-385l20-20 143 143v-123h28v173H572Zm-340 0-20-20 488-488H572v-28h176v173h-28v-125L232-212Zm146-351L212-729l19-19 166 166-19 19Z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <?php
            // Retrieve the ACF Link field value
            $link = get_field('sellslink');

            // Check if the link field has a value before trying to display it
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <a href="<?= esc_url($link_url); ?>"
                    target="<?= esc_attr($link_target); ?>"
                    class="block mx-auto border border-darkprim rounded-full px-8 py-2 text-darkprim w-80/100 md:w-20/100 text-center">
                    <?= esc_html($link_title ? $link_title : 'مشاهده همه'); ?>
                </a>
            <?php endif; ?>
        </section>
        <section class="w-full my-10 khadamat">
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/4 px-4">
                    <div class="ad flex flex-col justify-center items-center">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/services.png" alt="services">
                        <h2 class="font-bold">
                            <?= the_field('services') ?>
                        </h2>
                        <p class="text-center">
                            <?= the_field('servicestext') ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-4">
                    <div class="ad flex flex-col justify-center items-center">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/zemanat.png" alt="services">
                        <h2 class="font-bold">
                            <?= the_field('zemanat') ?>
                        </h2>
                        <p class="text-center">
                            <?= the_field('zemanattext') ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-4">
                    <div class="ad flex flex-col justify-center items-center">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/esalat.png" alt="services">
                        <h2 class="font-bold">
                            <?= the_field('esalat') ?>
                        </h2>
                        <p class="text-center">
                            <?= the_field('esalattext') ?>
                        </p>
                    </div>
                </div>
                <div class="w-full md:w-1/4 px-4">
                    <div class="ad flex flex-col justify-center items-center">
                        <img src="<?= get_template_directory_uri() ?>/assets/images/fast.png" alt="services">
                        <h2 class="font-bold">
                            <?= the_field('fast') ?>
                        </h2>
                        <p class="text-center">
                            <?= the_field('fasttext') ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <section class="w-full bg-third py-8 brands">
        <div class="container mx-auto">
            <h2 class="text-center font-bold md:text-2xl">
                <span class="px-4 line-left-right">
                    <?= the_field('bestbrands') ?>
                </span>
            </h2>
            <!-- Swiper -->
            <div class="swiper brandsSwiper my-8">
                <div class="swiper-wrapper">
                    <?php
                    $args = array(
                        'post_type' => 'costomerbrandlogos',
                        'order' => 'desc',
                        'posts_per_page' => -1
                    );
                    $productsLoop = new WP_Query($args);
                    if ($productsLoop->have_posts()) {
                        global $post;
                        while ($productsLoop->have_posts()) : $productsLoop->the_post();
                    ?>
                            <div class="swiper-slide">
                                <div class="h-65">
                                    <div class="bg-white">
                                        <a href="<?= get_permalink() ?>">
                                            <?= the_post_thumbnail('medium'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php
                            wp_reset_postdata();
                        endwhile;
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <a href="/costomerbrands-logos"
            class="block mx-auto border border-darkprim rounded-full px-8 py-2 text-darkprim w-80/100 md:w-20/100 text-center">
            مشاهده همه برندها
        </a>
    </section>
    <section class="container mx-auto my-10 blogs">
        <h2 class="text-center font-bold md:text-2xl">
            <span class="px-4 line-left-right">
                <?= the_field('blog') ?>
            </span>
        </h2>
        <div class="flex flex-wrap my-8">
            <?php
            $args = array(
                'post_type'      => 'post',      // Querying standard posts
                'order'          => 'DESC',      // Newest posts first
                'posts_per_page' => 4,           // Limit to the last 4 posts
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'category', // The standard taxonomy for posts
                        'field'    => 'slug',      // KEY CHANGE: Use the category slug
                        'terms'    => 'blogs',     // KEY CHANGE: Use the category name (slug) 'blogs'
                    ),
                )
            );

            $blogsLoop = new WP_Query($args); // Renamed variable for clarity

            if ($blogsLoop->have_posts()) {
                while ($blogsLoop->have_posts()) : $blogsLoop->the_post();
            ?>
                    <div class="w-full md:w-1/4 px-4 my-4">
                        <div class="bg-primary rounded-lg pl-4 pt-4">
                            <div class="bg-white rounded-lg p-4">
                                <a href="#">
                                    <img src="<?= get_the_post_thumbnail_url() ?>" alt="<?= get_the_title() ?>" class="w-full rounded-lg">
                                </a>
                                <h2 class="text-center font-bold">
                                    <?= get_the_title(); ?>
                                </h2>
                                <div class="flex text-darkprim">
                                    <p class="flex text-darkprim">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" class="fill-darkprim">
                                            <path
                                                d="M602-315 466-451v-193h28v182l127 127-19 20ZM466-720v-80h28v80h-28Zm254 254v-28h80v28h-80ZM466-160v-80h28v80h-28ZM160-466v-28h80v28h-80Zm320.17 334q-72.17 0-135.73-27.39-63.56-27.39-110.57-74.35-47.02-46.96-74.44-110.43Q132-407.65 132-479.83q0-72.17 27.39-135.73 27.39-63.56 74.35-110.57 46.96-47.02 110.43-74.44Q407.65-828 479.83-828q72.17 0 135.73 27.39 63.56 27.39 110.57 74.35 47.02 46.96 74.44 110.43Q828-552.35 828-480.17q0 72.17-27.39 135.73-27.39 63.56-74.35 110.57-46.96 47.02-110.43 74.44Q552.35-132 480.17-132Zm-.17-28q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                                        </svg>
                                        <?= get_the_date('F j, Y'); ?>
                                        ۳ مرداد ۱۴۰۱
                                    </p>
                                    <p class="flex text-darkprim">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                            width="24px" class="fill-darkprim">
                                            <path
                                                d="M480.24-364q56.76 0 96.26-39.74 39.5-39.73 39.5-96.5 0-56.76-39.74-96.26-39.73-39.5-96.5-39.5-56.76 0-96.26 39.74-39.5 39.73-39.5 96.5 0 56.76 39.74 96.26 39.73 39.5 96.5 39.5Zm-.24-28q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm.14 140Q355-252 252-319.5 149-387 96-500q53-113 155.86-180.5 102.85-67.5 228-67.5Q605-748 708-680.5 811-613 864-500q-53 113-155.86 180.5-102.85 67.5-228 67.5ZM480-500Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z" />
                                        </svg>

                                        <?php echo ($views = get_post_views(get_the_ID())) === '0' ? mt_rand(70, 1000) : $views; ?>
                                    </p>
                                </div>
                                <a href="#"
                                    class="flex w-80/100 mx-auto mt-8 mb-2 rounded-lg text-primary bg-darkprim px-4 py-2 text-center justify-center hover:bg-primary hover:text-darkprim group hover:border hover:border-darkprim">
                                    مشاهده
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#1f1f1f" class="fill-primary group-hover:fill-darkprim">
                                        <path d="M395-276 191-480l204-204 20 20-170 170h524v28H245l170 170-20 20Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

            <?php
                endwhile;
                wp_reset_postdata(); // Important: Restore the original global post data
            } else {
                // No blog posts found in the 'blogs' category
                echo '<p>No recent blog posts available.</p>';
            }
            ?>
            <?php
            // Retrieve the ACF Link field value
            $link = get_field('all_products_link');

            // Check if the link field has a value before trying to display it
            if ($link):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>

                <a href="<?= esc_url($link_url); ?>"

                    class="block mx-auto border border-darkprim rounded-full px-8 py-2 text-darkprim w-80/100 md:w-20/100 text-center my-8">
                    مشاهده همه
                </a>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php
get_footer("banta");
