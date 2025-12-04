<?php
/**
 * Plugin Name: Custom Post Type Manager
 * Description: Comprehensive plugin with custom post types and more
 * Version: 1.0
 * Author: saman balahang (sambal)
 * Text Domain: custom-post-plugin
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('CUSTOM_POST_MANAGER_DIR', plugin_dir_path(__FILE__));
define('CUSTOM_POST_MANAGER_URL', plugin_dir_url(__FILE__));

class CustomPostManager
{
    public function __construct()
    {
        $this->load_dependencies();
        $this->init_components();
    }

    private function load_dependencies()
    {
        // Load the custom post type class
        require_once CUSTOM_POST_MANAGER_DIR . 'includes/class-custom-post-type.php';
        
        // Load other dependencies here
        // require_once YMP_PLUGIN_DIR . 'includes/other-class.php';
    }

    private function init_components()
    {
        // Initialize custom post type
        new CustomPostTypePlugin();
        
        // Initialize other components here
        // new OtherFeatureClass();
    }

    // Activation and deactivation hooks
    public static function activate()
    {
        // Flush rewrite rules on activation
        flush_rewrite_rules();
    }

    public static function deactivate()
    {
        // Clean up if needed
        flush_rewrite_rules();
    }
}

// Initialize the main plugin
new CustomPostManager();

// Register activation and deactivation hooks
register_activation_hook(__FILE__, array('CustomPostManager', 'activate'));
register_deactivation_hook(__FILE__, array('CustomPostManager', 'deactivate'));
