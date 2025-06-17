<section id="gallerie" class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col text-center">
                <h2 class="section-title">Galería</h2>
                <p class="section-subtitle">Una muestra de nuestro trabajo</p>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $gallery_query = new WP_Query(array(
                'post_type' => 'gallery',
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
            ));

            if ($gallery_query->have_posts()) :
                while ($gallery_query->have_posts()) : $gallery_query->the_post();
                    $image = get_field('gallery_image');
                    $image_url = $image ?: 'https://picsum.photos/600/400?random=' . rand(1, 1000);
            ?>
                <div class="col-md-4">
                    <img src="<?php echo esc_url($image_url); ?>" class="img-fluid rounded" alt="Imagen galería">
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p class="text-center">Aún no hay imágenes en la galería.</p>';
            endif;
            ?>
        </div>
    </div>
</section>
