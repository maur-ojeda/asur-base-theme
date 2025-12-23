<?php
$page_id = get_the_ID();
$selected_service_cycles = carbon_get_post_meta($page_id, 'selected_service_cycle');

if (empty($selected_service_cycles) || !is_array($selected_service_cycles)) {
  return;
}

$service_cycle_id = $selected_service_cycles[0]['id'] ?? null;

if (!$service_cycle_id || !get_post($service_cycle_id)) {
  return;
}

$direction = carbon_get_post_meta($service_cycle_id, 'service-cycles-direction');


$items = carbon_get_post_meta($service_cycle_id, 'service-cycles');

if (empty($items) || !is_array($items)) {
  return;
}

// SVG reusable
$arrow_svg = '

<svg width="687.3118px" height="687.3118px" viewBox="0 0 687.3118 687.3118" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <g id="Página-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Lienzo" transform="translate(-319, -422)" fill-rule="nonzero">
            <g id="cycle" transform="translate(319, 422)">
                <path d="M201.570988,576.999996 L179.570988,664.999996 L267.867899,687.3118 L249.041329,655.660918 C295.048514,623.220304 347.391734,606.999996 406.070988,606.999996 C453.289831,608.314318 495.492063,618.502675 532.677686,637.565068 L570.7409,585.232062 C517.871324,557.077351 462.981354,542.999996 406.070988,542.999996 C338.744437,542.999996 275.23779,562.198986 215.551045,600.596966 L201.570988,576.999996 Z" id="right" fill="#F48E7C" transform="translate(375.1559, 615.1559) rotate(180) translate(-375.1559, -615.1559)"></path>
                <path d="M441.570942,275.999954 L419.570942,363.999954 L507.867853,386.311758 L489.041283,354.660876 C535.048468,322.220261 587.391688,305.999954 646.070942,305.999954 C693.289785,307.314276 735.492017,317.502633 772.67764,336.565026 L810.740854,284.23202 C757.871278,256.077309 702.981308,241.999954 646.070942,241.999954 C578.744391,241.999954 515.237744,261.198944 455.550999,299.596924 L441.570942,275.999954 Z" id="top" fill="#F48E7C" transform="translate(615.1559, 314.1559) rotate(90) translate(-615.1559, -314.1559)"></path>
                <path d="M-101.429054,337.000042 L-123.429054,425.000042 L-35.1321429,447.311846 L-53.9587133,415.660964 C-7.951528,383.22035 44.391692,367.000042 103.070946,367.000042 C150.289789,368.314364 192.492021,378.502721 229.677644,397.565114 L267.740858,345.232108 C214.871282,317.077397 159.981312,303.000042 103.070946,303.000042 C35.744395,303.000042 -27.7622523,322.199032 -87.4489974,360.597012 L-101.429054,337.000042 Z" id="bottom" fill="#F48E7C" transform="translate(72.1559, 375.1559) rotate(270) translate(-72.1559, -375.1559)"></path>
                <path d="M140.5709,34 L118.5709,122 L206.867811,144.311804 L188.041241,112.660922 C234.048426,80.2203075 286.391646,64 345.0709,64 C392.289743,65.3143218 434.491975,75.5026791 471.677598,94.565072 L509.740812,42.2320658 C456.871236,14.0773553 401.981266,0 345.0709,0 C277.744349,0 214.237702,19.1989901 154.550957,57.5969702 L140.5709,34 Z" id="left" fill="#162944"></path>
            </g>
        </g>
    </g>
</svg>
';
?>



<div class="container-fluid p-0 service-cycle position-relative overflow-hidden">
  <div class="row">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-inner">

        <?php foreach ($items as $index => $item):

          if (!is_array($item)) continue;
          $over_title = $item['over-title'] ?? '';
          $title = $item['title'] ?? '';
          $text = $item['text'] ?? '';
          $image = $item['image'] ?? '';
        ?>


          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="container position-relative">
              <div class="row align-items-center min-vh-100">
                <?php if ($direction): ?>
                  <!-- Dirección normal -->
                  <div class="col-12 col-md-6 col-lg-8 pt-5 pt-lg-20 text-md-end pe-20">
                    <h6 class="over-title"><?= esc_html($over_title) ?></h6>
                    <h2 class="title"><?= esc_html($title) ?></h2>
                    <p><?= esc_html($text) ?></p>
                  </div>

                  <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="service-cycle-content">
                      <div class="service-cycle-number"><?= $index + 1 ?></div>
                      <div class="service-cycle-arrows">
                        <?= str_replace('<svg', '<svg class="rotate-anticlockwise"', $arrow_svg) ?>
                      </div>
                      <div class="service-cycle-img" style="background-image: url('<?= esc_url($image) ?>')"></div>
                    </div>
                  </div>

                <?php else: ?>
                  <!-- Dirección invertida -->
                  <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center order-last order-md-first">
                    <div class="service-cycle-content">
                      <div class="service-cycle-number-right"><?= $index + 1 ?></div>
                      <div class="service-cycle-arrows">
                        <?= str_replace('<svg', '<svg class="rotate-clockwise"', $arrow_svg) ?>
                      </div>
                      <div class="service-cycle-img" style="background-image: url('<?= esc_url($image) ?>')"></div>
                    </div>
                  </div>

                  <div class="col-12 col-md-6 col-lg-8 pt-5 pt-lg-20 text-md-start ps-20">
                    <h6 class="over-title"><?= esc_html($over_title) ?></h6>
                    <h2 class="title"><?= esc_html($title) ?></h2>
                    <p><?= esc_html($text) ?></p>
                  </div>
                <?php endif; ?>

              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>

      <?php if (count($items) > 1): ?>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      <?php endif; ?>

    </div>
  </div>
</div>