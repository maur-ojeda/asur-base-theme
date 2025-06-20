<section id="products" class="py-5">
  <div class="container">
    <?php
    $query = new WP_Query(['post_type' => 'product', 'posts_per_page' => -1]);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $title = get_the_title();
            $desc = carbon_get_the_post_meta('product_description');
            $gallery_shortcode = carbon_get_the_post_meta('product_gallery_shortcode');
            $features = carbon_get_the_post_meta('product_features');
    ?>
    <div class="row mb-5 align-items-center">
      <!-- col-1: contenido -->
      <div class="col-md-6">
        <h3 class="fw-bold mb-3"><?= esc_html($title); ?></h3>
        <p class="text-muted"><?= esc_html($desc); ?></p>
        <ul class="list-unstyled">
          <?php foreach ($features as $f): ?>
            <li class="mb-3 d-flex align-items-start">
              <i data-lucide="<?= esc_attr($f['feature_icon']); ?>" class="me-2 text-primary" style="width: 24px; height: 24px;"></i>
              <div>
                <strong><?= esc_html($f['feature_title']); ?></strong><br>
                <small><?= esc_html($f['feature_description']); ?></small>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- col-2: galería -->
      <div class="col-md-6">
        <?= do_shortcode($gallery_shortcode); ?>
      </div>
    </div>
    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
</section>
