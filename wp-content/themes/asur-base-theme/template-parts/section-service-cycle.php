<?php
$page_id = get_the_ID();
$selected_service_cycles = carbon_get_post_meta($page_id, 'selected_service_cycle');

if (empty($selected_service_cycles)) {
    return;
}
$service_cycle_id = $selected_service_cycles[0]['id'];

$direction = carbon_get_post_meta($service_cycle_id, 'service-cycles-direction') === 'yes';
$items = carbon_get_post_meta($service_cycle_id, 'service-cycles');




if (empty($items)) {
    return; // No hay slides
}



?>

<div class="container-fluid p-0 service-cycle">
  <div class="row">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-inner">

        <?php foreach ($items as $index => $item): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="container">
              <div class="row">
<?php if ($direction): ?>
                <div class="col-8 pt-20">
                  <h6 class="over-title"><?= esc_html($item['over-title'] ?? '') ?></h6>
                  <h2 class="title"><?= esc_html($item['title'] ?? '') ?></h2>
                  <p class="pe-5"><?= esc_html($item['text'] ?? '') ?></p>
                </div>
                <div class="col">
                  <div class="position-relative">
                    <div class="service-cycle-number">
                      <?= $index + 1 ?>
                    </div>
                    <div class="absolute service-cycle-arrows">
                      <svg class="rotate-anticlockwise" viewBox="0 0 688 688" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>Grupo 4</title>
                      <g id="Página-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Group-209" transform="translate(-37, -23)">
                          <g id="Grupo-4" transform="translate(381.085, 366.6559) rotate(-360) translate(-381.085, -366.6559) translate(37.4291, 23)">
                            <g id="Grupo" transform="translate(0, 0)">
                              <g id="Grupo-3" transform="translate(118.5709, 0)" fill="#EE5135" fill-opacity="0.5">
                                <g id="Trazado-2" transform="translate(0, -0)">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                                <g id="Trazado-2" transform="translate(256.585, 615.1559) scale(-1, -1) translate(-256.585, -615.1559) translate(61, 543)">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                              </g>
                              <g id="Grupo-3" transform="translate(343.6559, 344.6559) rotate(90) translate(-343.6559, -344.6559) translate(117.5709, 1)">
                                <g id="Trazado-2" transform="translate(0, -0)" fill="#EE5135" fill-opacity="0.5">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                                <g id="Trazado-2" transform="translate(256.585, 615.1559) scale(-1, -1) translate(-256.585, -615.1559) translate(61, 543)" fill="#162944">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                      
                    </div>
                    <div class="service-cycle-img" 
                         style="background-image: url('<?= esc_url($item['image'] ?? '') ?>')">
                    </div>
                  </div>
                </div>
 <?php else: ?>

<div class="col">
                  <div class="position-relative">
                    <div class="service-cycle-number-right">
                      <?= $index + 1 ?>
                    </div>
                    <div class="absolute service-cycle-arrows">
                      <svg class="rotate-clockwise" viewBox="0 0 688 688" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <title>Grupo 4</title>
                      <g id="Página-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Group-209" transform="translate(-37, -23)">
                          <g id="Grupo-4" transform="translate(381.085, 366.6559) rotate(-360) translate(-381.085, -366.6559) translate(37.4291, 23)">
                            <g id="Grupo" transform="translate(0, 0)">
                              <g id="Grupo-3" transform="translate(118.5709, 0)" fill="#EE5135" fill-opacity="0.5">
                                <g id="Trazado-2" transform="translate(0, -0)">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                                <g id="Trazado-2" transform="translate(256.585, 615.1559) scale(-1, -1) translate(-256.585, -615.1559) translate(61, 543)">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                              </g>
                              <g id="Grupo-3" transform="translate(343.6559, 344.6559) rotate(90) translate(-343.6559, -344.6559) translate(117.5709, 1)">
                                <g id="Trazado-2" transform="translate(0, -0)" fill="#EE5135" fill-opacity="0.5">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                                <g id="Trazado-2" transform="translate(256.585, 615.1559) scale(-1, -1) translate(-256.585, -615.1559) translate(61, 543)" fill="#162944">
                                  <path d="M22,34 L0,122 L88.2969111,144.311804 L69.4703407,112.660922 C115.477526,80.2203075 167.820746,64 226.5,64 C273.718843,65.3143218 315.921075,75.5026791 353.106698,94.565072 L391.169912,42.2320658 C338.300336,14.0773553 283.410366,0 226.5,0 C159.173449,0 95.6668017,19.1989901 35.9800566,57.5969702 L22,34 Z" id="Trazado"></path>
                                </g>
                              </g>
                            </g>
                          </g>
                        </g>
                      </g>
                    </svg>
                      
                    </div>
                    <div class="service-cycle-img" 
                         style="background-image: url('<?= esc_url($item['image'] ?? '') ?>')">
                    </div>
                  </div>
                </div>

  <div class="col-8 pt-20 ps-20">
                  <h6 class="over-title"><?= esc_html($item['over-title'] ?? '') ?></h6>
                  <h2 class="title"><?= esc_html($item['title'] ?? '') ?></h2>
                  <p class="pe-5"><?= esc_html($item['text'] ?? '') ?></p>
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