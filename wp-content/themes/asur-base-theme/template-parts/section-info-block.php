<?php

$index = $args['index'] ?? 0;
$block = get_reusable_cpt_block(get_the_ID(), 'info-block', 'selected_info_blocks', $index);




if ($block) :
    $is_visible = carbon_get_post_meta(get_the_ID(), 'is_visible');
    $title = get_the_title($block);
    $content = apply_filters('the_content', $block->post_content);
    $type = carbon_get_post_meta($block->ID, 'type');
    $overTitle  = carbon_get_post_meta($block->ID, 'over_title');
    $extraTitle = carbon_get_post_meta($block->ID, 'extra_title');
    $extraOverTitle  = carbon_get_post_meta($block->ID, 'extra_overtitle');
    $image       = carbon_get_post_meta($block->ID, 'image');
    $icon   = carbon_get_post_meta($block->ID, 'btn_icon');
    $btnText     = carbon_get_post_meta($block->ID, 'btn_txt');
    $btnUrl     = carbon_get_post_meta($block->ID, 'btn_url');
    $order = '';




    switch ($type) {
        case 'type-2': // texto derecha, imagen izquierda, adorno izquierda
        case 'type-5': // texto derecha, imagen izquierda, adorno arriba
            $order = 'order-first';
            break;
        case 'type-1': // texto izquierda, imagen derecha
        case 'type-3': // texto derecha, imagen izquierda, adorno arriba
        case 'type-4': // texto derecha, imagen izquierda, sin adorno
        case 'type-9': // texto derecha, imagen izquierda, sin adorno
            $order = 'order-last';
            break;
            // type-6 (solo texto) and default have no specific order.
    }
?>



    <section class="info-block">
        <div class="container mt-5">
            <?php if (($type === 'type-3' || $type === 'type-5') && $extraTitle && $extraOverTitle) : ?>
                <div class="row mb-20">
                    <div class="col-12 col-md-10" data-aos="fade" data-aos-delay="100">
                        <h6 class="over-title"><?= esc_html($extraOverTitle); ?></h6>
                        <h2 class="title"><?= esc_html($extraTitle); ?></h2>
                    </div>
                </div>
            <?php endif; ?>

            <div class="row">

                <?php // --- Image Column (if not type-6) --- 
                ?>
                <?php if ($type !== 'type-6') : ?>
                    <div class="col-12 <?= ($type !== 'type-2' && $type !== 'type-8' && $type !== 'type-9') ? 'offset-md-1' : '' ?> <?= ($type === 'type-8' || $type === 'type-9') ? 'col-md-6' : 'col-md-4' ?> <?= esc_attr($order); ?>" data-aos="fade-up
                ">
                        <div class="img-krom-wrapper <?= esc_attr($type); ?>">
                            <img class="img-krom <?= esc_attr($order); ?>  <?= ($type === 'type-8' || $type === 'type-9') ? 'w-100' : '' ?>" src="<?php echo esc_url(ensure_https($image)); ?>" alt="">
                        </div>
                    </div>
                <?php endif; ?>

                <?php // --- Content Column --- 
                ?>
                <div class="col <?= ($type === 'type-2') ? 'offset-md-1' : 'ps-md-10' ?>">
                    <?php if ($overTitle) : ?>
                        <h6 class="over-title" data-aos="fade-up" data-aos-delay="200"><?= esc_html($overTitle); ?></h6>
                    <?php endif; ?>

                    <h2 class="title" data-aos="fade-up" data-aos-delay="400"><?= esc_html($title); ?></h2>

                    <div class="wysiwyg" data-aos="fade-up" data-aos-delay="600" class="me-lg-4">
                        <?php echo apply_filters('the_content', $content); ?>
                    </div>

                    <?php if ($btnUrl && $btnText) : ?>
                        <a href="<?= esc_url($btnUrl); ?>" class="btn-krom" data-aos="fade-up" data-aos-delay="800">
                            <?= esc_html($btnText); ?>
                            <i data-lucide="<?php echo esc_attr($icon); ?>"></i>
                        </a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </section>


<?php

endif;
?>