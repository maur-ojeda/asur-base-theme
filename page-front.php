<?php
/* Template Name: Front Page OnePage */

get_header();
?>

<main id="main-content d-none">
        <?php get_template_part('template-parts/section', 'hero'); ?>
        <?php get_template_part('template-parts/section', 'services'); ?>
        <?php get_template_part('template-parts/section', 'whatwedo'); ?>
        <?php get_template_part('template-parts/section', 'products'); ?>
        <?php get_template_part('template-parts/section', 'gallerie'); ?>
        <?php get_template_part('template-parts/section', 'clients'); ?>
        <?php get_template_part('template-parts/section', 'testimonial'); ?>
        <?php get_template_part('template-parts/section', 'contact'); ?>
    </main>

<?php get_footer(); ?>
