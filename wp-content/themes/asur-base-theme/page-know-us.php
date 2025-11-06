<?php
get_header(); ?>
<main id="main-content">
        <?php get_template_part('template-parts/section', 'hero'); ?>

        <div class="m-krom"><?php get_template_part('template-parts/section', 'team-know-us-carousel'); ?></div>
        <div class="m-krom"></div>
        <?php get_template_part('template-parts/section', 'service-cycle'); ?>
        <div class="m-krom">
                <?php get_template_part('template-parts/section', 'company-team-picture'); ?>
                <?php get_template_part('template-parts/section', 'call-to-action'); ?>
        </div>
        <div class="m-krom">
                <?php get_template_part('template-parts/section', 'presence', ['index' => 0]); ?>
                \
        </div>
        <?php get_template_part('template-parts/section', 'partners'); ?>
        <?php get_template_part('template-parts/section', 'form-home'); ?>
</main>


<?php get_footer(); ?>