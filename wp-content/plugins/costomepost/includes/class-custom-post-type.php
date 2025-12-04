<?php
/**
 * Custom Post Type Handler
 */

if (!defined('ABSPATH')) {
    exit;
}

class CustomPostTypePlugin
{
    public function __construct()
    {
        add_action('init', array($this, 'register_custom_post_type'));
        add_action('init', array($this, 'register_custom_taxonomy'));
    }

    public function register_custom_post_type()
    {
        $labels = array(
            'name'               => 'costomerbrands Logos',
            'singular_name'      => 'costomerbrands Logo',
            'menu_name'          => 'costomerbrands Logos',
            'name_admin_bar'     => 'costomerbrands Logo',
            'add_new'            => 'Add New',
            'add_new_item'       => 'Add New costomerbrands Logo',
            'new_item'           => 'New costomerbrands Logo',
            'edit_item'          => 'Edit costomerbrands Logo',
            'view_item'          => 'View costomerbrands Logo',
            'all_items'          => 'All costomerbrands Logos',
            'search_items'       => 'Search costomerbrands Logos',
            'parent_item_colon'  => 'Parent costomerbrands Logos:',
            'not_found'          => 'No costomerbrands logos found.',
            'not_found_in_trash' => 'No costomerbrands logos found in Trash.'
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => 'costomerbrands-logos'),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 5,
            'menu_icon'          => 'dashicons-format-image',
            'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
            'show_in_rest'       => true
        );

        register_post_type('costomerbrandlogos', $args);
    }

    public function register_custom_taxonomy()
    {
        $labels = array(
            'name'              => 'Logo Categories',
            'singular_name'     => 'Logo Category',
            'search_items'      => 'Search Logo Categories',
            'all_items'         => 'All Logo Categories',
            'parent_item'       => 'Parent Logo Category',
            'parent_item_colon' => 'Parent Logo Category:',
            'edit_item'         => 'Edit Logo Category',
            'update_item'       => 'Update Logo Category',
            'add_new_item'      => 'Add New Logo Category',
            'new_item_name'     => 'New Logo Category Name',
            'menu_name'         => 'Logo Categories',
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'logo-category'),
            'show_in_rest'      => true,
        );

        register_taxonomy('logo_category', array('costomerbrandlogos'), $args);
    }
}