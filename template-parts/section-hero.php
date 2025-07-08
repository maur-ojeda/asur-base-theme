<?php
//wp-content/themes/asur-base-theme/template-parts/section-hero.php
$args = array(
    'post_type'      => 'hero',
    'posts_per_page' => 1, // Solo 1 hero
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$hero_query = new WP_Query($args);

if ($hero_query->have_posts()) :
    while ($hero_query->have_posts()) : $hero_query->the_post();    
            $title = get_the_title();
            $content = get_the_content();
            $button1_text     = carbon_get_the_post_meta('hero_button_1_text');
            $button1_link     = carbon_get_the_post_meta('hero_button_1_link');
            $button2_text     = carbon_get_the_post_meta('hero_button_2_text');
            $button2_link     = carbon_get_the_post_meta('hero_button_2_link');
            $background_image = carbon_get_the_post_meta('hero_background_image');
            $is_visible = carbon_get_the_post_meta('is_visible');                      
        ?>

<?php if ($is_visible) : ?>

        

        <pre class="theme-indicator">WIP: hero</pre>

        <section 
            id="hero"
            class="hero-section d-flex align-items-center text-white position-relative hero-zoom" 
            style="background: url('<?php echo ensure_https($background_image); ?>') no-repeat center center / cover; min-height: 100vh;">
            <div class="overlay position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>
            
            <div class="container text-left position-relative z-1 mt-5 pt-5">
                <div class="row">
                    <div class="offset-lg-1 col-lg-8 col-md-10 col-sm-12">
                        <?php if ($title): ?>
                            <h1 
                            class="display-3 mb-3" 
                            data-aos="fade-up"
                            >
                            <?php echo esc_html($title); ?>
                        </h1>
                        <?php endif; ?>

                        <?php if ($content): ?>
                            <div data-aos="fade-up" data-aos-delay="200"> <p class="lead mb-4"><?php echo esc_html(strip_tags($content)); ?></p>
</div>
                        <?php endif; ?>

                        <div 
                        
                        class="d-flex justify-content-left gap-3 flex-wrap" 
                        data-aos="fade-up" 
                        data-aos-delay="400">
                        
                        <?php if ($button1_link): ?>
                                <a href="<?php echo esc_url($button1_link); ?>" class="btn btn-lg btn-primary">
                                    <?php echo esc_html($button1_text ?: 'Ver más'); ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($button2_link): ?>
                                <a href="<?php echo esc_url($button2_link); ?>" class="btn btn-lg btn-outline-light">
                                    <?php echo esc_html($button2_text ?: 'Contáctanos'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
        endif;
    endwhile;
    wp_reset_postdata();
endif;
?>
