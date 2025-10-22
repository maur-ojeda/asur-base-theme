<?php
get_header(); ?>
<main id="main-content">
        <?php get_template_part('template-parts/section', 'hero'); ?>
        <?php get_template_part('template-parts/section', 'info-block', ['index' => 0]); ?>
        <div class="m-krom"></div>

        <?php get_template_part('template-parts/section', 'form-contact'); ?>
        <div class="m-krom"></div>


        <?php get_template_part('template-parts/section', 'map'); ?>

</main>


<?php get_footer(); ?>