 <?php
    $query = new WP_Query(['post_type' => 'testimonial', 'posts_per_page' => -1]);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $title = get_the_title();
            $desc = get_the_content();
            $testimonial_shortcode = carbon_get_the_post_meta('testimonial_shortcode');
               $is_visible = carbon_get_the_post_meta('is_visible');                      
        ?>

<?php if ($is_visible) : ?>

<pre class="theme-indicator">WIP: testimonial</pre>

<section id="testimonials" class="py-5">


   <div class="container">
    
     <div class="intro-section" data-aos="fade" data-aos-delay="200">
                <h1><?= esc_html($title); ?></h1>
                <p><?= esc_html(strip_tags($desc)); ?></p>
        </div>

    <div class="testimonial-carousel" data-aos="fade-up" data-aos-delay="400">
        <?= do_shortcode($testimonial_shortcode); ?>
    </div>
  </div>
</section>

    <?php endif; endwhile; wp_reset_postdata(); endif; ?>
