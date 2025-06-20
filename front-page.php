<?php
/* Template Name: Front Page OnePage */

get_header();
?>

<main id="main-content">

    
        <?php get_template_part('template-parts/section', 'hero'); ?>
    

    
        <?php get_template_part('template-parts/section', 'services'); ?>
    

    
        <?php get_template_part('template-parts/section', 'whatwedo'); ?>
    

    <section id="products">
        <?php get_template_part('template-parts/section', 'products'); ?>
    </section>

    <section id="gallerie">
        <?php get_template_part('template-parts/section', 'gallerie'); ?>
    </section>

    <section id="clients">
        <?php get_template_part('template-parts/section', 'clients'); ?>
    </section>

    <section id="testimonial">
        <?php get_template_part('template-parts/section', 'testimonial'); ?>
    </section>

    <section id="contact">
        <?php get_template_part('template-parts/section', 'contact'); ?>
    </section>

</main>

<?php get_footer(); ?>
