<?php





$selected_hero_id = carbon_get_post_meta(get_the_ID(), 'selected_hero');

$args = array(
            'post_type' => 'hero',
            'p' => $selected_hero_id[0]['id'], 
            'post_status' => 'publish',
            'posts_per_page' => 1
);

$hero_query = new WP_Query($args);

// Valores por defecto como fallback
$default_background_image = 'https://picsum.photos/1200/600';
$default_title = 'Bienvenido a nuestra plataforma';
$default_content = 'Descubre las últimas tendencias y soluciones tecnológicas.';
$default_button1_text = 'Comienza Ahora';
$default_button1_link = '#';
$default_button2_text = 'Contáctanos';
$default_button2_link = '#';

if ($hero_query->have_posts()) :
    while ($hero_query->have_posts()) : $hero_query->the_post();

        $title           = get_the_title() ?: $default_title;
        $type             = carbon_get_the_post_meta('page_type');
        $overlay_opacity   = carbon_get_the_post_meta('hero_overlay_opacity');
        $background_color   = carbon_get_the_post_meta('hero_background_color');
        $background_image = carbon_get_the_post_meta('hero_background_image');
        $is_visible       = carbon_get_the_post_meta('is_visible');        
        
        ?>







        <section class="hero home" 
            style="background-image: url('<?php echo esc_url(ensure_https($background_image)); ?>')">
        
            <div class="hero-overlay <?= esc_attr($overlay_opacity); ?>" style="background-color: <?= esc_attr($background_color); ?>;"></div>
            
            <div class="hero-title">
                    <div class="row">
                    <div class="offset-lg-05 col-md-11 col-12">
                        <?php if ($title): ?>
                            <h1 data-aos="fade-up"><?php echo esc_html($title); ?></h1>
                        <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

            <div class="hero-shape">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/img/hero-shape.png" alt="hero-shape">
            </div>

        </section>

        <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
