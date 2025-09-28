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
        $overtitle = carbon_get_the_post_meta('overtitle');                      
        $form_title = carbon_get_the_post_meta('form_title');           
        $bg_imagen = carbon_get_the_post_meta('bg_imagen');           
        $shortcode = carbon_get_the_post_meta('contact_shortcode');
       
        ?>

<?php if ($is_visible) : ?>

    <section id="contact">    
        <div class="container" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/dist/images/bg-contact-la-aldea.png'); ?>'); background-size: 100%; background-position: bottom left; background-repeat: no-repeat;">            
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="card bg-white shadow-lg" style="margin-bottom:4rem;">
                        <div class="card-body p-5 mb-3">
                            <?php echo do_shortcode($shortcode); ?>
                        </div>
                    </div>
                </div>
                
                <div class="offset-1 col-5 contact-info-wrapper">
                    <div class="contact-info">
                        <h6 class="fw-semibold text-white" data-aos="fade" data-aos-delay="800"><?php echo esc_html($overtitle); ?></h6>
                        <h3 class="display-6 mb-3 text-white" data-aos="fade-up"><?php echo esc_html($title); ?></h3>
                        <p class=" text-white"><?php echo esc_html($content); ?></p>
                
                        <div class="">
                            <?php if ($items):
                            foreach ($items as $item):
                            $icon = esc_html($item['contact_icon']);
                            $title = esc_html($item['contact_title']);
                            $text = esc_html($item['contact_text']);
                            $url = esc_url($item['contact_url']);
                            ?>   
                                <div class="contact-item" data-aos="fade-left" data-aos-delay="200">            
                                    <p><i data-lucide="<?= $icon ?>"></i> <?= $title ?>: <a href="<?= $url; ?>"><?= $text; ?></a></p>                                                                      
                                </div>
                            <?php 
                            endforeach; 
                            endif;
                            ?>
                        </div>

                        <div class="text-white">
                            <span class="fw-semibold">Redes Sociales: </span>
                            <?php if ($socials):
                            foreach ($socials as $social):
                            $icon_social = esc_html($social['social_icon']);                    
                            $url_social = esc_url($social['social_url']);
                            ?>   
                                
                                    <a class="d-inline text-white" data-aos="fade-left" data-aos-delay="200" href="<?= $url_social; ?>"><i data-lucide="<?= $icon_social ?>"></i></a>
                                
                            <?php 
                            endforeach; 
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>
    
    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
