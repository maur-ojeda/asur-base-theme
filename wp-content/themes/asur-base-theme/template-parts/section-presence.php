<?php
$index = $args['index'] ?? 0;

// int(1) int(130)
$block = get_reusable_cpt_block_presense(
    get_the_ID(),
    'presence',
    'selected_presences',
    $index
);


var_dump($index);
var_dump(get_the_ID());
var_dump($block);


if (!$block) {
    return;
}


$maintitle = get_the_title($block);
$over_title = carbon_get_post_meta($block->ID, 'over_title');
$title      = carbon_get_post_meta($block->ID, 'title');
$presences  = carbon_get_post_meta($block->ID, 'presences'); // este es tu campo complex
?>


<?= $maintitle  ?>


<section class="presence-section py-5">
    <div class="container">
        <div class="row mb-5 text-center">
            <?php if ($over_title): ?>
                <h6 class="over-title"><?= esc_html($over_title); ?></h6>
            <?php endif; ?>
            <?php if ($title): ?>
                <h2 class="title"><?= esc_html($title); ?></h2>
            <?php endif; ?>
        </div>

        <?php if (!empty($presences) && is_array($presences)): ?>
            <div class="row g-4">
                <?php foreach ($presences as $item):
                    $image = $item['presence-image'] ?? '';
                    $item_title = $item['presence-title'] ?? '';
                    $description = $item['presence-description'] ?? '';
                ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="presence-item text-center h-100">
                            <?php if ($image): ?>
                                <div class="mb-3">
                                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($item_title); ?>" class="img-fluid" style="max-height: 120px; object-fit: contain;">
                                </div>
                            <?php endif; ?>
                            <?php if ($item_title): ?>
                                <h5><?= esc_html($item_title); ?></h5>
                            <?php endif; ?>
                            <?php if ($description): ?>
                                <div class="mt-2 text-muted">
                                    <?= wp_kses_post($description); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>