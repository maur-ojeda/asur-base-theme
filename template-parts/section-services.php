<?php
use Carbon_Fields\Helper\Helper;

$services = new WP_Query([
    'post_type' => 'service',
    'posts_per_page' => -1,
    'post_status' => 'publish',
]);

if ($services->have_posts()) :
?>

<section id="services">
  <div class="container py-5" data-aos="fade" >
 <?php while ($services->have_posts()) : $services->the_post();

      $title = get_the_title();
      $description = get_the_content();
      $serviceTitle = carbon_get_the_post_meta('service_title');
      $serviceDescription = carbon_get_the_post_meta('service_description');
      $shortcode = carbon_get_the_post_meta('service_shortcode');
      $features = carbon_get_the_post_meta('service_features');

    ?>
    <!-- row-1: título y bajada -->
    <div class="row text-center">
      <div class="col">
        <h1 class="text-primary"><?php echo esc_html($title); ?></h1>
        <p class="lead text-muted"><?php echo esc_html(strip_tags($description)); ?></p>
      </div>
    </div>
</div>
   
<div class="container-fluid bg-success text-white py-5">
    <!-- row-2: contenido con galería y detalles -->
    <div class="container">
    <div class="row mb-5">

       <div class="col-md-6" id="col-2">
        <h4 data-aos="fade-left" data-aos-delay="200"><?php echo esc_html($serviceTitle); ?></h4>
        <p data-aos="fade-left" data-aos-delay="200"><?php echo esc_html($serviceDescription); ?></p>

        <?php if (!empty($features)): ?>
          <ul class="list-unstyled" data-aos="fade-left" data-aos-delay="400">
            <?php foreach ($features as $feature): ?>
              <li class="d-flex align-items-start mb-3">
                <i data-lucide="<?php echo esc_attr($feature['feature_icon']); ?>" class="me-2 text-white" style="width: 24px; height: 24px;"></i>
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
