<?php
use Carbon_Fields\Helper\Helper;

$services = new WP_Query([
    'post_type' => 'service',
    'posts_per_page' => -1,
    'post_status' => 'publish',
]);

if ($services->have_posts()) :
  
  while ($services->have_posts()) : $services->the_post();

      $title = get_the_title();
      $desc = get_the_content();

      $serviceTitle = carbon_get_the_post_meta('service_title');
      $serviceDescription = carbon_get_the_post_meta('service_description');
      $shortcode = carbon_get_the_post_meta('service_shortcode');
      $features = carbon_get_the_post_meta('service_features');

    ?>
 


<pre class="theme-indicator">WIP: services</pre>

<section id="services" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/dist/images/bg-02.jpg'); ?>'); background-size:contain; background-position: center;">
  
  <div class="container">
          <div class="intro-section" data-aos="fade" data-aos-delay="200">
                  <h1><?= esc_html($title); ?></h1>
                  <p><?= esc_html(strip_tags($desc)); ?></p>
            </div>
  </div>
   
  <div class="container-fluid mt-5">
      <!-- row-2: contenido con galería y detalles -->
      <div class="container">
      <div class="row mb-5">
        <div class="col-md-6 text-white" id="col-2">
          <h4 data-aos="fade-left" data-aos-delay="200"><?php echo esc_html($serviceTitle); ?></h4>
          <p data-aos="fade-left" data-aos-delay="200"><?php echo esc_html($serviceDescription); ?></p>

          <?php if (!empty($features)): ?>
            <ul class="list-unstyled" data-aos="fade-left" data-aos-delay="400">
              <?php foreach ($features as $feature): ?>
                <li class="service-item">
                  <i data-lucide="<?php echo esc_attr($feature['feature_icon']); ?>"></i>
                  <span><?php echo esc_html($feature['feature_text']); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>  

        <div class="col-md-6 mb-4 mb-md-0" id="col-1">
          <?php if ($shortcode): ?>
            <div class="shortcode-gallery mb-3" data-aos="fade-left" data-aos-delay="400">
              <?php echo do_shortcode($shortcode); ?>
            </div>
          <?php else: ?>
            <img src="https://picsum.photos/800/500?random=<?php the_ID(); ?>" class="img-fluid rounded shadow-sm w-100" alt="Fallback">
          <?php endif; ?>
        </div>

        <!-- col-2: detalles -->
    

      </div>

  </div>

    <?php endwhile; wp_reset_postdata(); ?>
  
</section>

<?php endif; ?>
