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


$shortcode = carbon_get_the_post_meta('gallery_shortcode');
?>

        <section id="gallery" class="py-5">
            <div class="container">
                <h2 class="text-center mb-4"><?php the_title(); ?></h2>
                <div class="text-center">
                    <?php the_content(); ?>
                </div>

                <div class="text-center">
                    <?php echo do_shortcode($shortcode); ?>
                </div>
            </div>
        </section>
    <?php endwhile;
    wp_reset_postdata();
endif;
?>
