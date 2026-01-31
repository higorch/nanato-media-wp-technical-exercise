<?php

if (!defined('ABSPATH')) {
    exit;
}

class FeaturedCasesAdminSettings
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'menu_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    public function menu_page()
    {
        add_options_page(__('Featured Cases', 'nanatomediatest'), __('Featured Cases', 'nanatomediatest'), 'manage_options', 'featured-cases-settings', array($this, 'configs'));
    }

    public function configs()
    {
?>
        <div class="wrap">
            <h1><?php esc_html_e('Featured Cases Settings', 'nanatomediatest'); ?></h1>
            <form method="post" action="options.php">
                <?php settings_fields('featured_cases_settings');
                do_settings_sections('featured-cases-settings');
                submit_button(); ?>
            </form>
        </div>
<?php
    }

    public function register_settings()
    {
        register_setting('featured_cases_settings', 'featured_cases_options', array($this, 'sanitize'));
        add_settings_section('featured_cases_main', __('Display Settings', 'nanatomediatest'), '__return_false', 'featured-cases-settings');
        add_settings_field('posts_per_page', __('Number of cases to display', 'nanatomediatest'), array($this, 'input_posts_per_page'), 'featured-cases-settings', 'featured_cases_main');
    }

    public function input_posts_per_page()
    {
        $options = get_option('featured_cases_options');
        $value = isset($options['posts_per_page']) ? intval($options['posts_per_page']) : 3;

        printf('<input type="number" min="1" step="1" name="featured_cases_options[posts_per_page]" value="%d" />', $value);
    }

    public function sanitize($input)
    {
        $output = array();

        if (isset($input['posts_per_page'])) {
            $output['posts_per_page'] = max(1, intval($input['posts_per_page']));
        }

        return $output;
    }
}

new FeaturedCasesAdminSettings();
