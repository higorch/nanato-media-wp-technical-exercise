<?php

if (!defined('ABSPATH')) {
    exit;
}

class FeaturedcaseRegisterCpt
{
    public function __construct()
    {
        add_action('init', array($this, 'register_cpts'));
    }

    public function register_cpts()
    {
        $this->pt_featured_cases();
    }

    public function pt_featured_cases()
    {
        $labels = array(
            'name' => __("Featured Cases", 'nanatomediatest'),
            'singular_name' => __("Featured Case", 'nanatomediatest'),
            'menu_name' => __("Featured Cases", 'nanatomediatest'),
            'name_admin_bar' => __("Featured Case", 'nanatomediatest'),
            'add_new' => __("Add New", 'nanatomediatest'),
            'add_new_item' => __("Add New Case", 'nanatomediatest'),
            'new_item' => __("New Case", 'nanatomediatest'),
            'edit_item' => __("Edit Case", 'nanatomediatest'),
            'view_item' => __("View Case", 'nanatomediatest'),
            'all_items' => __("All Cases", 'nanatomediatest'),
            'search_items' => __("Search Cases", 'nanatomediatest'),
            'not_found' => __("No cases found.", 'nanatomediatest'),
            'not_found_in_trash' => __("No cases found in the Trash.", 'nanatomediatest'),
            'featured_image' => __("Case Featured Image", 'nanatomediatest'),
            'set_featured_image' => __("Set featured image", 'nanatomediatest'),
            'remove_featured_image' => __("Remove featured image", 'nanatomediatest'),
            'use_featured_image' => __("Use as featured image", 'nanatomediatest'),
            'archives' => __("Case Archives", 'nanatomediatest'),
            'insert_into_item' => __("Insert into case", 'nanatomediatest'),
            'uploaded_to_this_item' => __("Uploaded to this case", 'nanatomediatest'),
            'filter_items_list' => __("Filter cases list", 'nanatomediatest'),
            'items_list_navigation' => __("Cases list navigation", 'nanatomediatest'),
            'items_list' => __("Cases list", 'nanatomediatest'),
        );

        $args = array(
            'labels' => $labels,
            'public' => false,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'featured-case'),
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title'),
            'menu_icon' => 'dashicons-awards',
        );

        register_post_type('featured-case', $args);
    }
}

new FeaturedcaseRegisterCpt();
