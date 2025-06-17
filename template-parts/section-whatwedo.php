<?php
$args = array(
    'post_type'      => 'whatwedo',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'ASC',
);

$whatwedo_query = new WP_Query( $args );

if ( $whatwedo_query->have_posts() ) :
?>
<section id="what-we-do" class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="mb-4">Qué Hacemos</h2>
        <div class="row justify-content-center">
            <?php while ( $whatwedo_query->have_posts() ) : $whatwedo_query->the_post(); 
                $number = get_field('whatwedo_number');
                $text   = get_field('whatwedo_text');
            ?>
            <div class="col-6 col-md-3 mb-4">
                <div class="p-3 bg-white shadow-sm rounded h-100">
                    <h3 class="display-5 text-primary"><?php echo esc_html($number); ?></h3>
                    <p class="small text-muted mb-0"><?php echo esc_html($text); ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php
endif;
wp_reset_postdata();
