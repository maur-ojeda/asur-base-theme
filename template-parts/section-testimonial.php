<section id="testimonials" class="py-5">


 <?php
    $query = new WP_Query(['post_type' => 'testimonial', 'posts_per_page' => -1]);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $title = get_the_title();
            $content = get_the_content();
            $testimonial_shortcode = carbon_get_the_post_meta('testimonial_shortcode');
            
    ?>

   <div class="container">
    <div class="text-center mb-4">
       <h3 class="fw-bold mb-3"><?= esc_html($title); ?></h3>
        <p class="text-muted"><?= esc_html($content); ?></p>
    </div>
    <div class="testimonial-carousel">
        <?= do_shortcode($testimonial_shortcode); ?>
    </div>
  </div>
</section>

    <?php endwhile; wp_reset_postdata(); endif; ?>
