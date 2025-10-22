<?php
get_header();
$bg_imagen_url = carbon_get_the_post_meta('bg_company_imagen');
$items = carbon_get_the_post_meta('crb_company_items');

?>

<main id="main-content">
        <?php get_template_part('template-parts/section', 'hero'); ?>

        <div class="m-krom"><?php get_template_part('template-parts/section', 'info-block', ['index' => 0]); ?></div>
        <div class="m-krom"><?php get_template_part('template-parts/section', 'company-info-carousel'); ?></div>


        <div class="m-krom"><?php get_template_part('template-parts/section', 'info-block', ['index' => 1]); ?></div>
        <?php get_template_part('template-parts/section', 'company-team-picture'); ?>
        <?php get_template_part('template-parts/section', 'call-to-action', ['index' => 0]); ?>
        <?php get_template_part('template-parts/section', 'service-cycle'); ?>
        <?php get_template_part('template-parts/section', 'info-block', ['index' => 2]); ?>
        <?php get_template_part('template-parts/section', 'info-block', ['index' => 3]); ?>
        <?php get_template_part('template-parts/section', 'info-block', ['index' => 4]); ?>


        <div class="bg-discovery">


                <?php get_template_part('template-parts/section', 'presence', ['index' => 1]); ?>


        </div>



        <?php get_template_part('template-parts/section', 'innovation-projects-carousel'); ?>
        <?php get_template_part('template-parts/section', 'partners'); ?>
        <?php get_template_part('template-parts/section', 'form-home'); ?>
</main>


<?php get_footer(); ?>