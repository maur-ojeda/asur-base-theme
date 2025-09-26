
<?php

$index = $args['index'] ?? 0;
$block = get_reusable_cpt_block(get_the_ID(), 'call-to-action', 'selected_call_to_action', $index);

if ($block) :
    $title = get_the_title($block);    
    $content = apply_filters('the_content', $block->post_content);
    $btnUrl = carbon_get_the_post_meta('cta_link');
    $btnText = carbon_get_the_post_meta('cta_link_text');
    $icon = 'arrow-right';
?>


<section class="call-to-action my-20 py-20">
    <div class="container-krom">
        <div class="row">
            <div class="call-to-action-item">
               <h2 class="title" data-aos="fade-up" data-aos-delay="400"><?= esc_html($title); ?></h2>
          
                <p  data-aos="fade-up" data-aos-delay="600"><?= esc_html(strip_tags($content)); ?></p>       
                
                  <?php if ($btnUrl && $btnText): ?>  
                      <a href="<?= $btnUrl; ?>" class="btn-krom" data-aos="fade-up" data-aos-delay="800">
                        <?= esc_html($btnText); ?>
                        <i data-lucide="<?php echo esc_attr( $icon ); ?>"></i>
                      </a>
                    <?php endif; ?>
            </div>
            </div>
        </div>
    </div>
</section>



<?php endif; ?>













