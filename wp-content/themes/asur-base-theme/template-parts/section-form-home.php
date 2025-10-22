<?php
$args = array(
    'post_type'      => 'contact',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC'
);

$contact_query = new WP_Query($args);

if ($contact_query->have_posts()) :
    while ($contact_query->have_posts()) : $contact_query->the_post();
        $title = get_the_title();
        $overtitle = carbon_get_the_post_meta('over_title');
        $form_title = carbon_get_the_post_meta('form_title');
        $bg_imagen = carbon_get_the_post_meta('bg_imagen');
        $shortcode = carbon_get_the_post_meta('contact_shortcode');
?>


        <div id="contact" class="container-fluid p-0">



            <div class="custom-bg-dark">
                <div class="container">
                    <div class="col-12 py-10">
                        <h6 class="over-title" data-aos="fade" data-aos-delay="800"><?php echo esc_html($overtitle); ?></h6>
                        <h3 class="title text-white" data-aos="fade-up"><?php echo esc_html($title); ?></h3>
                    </div>

                </div>
            </div>



            <div class="container-fluid pt-20 pb-20" style="background-image:url('<?php echo esc_url(ensure_https($bg_imagen)); ?>');  background-size: cover; background-position: center; min-height: 100vh;">
                <div class="container pt-20 pb-20">
                    <div class="col-12 col-md-8 col-lg-5 form-container rounded">
                        <h4 class="mb-4"><?php echo esc_html($form_title); ?></h4>

                        <?php echo do_shortcode($shortcode); ?>
                    </div>
                </div>
            </div>





        </div>







<?php
    endwhile;
    wp_reset_postdata();
endif;
?>