<?php
$cpt_name = "info-block";

$selected_blocks = carbon_get_post_meta(get_the_ID(), "selected_info_blocks");
$block_index = $args['index'] ?? null;

if (!empty($selected_blocks) && $block_index !== null && isset($selected_blocks[$block_index]['id'])) {
    $block_id = $selected_blocks[$block_index]['id'];

    $block_query = new WP_Query([
        'post_type'      => $cpt_name,
        'p'              => $block_id,
        'post_status'    => 'publish',
        'posts_per_page' => 1,
    ]);

    if ($block_query->have_posts()) :
        while ($block_query->have_posts()) : $block_query->the_post();
        // Carbon Fields data.
            $is_visible = carbon_get_post_meta(get_the_ID(), 'is_visible');
            $title = get_the_title();
            $content = get_the_content();
            $type = carbon_get_post_meta(get_the_ID(), 'type');
            $title       = get_the_title();
            $overTitle  = carbon_get_post_meta(get_the_ID(), 'over_title');
            $extraTitle = carbon_get_post_meta(get_the_ID(), 'extraTitle');
            $image       = carbon_get_post_meta(get_the_ID(), 'image');
            $btnText     = carbon_get_post_meta(get_the_ID(), 'btnText');
            $btnUrl     = carbon_get_post_meta(get_the_ID(), 'btn_url');
            $order = '';

            switch ($type) {
                case 'type-2': // texto derecha, imagen izquierda, adorno izquierda
                case 'type-5': // texto derecha, imagen izquierda, adorno arriba
                    $order = 'order-first';
                    break;
                case 'type-1': // texto izquierda, imagen derecha
                case 'type-3': // texto derecha, imagen izquierda, adorno arriba
                case 'type-4': // texto derecha, imagen izquierda, sin adorno
                    $order = 'order-last';
                    break;
                // type-6 (solo texto) and default have no specific order.
            }
            ?>

           



<section class="info-block">

<span class="badge rounded-pill text-bg-danger"><?= $type; ?></span>


    <div class="container mt-5">        
        <?php if ($type === 'type-3' && $extraTitle && $extraOverTitle) : ?>
            <div class="row mb-20">
                <div class="col-12 col-md-10" data-aos="fade" data-aos-delay="100">
                    <h6 class="over-title"><?= esc_html($extraOverTitle); ?></h6>
                    <h2 class="title"><?= esc_html($extraTitle); ?></h2>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">

            <?php // --- Image Column (if not type-6) --- ?>
            <?php if ($type !== 'type-6') : ?>
                <div class="col-12 offset-md-1 col-md-4 <?= esc_attr($order); ?>" data-aos="fade-right">
                    <div class="img-krom-wrapper <?= esc_attr($type); ?>">
                        <img class="img-krom <?= esc_attr($order); ?>" src="<?php echo esc_url(ensure_https($image)); ?>" alt="">
                    </div>
                </div>
            <?php endif; ?>

            <?php // --- Content Column --- ?>
            <div class="col">
                <?php if ($overTitle) : ?>
                    <h6 class="over-title" data-aos="fade-up" data-aos-delay="200"><?= esc_html($overTitle); ?></h6>
                <?php endif; ?>

                <h2 class="title" data-aos="fade-up" data-aos-delay="400"><?= esc_html($title); ?></h2>

                <div class="wysiwyg" data-aos="fade-up" data-aos-delay="600">
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
        endwhile;
        wp_reset_postdata();
    endif;
} else {
    echo '<!-- Info block no disponible -->';
}
