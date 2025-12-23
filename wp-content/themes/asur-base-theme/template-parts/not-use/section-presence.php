<?php

$index = $args['index'] ?? 0;

$block = get_reusable_cpt_block(
    get_the_ID(),
    'presence',
    'selected_presences',
    $index
);

if (!$block) {
    return;
}

$maintitle = get_the_title($block);
$over_title = carbon_get_post_meta($block->ID, 'over_title');
$title      = carbon_get_post_meta($block->ID, 'title');
$presences  = carbon_get_post_meta($block->ID, 'presences');

?>



<section class="presence-section py-5" data-aos="fade-up" data-aos-delay="100">
    <div class="container mt-5">
        <div class="row mb-20">
            <div class="col-12 col-md-10">
                <?php if ($over_title): ?>
                    <h6 class="over-title"><?= esc_html($over_title); ?></h6>
                <?php endif; ?>
                <?php if ($title): ?>
                    <h2 class="title"><?= esc_html($title); ?></h2>
                <?php endif; ?>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <?php if (!empty($presences) && is_array($presences)): ?>
                    <!-- Carousel -->
                    <div id="presenceCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="hover">



                        <!-- Indicadores -->
                        <div class="carousel-indicators">
                            <?php foreach ($presences as $i => $item): ?>
                                <button type="button" data-bs-target="#presenceCarousel" data-bs-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?> aria-current="<?= $i === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $i + 1 ?>"></button>
                            <?php endforeach; ?>
                        </div>

                        <!-- Slides -->
                        <div class="carousel-inner">
                            <?php foreach ($presences as $i => $item):
                                $image = $item['presence-image'] ?? '';
                                $item_title = $item['presence-title'] ?? '';
                                $description = $item['presence-description'] ?? '';
                            ?>
                                <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                                    <div class="row px-10">
                                        <div class="col-12 col-md-5 ps-md-5">
                                            <?php if ($image): ?>
                                                <div class="img-krom-wrapper type-2">
                                                    <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($item_title); ?>" class="img-krom">
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col ps-md-10 pe-md-5">
                                            <?php if ($item_title): ?>
                                                <h3><?= esc_html($item_title); ?></h3>
                                            <?php endif; ?>
                                            <?php if ($description): ?>
                                                <p><?= wp_kses_post($description); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Flechas -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#presenceCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#presenceCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>