    <?php
    $query = new WP_Query(['post_type' => 'product', 'posts_per_page' => -1]);
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $title = get_the_title();
            $desc = carbon_get_the_post_meta('product_description');
            $gallery_shortcode = carbon_get_the_post_meta('product_gallery_shortcode');
            $features = carbon_get_the_post_meta('product_features');
                $is_visible = carbon_get_the_post_meta('is_visible');                      
        ?>


<?php if ($is_visible) : ?>
<pre class="theme-indicator">WIP: products</pre>

<section id="products" class="py-10">
  <div class="container">



    <div class="row mb-5 align-items-center">
      <!-- col-1: contenido -->
      <div class="col-md-6">
        <div class="intro-section" data-aos="fade" data-aos-delay="200">
            <h1><?= esc_html($title); ?></h1>
            <p><?= esc_html($desc); ?></p>
        </div>
    
    
        <ul class="list-unstyled">
          <?php foreach ($features as $f): ?>
            <li class="product-item" data-aos="fade-right" data-aos-delay="400">
              <i data-lucide="<?= esc_attr($f['feature_icon']); ?>" class="d-none d-md-block" ></i>
              <div>
                <h5><?= esc_html($f['feature_title']); ?></h5>
                <p><?= esc_html($f['feature_description']); ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- col-2: galería -->
      <div class="col-md-6" data-aos="fade" data-aos-delay="600">
        <?= do_shortcode($gallery_shortcode); ?>
      </div>
    </div>
  
  </div>
</section>
  <?php 
    endif;
    endwhile; wp_reset_postdata(); endif; ?>