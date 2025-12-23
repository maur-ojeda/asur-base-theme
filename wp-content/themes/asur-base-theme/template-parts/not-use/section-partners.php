
<?php
use Carbon_Fields\Helper\Helper;
$post_name="partner";


$item = new WP_Query([
    'post_type' => $post_name,
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
    
    $overtitle = carbon_get_the_post_meta('over_title');
    $partners = carbon_get_the_post_meta('partners') ?: [];
    ?>






 <section class="py-5 mb-20">
            <div class="container">
                <div class="row mb-5" data-aos="fade" data-aos-delay="200">
                    <div class="col-12">
                        <h6 class="over-title"><?= esc_html($overtitle); ?></h6>
                        <h2 class="title"><?= esc_html($title); ?></h2>
                    </div>
                </div>
                <div class="row row-cols-2 row-cols-md-4 g-5 align-items-center justify-content-center">
                    <?php foreach ($partners as $partner):
                        $partner_logo = !empty($partner['client_logo']) ? esc_url($partner['client_logo']) : $default_logo;
                    ?>
        <div class="col text-center">
            <img src="<?= ensure_https($partner_logo); ?>" class="img-fluid"  alt="Logo">
        </div>

                    <?php endforeach; ?>






                </div>



            </div>
</section>

<?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>


