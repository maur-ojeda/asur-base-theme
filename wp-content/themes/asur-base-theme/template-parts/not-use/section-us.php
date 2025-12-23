<?php
use Carbon_Fields\Helper\Helper;

$us = new WP_Query([
    'post_type' => 'us',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

if ($us->have_posts()) : ?>

  <pre class="theme-indicator">WIP: us</pre>

  <section id="us">

    <?php
    $first_visible_post = null;
    $temp_query = clone $us;
    while ($temp_query->have_posts()) :
      $temp_query->the_post();
      $is_visible = carbon_get_the_post_meta('is_visible');

      if ($is_visible && is_null($first_visible_post)) {
        $first_visible_post = get_post();
        setup_postdata($first_visible_post);
        $title = get_the_title();
        $content = get_the_content();
      }
    endwhile;

    wp_reset_postdata();
    ?>
    <div class="container-fluid mt-5">

        <?php
        while ($us->have_posts()) : $us->the_post();

  $is_visible = carbon_get_the_post_meta('is_visible');
  if (!$is_visible) continue;

  $overUsTitle = carbon_get_the_post_meta('us_over_title');
  $usImage = carbon_get_the_post_meta('us_image');

  ?>

  <div class="row">

        
    <div class="col-md-4 p-0" data-aos="fade-right"><img class="img-fluid rounded" src="<?php echo esc_url(ensure_https($usImage)); ?>" alt=""></div>
    <!-- Detalles -->
    <div class="col ms-md-5">
      <div class="intro-section" data-aos="fade" data-aos-delay="200">
        <h6 class="text-primary fw-semibold" data-aos="fade" data-aos-delay="800"><?= esc_html($overUsTitle); ?></h6>
        <h2 class="display-2" data-aos="fade-up" data-aos-delay="400"><?= esc_html($title); ?></h2>
        <p class="text-muted" data-aos="fade-up" data-aos-delay="600"><?= esc_html(strip_tags($content)); ?></p>
      </div>
    </div>
    </div> 
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    </div>

  </section>

<?php endif; ?>