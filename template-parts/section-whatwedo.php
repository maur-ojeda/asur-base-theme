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
 while ( $whatwedo_query->have_posts() ) : $whatwedo_query->the_post(); 
 
    $title = get_the_title();
    $description = carbon_get_the_post_meta('whatwedo_description');
    $numbers = carbon_get_the_post_meta('whatwedo_numbers');    
?>


<pre class="theme-indicator">WIP: what-we-do</pre>



<section id="what-we-do">
    <div class="container text-center">
    <div class="mb-5"  data-aos="fade" data-aos-delay="200">
        <h1 class="text-primary"><?php echo esc_html($title); ?></h1>
        <p class="lead text-muted"><?php echo esc_html($description); ?></p>
    </div>

        <div class="row justify-content-center">
        <?php foreach ($numbers as $number): ?>
    <?php
        $num = isset($number['whatwedo_number']) ? $number['whatwedo_number'] : '';
        $text = isset($number['whatwedo_text']) ? $number['whatwedo_text'] : '';
    ?>
    <div class="col-6 col-md-3 mb-4"  data-aos="fade-down" data-aos-delay="400">
        <div class="number-container">
        <h3 class="counter" data-target="<?php echo esc_attr($number['whatwedo_number']); ?>">0</h3>
            <p><?php echo esc_html($text); ?></p>
        </div>
    </div>
<?php endforeach; ?>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>


<?php endif; ?>

