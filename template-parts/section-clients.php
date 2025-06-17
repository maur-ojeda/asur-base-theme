<section id="clients" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4 text-center">
            <div class="col">
                <h2 class="section-title">Nuestros Clientes</h2>
                <p class="section-subtitle">Confían en nosotros</p>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            <?php
            $client_query = new WP_Query(array(
                'post_type' => 'client',
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'orderby' => 'date',
                'order' => 'DESC',
            ));

            if ($client_query->have_posts()) :
                while ($client_query->have_posts()) : $client_query->the_post();
                    $logo = get_field('client_logo');
                    $url  = get_field('client_url');
                    $logo_url = $logo ?: 'https://picsum.photos/200/100?grayscale&random=' . rand(1, 999);
            ?>
                <div class="col-6 col-md-4 col-lg-3 text-center">
                    <?php if ($url): ?>
                        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                            <img src="<?php echo esc_url($logo_url); ?>" class="img-fluid grayscale" alt="Logo cliente">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo esc_url($logo_url); ?>" class="img-fluid grayscale" alt="Logo cliente">
                    <?php endif; ?>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p class="text-center">Aún no hay logos cargados.</p>';
            endif;
            ?>
        </div>
    </div>
</section>
