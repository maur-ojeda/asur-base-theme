
<?php
use Carbon_Fields\Helper\Helper;


$item = new WP_Query([
    'post_type' => 'featured_project',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);


if ($item->have_posts()) : ?>

<?php
    
    $first_visible_post = null;
    $temp_query = clone $item;
    
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
    
    while ($item->have_posts()) : $item->the_post();
    
    $is_visible = carbon_get_the_post_meta('is_visible');
    if (!$is_visible) continue;
    
    $text = carbon_get_the_post_meta('fp_link_text');
    $link = carbon_get_the_post_meta('fp_link');
    $image = carbon_get_the_post_meta('fp_image');
    $info = carbon_get_the_post_meta('fp_info');
    $overtitle = carbon_get_the_post_meta('fp_over_title');
    
    ?>





<section id="featured-proyect">
  <div class="container">
            <div class="row align-items-center proyecto-section">
                <div class="col-lg-5 col-md-5 mb-4 mb-md-0">
                    <h6 class="text-primary fw-semibold" data-aos="fade" data-aos-delay="800"><?= esc_html($overtitle); ?></h6>
                    <h3 class="display-6" data-aos="fade-up" data-aos-delay="400"><?= esc_html($title); ?></h3>
                    <p class="text-muted" data-aos="fade-up" data-aos-delay="600">
                        <?= esc_html(strip_tags($content)); ?> 
                    </p>
                    <a href="<?= $link; ?>" class="btn rounded-pill btn-primary" data-aos="fade-up" data-aos-delay="600"> <?= $text; ?></a>
                </div>
                <div class="offset-md-2 col-lg-5 col-md-5">
                    <div class="imagen-container" >
                        <img src="<?php echo esc_url(ensure_https($image)); ?>" 
                             alt="imagen" 
                             class="imagen-principal"
                             data-aos="fade-left" data-aos-delay="500"
                             >
                        
                             <div class="info-overlay" data-aos="fade" data-aos-delay="1000">
                            <p><?= esc_html($info); ?></p>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
</section>

<?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>











