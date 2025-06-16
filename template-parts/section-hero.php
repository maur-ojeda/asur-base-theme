
<?php
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
    
        $headline = get_field('hero_headline');
        $subtext = get_field('hero_subtext');
        $button1_text = get_field('hero_button_1_text');
        $button1_link = get_field('hero_button_1_link');
        $button2_text = get_field('hero_button_2_text');
        $button2_link = get_field('hero_button_2_link');
        $background_image = get_field('hero_background_image');
        
        ?>
        

        <section id="hero" class="hero-section text-white d-flex align-items-center" style="background: url('<?php echo esc_url($background_image); ?>') no-repeat center center / cover; min-height: 100vh;">
            <div class="container text-center">
                <?php if ($headline): ?>
                    <h1 class="display-4 fw-bold"><?php echo esc_html($headline); ?></h1>
                <?php endif; ?>

                <?php if ($subtext): ?>
                    <p class="lead mb-4"><?php echo esc_html($subtext); ?></p>
                <?php endif; ?>

                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <?php if ($button1_link): ?>
                        <a href="<?php echo esc_url($button1_link); ?>" class="btn btn-primary">
                            <?php echo esc_html($button1_text ?: 'Ver más'); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($button2_link): ?>
                        <a href="<?php echo esc_url($button2_link); ?>" class="btn btn-outline-light">
                            <?php echo esc_html($button2_text ?: 'Contáctanos'); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>

