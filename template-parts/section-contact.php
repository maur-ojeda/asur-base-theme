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
        $desc = get_the_content();
        $items = carbon_get_the_post_meta('contact_items');           
        $shortcode = carbon_get_the_post_meta('contact_shortcode');
        $is_visible = carbon_get_the_post_meta('is_visible');                      
        ?>

<?php if ($is_visible) : ?>

    <section id="contact" style="background-image:url('<?php echo esc_url(get_template_directory_uri() . '/dist/images/bg-02.jpg'); ?>'); background-size:contain; background-position: top center;">
        <div class="container">            
            <div class="intro-section" data-aos="fade" data-aos-delay="200">
                        <h1><?= esc_html($title); ?></h1>
                        <p><?= esc_html(strip_tags($desc)); ?></p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    
         <?php
            if ($items):
                foreach ($items as $item):
                    $icon = esc_html($item['contact_icon']);
                    $title = esc_html($item['contact_title']);
                    $text = esc_html($item['contact_text']);
                    $url = esc_url($item['contact_url']);
             ?>   
        
        
            <div class="contact-item" data-aos="fade-left" data-aos-delay="200">        
                <div class="icon">
                    <i data-lucide="<?= $icon ?>"></i></div>            
                <div class="content">        
                <h5><?= $title ?></h5>                                                                                   
                <p><a href="<?= $url; ?>"><?= $text; ?></a></p>                                                                      
                </div>
            </div>

        <?php 
        endforeach; 
        endif;
        ?>

                </div>   
                <div class="col-md-6">
                    <?php if ($shortcode): ?>
                    <div class="form">
                        <h2>Solicita tu cotización</h2>
                        <?php echo do_shortcode($shortcode); ?>
                    </div>
                <?php endif; ?>
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
