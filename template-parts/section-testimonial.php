<section id="testimonials" class="py-5">
    <div class="container">
        <div class="row text-center mb-4">
            <div class="col">
                <h2 class="section-title">Testimonios</h2>
                <p class="section-subtitle">Lo que dicen nuestros clientes</p>
            </div>
        </div>

        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                <?php
                $testimonials = new WP_Query(array(
                    'post_type' => 'testimonial',
                    'posts_per_page' => -1,
                    'post_status' => 'publish',
                ));

                if ($testimonials->have_posts()) :
                    while ($testimonials->have_posts()) : $testimonials->the_post();
                        $image = get_field('testimonial_image') ?: 'https://picsum.photos/100/100?grayscale&random=' . rand(1, 999);
                        $text  = get_field('testimonial_text');
                        $name  = get_the_title();
                ?>
                <div class="swiper-slide text-center p-4">
                    <img src="<?php echo esc_url($image); ?>" class="rounded-circle mb-3" width="100" height="100" alt="Foto de <?php echo esc_attr($name); ?>">
                    <blockquote class="blockquote">
                        <p><?php echo esc_html($text); ?></p>
                        <footer class="blockquote-footer mt-2"><?php echo esc_html($name); ?></footer>
                    </blockquote>
                </div>
                <?php endwhile; wp_reset_postdata(); endif; ?>
            </div>
        </div>
    </div>
</section>
