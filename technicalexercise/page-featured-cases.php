<?php
/*
Template Name: Featured Cases
*/

if (! defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="featured-cases-page">
    <?php echo do_shortcode('[featured_cases]'); ?>
</div>

<?php
get_footer();
