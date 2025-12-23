
<?php
use Carbon_Fields\Helper\Helper;

$loop_index = 0;

$item = new WP_Query([
    'post_type' => 'investor',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

if ($item->have_posts()) : ?>
  <pre class="theme-indicator">WIP: <?= $item->query['post_type']; ?></pre>
    <?php
    $first_visible_post = null;
    $temp_query = clone $item;
    while ($temp_query->have_posts()) :
      $temp_query->the_post();
      $is_visible = carbon_get_the_post_meta('is_visible');

      if ($is_visible && is_null($first_visible_post)) {
        $first_visible_post = get_post();
        setup_postdata($first_visible_post);
      }
    endwhile;

    wp_reset_postdata();
    
    while ($item->have_posts()) : $item->the_post();

          $is_visible = carbon_get_the_post_meta('is_visible');
          if (!$is_visible) continue;
          
          $investors = carbon_get_the_post_meta('investors-types');

          # data-aos="fade" data-aos-delay="200" 
    ?>

   <section id="investors">  

    <div class="container" >
         <div class="row g-4" data-aos="fade" data-aos-delay="200">
          
         
<?php foreach ($investors as $investor): ?>

            <div class="col-lg-4 col-md-6" >
                <div class="service-card" style="background:url('<?php echo esc_url(ensure_https($investor['image'])); ?>');">
                    <div class="card-body" data-aos="fade-up" data-aos-delay="<?= 600 + ( $loop_index * 150 ); ?>">
                        <h6><?= $investor['title']; ?></h6>
                        <p><?= $investor['text']; ?> 
                      </p>
                    </div>
                </div>
            </div>

           <?php $loop_index++; ?>
<?php endforeach ?> 
        </div>
    </div>
</section>
<?php endwhile; wp_reset_postdata(); ?>
<?php endif; ?>

<?php

  
