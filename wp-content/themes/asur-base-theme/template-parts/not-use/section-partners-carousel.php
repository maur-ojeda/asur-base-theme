<?php
$index = $args['index'] ?? 0;
$block = get_reusable_cpt_block(get_the_ID(), 'partner-carousel', 'selected_partner_carousel', $index);




if (!$block) {
  return;
}

$over_title = carbon_get_post_meta($block->ID, 'over-title');
$title = carbon_get_post_meta($block->ID, 'title');
$partners = carbon_get_post_meta($block->ID, 'partners');

if (empty($partners)) {
  return;
}
$carousel_id = 'partners-swiper-' . $block->ID;
?>




<div class="container">
  <div class="row">
    <div class="col-12 text-start mb-4 px-5">
      <?php if ($over_title): ?>
        <p class="over-title"><?= esc_html($over_title) ?></p>
      <?php endif; ?>
      <?php if ($title): ?>
        <h1 class="title"><?= esc_html($title) ?></h1>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="container-fluid my-5">

  <div class="position-relative overflow-hidden">
    <div class="top-circle"></div>
    <div class="bottom-circle"></div>

    <div class="swiper <?= esc_attr($carousel_id) ?>">
      <div class="swiper-wrapper">
        <?php foreach ($partners as $partner): ?>
          <?php if (!empty($partner['client_logo'])): ?>
            <div class="swiper-slide partner-card">
              <img src="<?= esc_url($partner['client_logo']) ?>" class="img-fluid" loading="lazy" alt="Partner">
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    new Swiper('.<?= esc_js($carousel_id) ?>', {
      slidesPerView: 5,
      spaceBetween: 20,
      loop: true,
      grabCursor: true,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
      },
      speed: 3000,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        320: {
          slidesPerView: 1.5,
          spaceBetween: 10
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1024: {
          slidesPerView: 5,
          spaceBetween: 20
        }
      }
    });
  });
</script>