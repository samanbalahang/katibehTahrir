<?php

/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 *
 * 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>banta</title>
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?= get_template_directory_uri() ?>/assets/css/style.css">
    <link rel="shortcut icon" href="images/banta-fav.ico" type="image/x-icon">
    <!-- https://banta-fashion.bantaco.ir/ -->
    <?php wp_head(); ?>
</head>

<body>
    <header class="flex lg:hidden">
        <div class="flex justify-between items-center w-full p-4">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="block w-20/100">
                <img src="<?= get_site_icon_url() ?>" alt="<?= get_bloginfo('name') ?>" class="w-full">
            </a>
            <div class="flex gap-1">
                <?php
                $cart_url = wc_get_cart_url();
                ?>
                <a href="<?= esc_url($cart_url); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#1f1f1f">
                        <path
                            d="M296-126q-23 0-38.5-15.5T242-180q0-23 15.5-38.5T296-234q23 0 38.5 15.5T350-180q0 23-15.5 38.5T296-126Zm368 0q-23 0-38.5-15.5T610-180q0-23 15.5-38.5T664-234q23 0 38.5 15.5T718-180q0 23-15.5 38.5T664-126ZM218-774h500q27 0 40.5 21.5T760-708L654-514q-8 13-20.5 20.5T606-486H324l-50 92q-8 12-.5 26t22.5 14h422v28H296q-32 0-47.5-26.5T248-406l62-110-148-310H92v-28h88l38 80Z" />
                    </svg>
                </a>
                <a href="/جستجو/" class="bg-primary text-darkprim rounded-lg p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        class="fill-darkprim">
                        <path
                            d="M480-512q-44.55 0-76.27-31.72Q372-575.45 372-620t31.73-76.28Q435.45-728 480-728t76.28 31.72Q588-664.55 588-620t-31.72 76.28Q524.55-512 480-512ZM212-232v-52q0-22 13.5-41.5T262-356q55-26 109.5-39T480-408q54 0 108.5 13T698-356q23 11 36.5 30.5T748-284v52H212Z" />
                    </svg>
                </a>
                <a href="/جستجو/" class="bg-primary text-darkprim rounded-lg p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#1f1f1f" class="fill-darkprim">
                        <path
                            d="M778-164 528-414q-30 26-69 40t-77 14q-92.23 0-156.12-63.84-63.88-63.83-63.88-156Q162-672 225.84-736q63.83-64 156-64Q474-800 538-736.12q64 63.89 64 156.12 0 41-15 80t-39 66l250 250-20 20ZM382-388q81 0 136.5-55.5T574-580q0-81-55.5-136.5T382-772q-81 0-136.5 55.5T190-580q0 81 55.5 136.5T382-388Z" />
                    </svg>
                </a>
                <a href="#" class="bg-primary text-darkprim rounded-lg p-2" id="bars">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#1f1f1f" class="fill-darkprim">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>
    <header class="container lg:mx-auto lg:py-4 lg:border-b">
        <div class="top hidden lg:flex justify-between items-center ">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="rounded-full px-4 w-9/100">
                <img src="<?= get_site_icon_url() ?>" alt="<?= get_bloginfo('name') ?>" class="w-full">
            </a>
            <form action="<?php echo esc_url(home_url('/')); ?>" class="flex items-center bg-third rounded-full w-50/100">
                <span class="p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#1f1f1f">
                        <path
                            d="M778-164 528-414q-30 26-69 40t-77 14q-92.23 0-156.12-63.84-63.88-63.83-63.88-156Q162-672 225.84-736q63.83-64 156-64Q474-800 538-736.12q64 63.89 64 156.12 0 41-15 80t-39 66l250 250-20 20ZM382-388q81 0 136.5-55.5T574-580q0-81-55.5-136.5T382-772q-81 0-136.5 55.5T190-580q0 81 55.5 136.5T382-388Z" />
                    </svg>
                </span>
                <input type="text" placeholder="جستجو در میان صدها برند معتبر" class="rounded-full w-full pr-5 p-4" name="s">
            </form>
            <div class="flex items-center gap-4">
                <a href="<?= esc_url($cart_url); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#1f1f1f">
                        <path
                            d="M296-126q-23 0-38.5-15.5T242-180q0-23 15.5-38.5T296-234q23 0 38.5 15.5T350-180q0 23-15.5 38.5T296-126Zm368 0q-23 0-38.5-15.5T610-180q0-23 15.5-38.5T664-234q23 0 38.5 15.5T718-180q0 23-15.5 38.5T664-126ZM218-774h500q27 0 40.5 21.5T760-708L654-514q-8 13-20.5 20.5T606-486H324l-50 92q-8 12-.5 26t22.5 14h422v28H296q-32 0-47.5-26.5T248-406l62-110-148-310H92v-28h88l38 80Z" />
                    </svg>
                </a>
                <a href="<?= esc_url($cart_url); ?>" class="flex bg-primary! text-darkprim! visited:text-darkprim! px-4 py-2 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        class="fill-darkprim">
                        <path
                            d="M480-512q-44.55 0-76.27-31.72Q372-575.45 372-620t31.73-76.28Q435.45-728 480-728t76.28 31.72Q588-664.55 588-620t-31.72 76.28Q524.55-512 480-512ZM212-232v-52q0-22 13.5-41.5T262-356q55-26 109.5-39T480-408q54 0 108.5 13T698-356q23 11 36.5 30.5T748-284v52H212Z" />
                    </svg>
                    ورود/ثبت‌نام
                </a>
            </div>
        </div>
        <div class="main">
            <div class="fixed top-3 right-100/100 w-80/100 h-[90vh] lg:h-auto bg-white lg:bg-transparent rounded-2xl shadow-xl lg:shadow-none lg:rounded-none lg:static lg:w-80/100 lg:mx-auto wp-menu-contianer z-5 overflow-y-scroll lg:overflow-visible p-8 lg:p-0" id="mainheader">
                <?php
                $args = array(
                    'container' => false,
                    'theme_location' => 'menu-1',
                    'items_wrap' => '<ul class="primary">%3$s</ul>',
                );
                wp_nav_menu($args);
                ?>
            </div>
        </div>
    </header>