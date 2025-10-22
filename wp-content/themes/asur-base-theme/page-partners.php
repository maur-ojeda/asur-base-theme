<?php
get_header(); ?>
<main id="main-content">
        <?php get_template_part('template-parts/section', 'hero'); ?>
        <div class="m-krom">
                <?php get_template_part('template-parts/section', 'info-block', ['index' => 0]); ?>
        </div>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'partners-carousel', ['index' => 0]); ?>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'call-to-action'); ?>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'partners-carousel', ['index' => 1]); ?>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'partners-carousel', ['index' => 2]); ?>

        <?php get_template_part('template-parts/section', 'service-cycle', ['index' => 2]); ?>


        <?php get_template_part('template-parts/section', 'partners-carousel', ['index' => 3]); ?>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'call-to-action', ['index' => 1]); ?>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'partners-carousel', ['index' => 4]); ?>



        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'technological-solutions-carousel'); ?>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'form-home'); ?>
</main>


<?php get_footer(); ?>