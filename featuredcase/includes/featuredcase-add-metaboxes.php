<?php

class FeaturedcaseAddMetaboxes
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'register_metaboxes'));
        add_action('save_post', array($this, 'save_metabox'));
    }

    public function register_metaboxes()
    {
        add_meta_box('featured_case_details', __('Case Details', 'nanatomediatest'), array($this, 'metabox_html'), array('featured-case'), 'normal', 'high');
    }

    public function metabox_html($post)
    {
        $case_type = get_post_meta($post->ID, '_case_type', true);
        $settlement_amount = get_post_meta($post->ID, '_settlement_amount', true);

        wp_nonce_field('featured_case_details_save', 'featured_case_details_nonce');

        echo '<table class="form-table" role="presentation">';

        echo '<tr>
                <th scope="row"><label for="case_type">' . esc_html__('Case Type', 'nanatomediatest') . '</label></th>
                <td><input type="text" id="case_type" name="case_type" value="' . esc_attr($case_type) . '" style="width:100%;" placeholder="e.g. Car Accident, Work Injury"></td>
              </tr>';

        echo '<tr>
                <th scope="row"><label for="settlement_amount">' . esc_html__('Settlement Amount', 'nanatomediatest') . '</label></th>
                <td><input type="text" id="settlement_amount" name="settlement_amount" value="' . esc_attr($settlement_amount) . '" style="width:100%;" placeholder="$25,000"></td>
              </tr>';

        echo '</table>';
    }

    public function save_metabox($post_id)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (wp_is_post_revision($post_id)) return;

        if (
            empty($_POST['featured_case_details_nonce']) ||
            !wp_verify_nonce($_POST['featured_case_details_nonce'], 'featured_case_details_save')
        ) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) return;

        if (isset($_POST['case_type'])) {
            update_post_meta($post_id, '_case_type', sanitize_text_field(wp_unslash($_POST['case_type'])));
        }

        if (isset($_POST['settlement_amount'])) {
            update_post_meta($post_id, '_settlement_amount', sanitize_text_field(wp_unslash($_POST['settlement_amount'])));
        }
    }
}

new FeaturedcaseAddMetaboxes();
