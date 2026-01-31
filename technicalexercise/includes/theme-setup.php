<?php

if (!defined('ABSPATH')) exit;

class ThemeSetup
{
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'theme_setup'));
        add_action('wp_enqueue_scripts',  array($this, 'enqueue_scripts'));

        // redirect 404 to home permanent (301)
        add_action('wp_enqueue_scripts', function () {
            if (is_404()) {
                wp_redirect(home_url(), '301');
            }
        });
    }

    public function theme_setup()
    {
        add_theme_support('post-thumbnails');
        add_theme_support('responsive-embeds');
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('theme', get_template_directory_uri() . '/assets/css/theme.css', null, '1.0.0');
        wp_enqueue_script('theme', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.0.0', true);
    }
}

new ThemeSetup();
