<section id="products" class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col text-center">
                <h2 class="section-title">Nuestros Productos</h2>
                <p class="section-subtitle">Explora nuestras soluciones más destacadas</p>
            </div>
        </div>

        <?php
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $product_query = new WP_Query($args);

        if ($product_query->have_posts()) :
            while ($product_query->have_posts()) : $product_query->the_post();
                $title = get_the_title();
                $desc = get_field('product_description');
                $images = get_field('product_images');
        ?>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 p-3">
                            <h3><?php echo esc_html($title); ?></h3>
                            <p><?php echo esc_html($desc); ?></p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card h-100 p-3">
                            <h3>Otro producto</h3>
                            <p>Ejemplo de contenido estático.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <?php if ($images && count($images) > 0): ?>
                        <div class="col-12 mb-3">
                            <img src="<?php echo esc_url($images[0]['url']); ?>" class="img-fluid" alt="Imagen principal">
                        </div>
                        <div class="col-12">
                            <div class="row g-2">
                                <?php for ($i = 1; $i < min(count($images), 6); $i++): ?>
                                    <div class="col">
                                        <img src="<?php echo esc_url($images[$i]['url']); ?>" class="img-fluid rounded" alt="Miniatura">
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="col-12">No hay imágenes disponibles.</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>
