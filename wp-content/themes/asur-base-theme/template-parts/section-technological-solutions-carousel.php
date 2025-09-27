
<?php


$section_query = new WP_Query([
    'post_type'      => 'innovation-files',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'no_found_rows'  => true,
]);

$section_data = null;
if ($section_query->have_posts()) {
    $section_query->the_post();
    $section_data = [
//        'subtitle' => carbon_get_post_meta(get_the_ID(), 'crb_section_subtitle'),
        'title'    => get_the_title(),
        'content'  => get_the_content(),
    ];
    wp_reset_postdata();
}



$post_name = "innovacion";

$item = new WP_Query([
    'post_type'      => $post_name,
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);

if ($item->have_posts()):
    // Recolectar todos los materiales
    $all_materials = [];

    while ($item->have_posts()): $item->the_post();
        $materials = carbon_get_post_meta(get_the_ID(), 'crb_info_file');
        if (!empty($materials)) {
            foreach ($materials as $material) {
                $all_materials[] = [
                    'title'      => !empty($material['crb_info_file_name']) ? $material['crb_info_file_name'] : 'Material sin título',
                    'image_id'   => !empty($material['crb_info_file_image']) ? $material['crb_info_file_image'] : '',
                    'file_esp'   => !empty($material['crb_info_file_esp']) ? $material['crb_info_file_esp'] : '',
                    'file_eng'   => !empty($material['crb_info_file_eng']) ? $material['crb_info_file_eng'] : '',
                    'post_title' => get_the_title(),
                ];
            }
        }
    endwhile;

    wp_reset_postdata();

    if (empty($all_materials)) {
        return;
    }

    // === CARRUSEL PARA MOBILE (1 por slide) ===
    ?>
    <div class="container py-20 my-20">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <h6 class="over-title">Soluciones Tecnológicas</h6>
                <h2 class="title"> <?= $section_data && !empty($section_data['title']) 
                        ? esc_html($section_data['title']) 
                        : 'SISTEMAS INTELIGENTES'; ?></h2>
                 <p>
                    <?= $section_data && !empty($section_data['content']) 
                        ? wp_kses_post($section_data['content']) 
                        : 'Nos especializamos en acompañar a nuestros clientes en sus procesos de transformación digital, facilitando la convergencia IT/OT y aplicando metodologías ágiles para acelerar la innovación, reducir costos, mejorar la eficiencia y garantizar la adaptabilidad frente a los desafíos de la industria 4.0.'; ?>
                </p>
            </div>

            <div class="col-lg-7">
                <!-- Carrusel Mobile -->
                <div id="techCarouselMobile" class="carousel slide d-block d-md-none" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($all_materials as $index => $material): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <div class="row g-4 justify-content-center">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card border-0 rounded-4 overflow-hidden h-100">
                                            <div class="position-relative">
                                                <?php
                                                $img_url = $material['image_id'] 
                                                    ? wp_get_attachment_image_url($material['image_id'], 'medium') 
                                                    : 'https://placehold.co/600x800';
                                                ?>
                                                
                                                <img src="<?= esc_url($img_url); ?>" class="card-img-top" alt="<?= esc_attr($material['title']); ?>">
                                                
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text fw-bold"><?= esc_html($material['title']); ?></p>
                                                <?php if ($material['file_esp']): ?>
                                                    <div class="d-flex justify-content-between align-items-center card-download-links mt-2">
                                                        <a href="<?= esc_url($material['file_esp']); ?>" target="_blank" class="text-decoration-none">PDF / ESP</a>
                                                        <i data-lucide="download" class="lucide lucide-download"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($material['file_eng']): ?>
                                                    <div class="d-flex justify-content-between align-items-center card-download-links mt-2">
                                                        <a href="<?= esc_url($material['file_eng']); ?>" target="_blank" class="text-decoration-none">PDF / EN</a>
                                                        <i data-lucide="download" class="lucide lucide-download"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#techCarouselMobile" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#techCarouselMobile" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>

                <!-- Carrusel Desktop/Tablet -->
                <?php
                $slides = array_chunk($all_materials, 3);
                ?>


                <div id="techCarouselDesktop" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php foreach ($slides as $slide_index => $slide_materials): ?>
                            <div class="carousel-item <?= $slide_index === 0 ? 'active' : '' ?>">
                                <div class="row g-4 justify-content-center">
                                    <?php foreach ($slide_materials as $material): ?>
                                        <div class="col-12 col-md-6 col-lg-4">
                                            <div class="card border-0 h-100">
                                                <div class="position-relative">
                                                    <?php
                                                    $img_url = $material['image_id'] 
                                                        ? wp_get_attachment_image_url($material['image_id'], 'medium') 
                                                        : 'https://placehold.co/600x800';
                                                    ?>
                                                    <img src="<?= esc_url($img_url); ?>" class="card-img-top" alt="<?= esc_attr($material['title']); ?>">
                                                    
                                                </div>
                                                <div class="card-body p-0">
                                                    <p class="fw-semibold mt-2 mb-2"><?= esc_html($material['title']); ?></p>
                                                    
                                                    <?php if ($material['file_esp']): ?>
                                                        <div class="d-flex justify-content-between align-items-center card-download-links">
                                                            <a href="<?= esc_url($material['file_esp']); ?>" target="_blank" class="text-decoration-none text-primary fw-semibold">PDF / ESP</a>
                                                            <i data-lucide="download" class="lucide lucide-download text-primary"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($material['file_eng']): ?>
                                                        <div class="d-flex justify-content-between align-items-center card-download-links">
                                                            <a href="<?= esc_url($material['file_eng']); ?>" target="_blank" class="text-decoration-none text-primary fw-semibold">PDF / EN</a>
                                                            <i data-lucide="download" class="lucide lucide-download text-primary"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#techCarouselDesktop" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#techCarouselDesktop" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>