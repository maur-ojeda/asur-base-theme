<?php
use Carbon_Fields\Helper\Helper;

// Consulta de servicios ordenados por "menu_order"
$services = new WP_Query([
    'post_type' => 'service',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

if ($services->have_posts()) : ?>

  <pre class="theme-indicator">WIP: services</pre>

  <section id="services">

    <?php
    // Buscar el primer servicio visible para usar como encabezado
    $first_visible_post = null;
    $temp_query = clone $services;

    while ($temp_query->have_posts()) :
      $temp_query->the_post();
      $is_visible = carbon_get_the_post_meta('is_visible');

      if ($is_visible && is_null($first_visible_post)) {
        $first_visible_post = get_post();
        setup_postdata($first_visible_post);
        $title_intro = get_the_title();
        $desc_intro = get_the_content();
      }
    endwhile;

    wp_reset_postdata();
    ?>

    <!-- Intro section (solo una vez) -->
    <div class="container">
      <div class="intro-section-services" data-aos="fade" data-aos-delay="200">
        <h1><?= esc_html($title_intro); ?></h1>
        <p><?= esc_html(strip_tags($desc_intro)); ?></p>
      </div>
    </div>

    <div class="container-fluid mt-5">
      <div class="container mt-5">

        <?php
        while ($services->have_posts()) : $services->the_post();

  $is_visible = carbon_get_the_post_meta('is_visible');
  if (!$is_visible) continue;

  $serviceTitle = carbon_get_the_post_meta('service_title');
  $serviceDescription = carbon_get_the_post_meta('service_description');
  $shortcode = carbon_get_the_post_meta('service_shortcode');
  $features = carbon_get_the_post_meta('service_features');
  $layout = carbon_get_the_post_meta('service_layout') ?: 'left'; // left | right
  $margin_class = carbon_get_the_post_meta('service_margin_bottom') ?: 'mb-5';

  // Configurar clases de orden y animación según layout
  $isLeft = $layout === 'left';
  $col1_order = $isLeft ? 'order-md-2' : 'order-md-1'; // galería
  $col2_order = $isLeft ? 'order-md-1' : 'order-md-2'; // detalles
  $gallery_aos = $isLeft ? 'fade-left' : 'fade-right';
  $details_aos = $isLeft ? 'fade' : 'fade';
  $features_aos = $isLeft ? 'fade-left' : 'fade-right';

  ?>

  <div class="row mt-5 pt-5 <?= esc_attr($margin_class); ?>">

    <!-- Galería -->
    <div class="col-md-6 mb-4 mb-md-0 <?= esc_attr($col1_order); ?>" id="col-1">
      <?php if ($shortcode): ?>
        <div class="shortcode-gallery" data-aos="<?= esc_attr($gallery_aos); ?>" data-aos-delay="400">
          <?= do_shortcode($shortcode); ?>
        </div>
      <?php else: ?>
        <img src="https://picsum.photos/800/500?random=<?= the_ID(); ?>" 
             class="img-fluid rounded shadow-sm w-100" alt="Fallback">
      <?php endif; ?>
    </div>

    <!-- Detalles -->
    <div class="col-md-6 <?= esc_attr($col2_order); ?>" id="col-2">
      <div class="intro-section" data-aos="<?= esc_attr($details_aos); ?>" data-aos-delay="200">
        <h1><?= esc_html($serviceTitle); ?></h1>
        <p><?= esc_html(strip_tags($serviceDescription)); ?></p>
      </div>

      <?php if (!empty($features)): ?>
        <ul class="list-unstyled" data-aos="<?= esc_attr($features_aos); ?>" data-aos-delay="400">
          <?php foreach ($features as $f): ?>
            <li class="service-item">
              <div>
                <i data-lucide="<?= esc_attr($f['feature_icon']); ?>" class="d-none d-md-block"></i>
              </div>
              <div>  
                <h5><?= esc_html($f['feature_text']); ?></h5>
                <p><?= esc_html($f['feature_description']); ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>

  </div> <!-- /.row -->
        <?php endwhile; wp_reset_postdata(); ?>

      </div>
    </div>

  </section>

<?php endif; ?>