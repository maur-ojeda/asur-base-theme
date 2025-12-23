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
    // Guardamos los posts para reutilizarlos
    $posts = $item->posts;
    $total_posts = count($posts);
    wp_reset_postdata();
?>

<div class="container">
  <div class="m-block" id="projectsCarousel">
    <div class="row">
      <div class="col-12 mb-12">
        <h6 class="over-title" data-aos="fade-up" data-aos-delay="200">INNOVACIÓN</h6>
        <h2 class="title" data-aos="fade-up" data-aos-delay="400">OTROS PROYECTOS</h2>
      </div>
    </div>

    <?php
    // === CARRUSEL MOBILE (1 por slide) ===
    ?>
    <div id="projectsCarouselMobile" class="carousel slide img-krom-wrapper type-8 d-block d-md-none" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php foreach ($posts as $index => $post): 
            setup_postdata($post);
            $isActive = ($index === 0) ? 'active' : '';
        ?>
          <div class="carousel-item <?= $isActive ?>">
            <div class="row g-4 justify-content-center">
              <div class="col">
                <div class="card border-0 h-100">
                  <div class="position-relative">
                    <?php if (has_post_thumbnail()): ?>
                      <div class="card-image" style="background-image: url('<?= esc_url(get_the_post_thumbnail_url($post->ID, 'medium')); ?>')"></div>
                    <?php endif; ?>
                    <span class="number"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></span>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title fw-bold"><?= esc_html(get_the_title()); ?></h5>
                    <p class="card-text custom-card-text"><?= wp_trim_words(get_the_content(), 20, '...'); ?></p>
                  </div>
                  <div class="card-footer border-0">
                    <a href="<?= esc_url(get_permalink()); ?>" class="btn btn-krom border-0">Ver Más →</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Controles Mobile -->
      <button class="carousel-control-prev" type="button" data-bs-target="#projectsCarouselMobile" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#projectsCarouselMobile" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>

    <?php
    // === CARRUSEL DESKTOP/TABLET (hasta 4 por slide) ===
    ?>
    <div id="projectsCarouselDesktop" class="carousel slide img-krom-wrapper type-8 d-none d-md-block" data-bs-ride="carousel">
      <div class="carousel-inner">
        <?php
        foreach ($posts as $index => $post):
            if ($index % 4 === 0):
                $isActive = ($index === 0) ? 'active' : '';
                // ✅ row-cols: 1 en mobile, 2 en tablet, 4 en desktop
                echo '<div class="carousel-item ' . $isActive . '"><div class="row g-4 row-cols-1 row-cols-md-2 row-cols-lg-4">';
            endif;

            setup_postdata($post);
        ?>
          <div class="col">
            <div class="card h-100">
              <div class="position-relative">
                <?php if (has_post_thumbnail()): ?>
                  <div class="card-image" style="background-image: url('<?= esc_url(get_the_post_thumbnail_url($post->ID, 'medium')); ?>')"></div>
                <?php endif; ?>
                <span class="number"><?= str_pad($index + 1, 2, '0', STR_PAD_LEFT); ?></span>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= esc_html(get_the_title()); ?></h5>
                <p class="card-text"><?= wp_trim_words(get_the_content(), 20, '...'); ?></p>
              </div>
              <div class="card-footer border-0">
                <a href="<?= esc_url(get_permalink()); ?>" class="btn-krom">Ver Más <i data-lucide="arrow-right"></i></a>
              </div>
            </div>
          </div>

          <?php
          if (($index + 1) % 4 === 0 || $index + 1 === $total_posts):
              echo '</div></div>'; // cierra .row y .carousel-item
          endif;
        endforeach;
        wp_reset_postdata();
        ?>
      </div>

      <!-- Controles Desktop (solo si hay más de 4 posts) -->
      <?php if ($total_posts > 4): ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#projectsCarouselDesktop" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#projectsCarouselDesktop" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php endif; ?>