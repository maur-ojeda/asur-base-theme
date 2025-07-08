<?php
$args = array(
    'post_type'      => 'gallery',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
);

$query = new WP_Query($args);

if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post(); 
    $title = get_the_title();
    $desc = get_the_content();
    $shortcode = carbon_get_the_post_meta('gallery_shortcode');
    $is_visible = carbon_get_the_post_meta('is_visible');                      
        ?>

<?php if ($is_visible) : ?>

<pre class="theme-indicator">WIP :gallerie</pre>

        <section id="gallery" class="py-5">
            <div class="container">

            <div class="intro-section" data-aos="fade" data-aos-delay="200">
                <h1><?= esc_html($title); ?></h1>
                <p><?= esc_html(strip_tags($desc)); ?></p>
            </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <?php echo do_shortcode($shortcode); ?>
                </div>
            </div>
        </section>
    <?php 
endif;    
endwhile;
    wp_reset_postdata();
endif;
?>
