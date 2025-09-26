<?php
$post_name = "innovacion";

$item = new WP_Query([
    'post_type'      => $post_name,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if ($item->have_posts()):
    $counter = 0; // contador de items
    $slide   = 0; // para saber qué slide es
?>

<div class="m-block">
    <div class="row">
        <div class="col-12 mb-12">
            <h6 class="over-title" data-aos="fade-up" data-aos-delay="200">INNOVACIÓN</h6>
            <h2 class="title" data-aos="fade-up" data-aos-delay="400">OTROS PROYECTOS</h2>
        </div>
    </div>

    <div id="projectsCarousel" class="carousel slide img-krom-wrapper type-8" data-bs-ride="carousel">
        <div class="carousel-inner">

            <?php while ($item->have_posts()): $item->the_post(); ?>

                <?php if ($counter % 4 === 0): // abrir nuevo carousel-item cada 4 ?>
                    <div class="carousel-item <?= $slide === 0 ? 'active' : '' ?>">
                        <div class="row g-4">
                <?php endif; ?>

                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="card border-0 h-100 shadow-sm">
                                    <div class="position-relative">
                                        <?php if (has_post_thumbnail()): ?>
                                            <img class="card-img-top" src="<?= esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" alt="<?= esc_attr(get_the_title()); ?>">
                                        <?php endif; ?>
                                        <span class="position-absolute top-0 start-0 m-3 text-white fs-1 fw-bold">
                                            <?= str_pad($counter + 1, 2, '0', STR_PAD_LEFT); ?>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold"><?= esc_html(get_the_title()); ?></h5>
                                        <p class="card-text custom-card-text"><?= wp_trim_words(get_the_content(), 20, '...'); ?></p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <a href="<?= esc_url(get_permalink()); ?>" class="btn btn-krom border-0">Ver Más →</a>
                                    </div>
                                </div>
                            </div>

                <?php $counter++; ?>

                <?php if ($counter % 4 === 0 || $counter === $item->post_count): // cerrar cada 4 o al final ?>
                        </div>
                    </div>
                    <?php $slide++; ?>
                <?php endif; ?>

            <?php endwhile; ?>

        </div>

        <!-- Controles -->
        <button class="carousel-control-prev" type="button" data-bs-target="#projectsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#projectsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</div>

<?php endif; wp_reset_postdata(); ?>






