<?php
$args = array(
    'post_type' => 'service',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
$services = new WP_Query($args);
?>

<section id="services" class="py-5 bg-light">
    <div class="container text-center mb-5">
        <h2 class="display-5 fw-bold">Nuestros Servicios</h2>
        <p class="lead text-muted">Ofrecemos soluciones gastronómicas personalizadas para cada ocasión.</p>
    </div>

    <div class="container">
        <?php if ($services->have_posts()) : ?>
            <?php while ($services->have_posts()) : $services->the_post(); ?>
                <?php
                    $images = get_field('service_gallery'); // array de imágenes
                    $title = get_the_title();
                    $desc = get_field('service_description');
                    $features = get_field('service_features'); // campo repeater
                ?>
                <div class="row mb-5 align-items-center">
                    <div class="col-md-6">
                        <?php if ($images): ?>
                            <div id="carousel-<?php the_ID(); ?>" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner rounded shadow-sm">
                                    <?php foreach ($images as $index => $img): ?>
                                        <div class="carousel-item <?= $index === 0 ? 'active' : ''; ?>">
                                            <img src="<?= esc_url($img['url']); ?>" class="d-block w-100" alt="">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <?php if (count($images) > 1): ?>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-<?php the_ID(); ?>" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-<?php the_ID(); ?>" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <img src="https://picsum.photos/800/500?random=<?= get_the_ID(); ?>" class="img-fluid rounded shadow-sm" alt="Fallback">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-6 mt-4 mt-md-0">
                        <h3 class="fw-bold mb-3"><?= esc_html($title); ?></h3>
                        <p class="text-muted"><?= esc_html($desc); ?></p>
                        <?php if ($features): ?>
                            <ul class="list-unstyled">
                                <?php foreach ($features as $f): ?>
                                    <li class="mb-2 d-flex align-items-start">
                                        <span class="me-2 text-primary">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </span>
                                        <?= esc_html($f['feature_item']); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
</section>
