<?php
/*
Template Name: Featured Cases
*/

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="featured-cases">

    <?php
    $options = get_option('featured_cases_options');
    $posts_per_page = isset($options['posts_per_page']) ? intval($options['posts_per_page']) : 3;

    $query = new WP_Query(array(
        'post_type' => 'featured-case',
        'posts_per_page' => $posts_per_page,
        'post_status' => 'publish',
    ));

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            $case_type = get_post_meta(get_the_ID(), '_case_type', true);
            $settlement_amount = get_post_meta(get_the_ID(), '_settlement_amount', true);
    ?>

            <div class="featured-case">
                <h3 class="featured-case__title"><?php the_title(); ?></h3>
                <p class="featured-case__type"><?php echo esc_html($case_type); ?></p>
                <p class="featured-case__settlement"><?php echo esc_html($settlement_amount); ?></p>
            </div>

        <?php
        endwhile;
        wp_reset_postdata();
    else :
        ?>
        <p class="featured-cases__empty">No featured cases found.</p>
    <?php endif; ?>

</div>

<?php
get_footer();
