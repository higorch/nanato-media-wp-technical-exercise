<?php

if (!defined('ABSPATH')) {
    exit;
}

class FeaturedcaseAddShortcodes
{
    public function __construct()
    {
        add_shortcode('featured_cases', array($this, 'featured_cases_shortcode'));
    }

    public function featured_cases_shortcode($atts)
    {
        ob_start();

        $view_path = NANATO_FEATURED_CASES_DIR_PATH . 'templates/featured-cases.php';

        if (file_exists($view_path)) {
            include $view_path;
        }

        return ob_get_clean();
    }
}

new FeaturedcaseAddShortcodes();
