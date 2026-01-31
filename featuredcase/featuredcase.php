<?php

if (! defined('ABSPATH')) {
    exit;
}

/*
Plugin Name: Technical Exercise Plugin
Description: Registers the Featured Case custom post type and related metadata for the technical exercise.
Version: 1.0.0
Author: Higor Christian
Author URI: https://www.linkedin.com/in/higor-ch-93b626348/
Text Domain: nanatomediatest
Domain Path: /languages
*/

define('NANATO_FEATURED_CASES_DIR_PATH', plugin_dir_path(__FILE__));
define('NANATO_FEATURED_CASES_DIR_URL', plugin_dir_url(__FILE__));

require NANATO_FEATURED_CASES_DIR_PATH . 'includes/featuredcase-register-cpt.php';
require NANATO_FEATURED_CASES_DIR_PATH . 'includes/featuredcase-register-admin-settings.php';
require NANATO_FEATURED_CASES_DIR_PATH . 'includes/featuredcase-add-metaboxes.php';
require NANATO_FEATURED_CASES_DIR_PATH . 'includes/featuredcase-add-shortcodes.php';

// Adjust permalinks for custom post types on activation
function featured_cases_activate()
{
    if (class_exists('FeaturedcaseRegisterCpt')) {
        $cpt = new FeaturedcaseRegisterCpt();
        $cpt->register_cpts();
    }

    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'featured_cases_activate');


// Reset permalinks on plugin deactivation
function featured_cases_deactivate()
{
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'featured_cases_deactivate');
