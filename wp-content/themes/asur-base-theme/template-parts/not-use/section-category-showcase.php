<?php
$index = $args['index'] ?? 0;
$block = get_reusable_cpt_block(get_the_ID(), 'category-showcase', 'selected_category_showcase', $index);

if ($block) :
    $title = get_the_title($block);    
    $destacados = carbon_get_post_meta($block->ID, 'crb_destacados_agrupados');
?>
        <section class="category-showcase">
            <div class="container-fluid">
                <div class="row">
                    <?php foreach ($destacados as $bloque) :
                        $term_data = $bloque['taxonomia_destacada'];                
                        if (empty($term_data)) {
                            continue; 
                        }            
                        $term = get_term($term_data[0]['id']);            
                        if (is_wp_error($term)) {
                            continue; 
                        }
                        $image_id = $bloque['image'];
                        $image_url = wp_get_attachment_image_url($image_id, 'large');
                        $title = $term->name;
                        $titleColor = !empty($bloque['title_color']) ? $bloque['title_color'] : '#FFF';                                                                        
                        $btn_txt = 'Ver más';
                        $btn_url = get_term_link($term);
                    ?>
                        <div class="category-showcase-item" style="background-image: url('<?php echo esc_url(ensure_https($image_url)); ?>')">
                            <div>    
                                <h3 class="category-showcase-title" style="color:<?= $titleColor ?>"  data-aos="fade" data-aos-delay="200"><?= esc_html($title); ?></h3>
                                <a class="btn-krom" href="<?= esc_url($btn_url); ?>"><?= esc_html($btn_txt); ?><i data-lucide="arrow-right"></i></a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

<?php endif; ?> 


