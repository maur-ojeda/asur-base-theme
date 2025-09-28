<?php

if (have_posts()) {
    while (have_posts()) {
        the_post(); // Inicia el loop de WordPress para esta página

        // --- Recuperar los valores de los campos personalizados ---
        $bg_imagen_url = carbon_get_the_post_meta('bg_company_imagen'); // URL de la imagen de fondo
        $items = carbon_get_the_post_meta('crb_company_item'); // Array de ítems del carrusel

        // --- Generar el HTML ---
        ?>
        <div class="container my-5">
            <div class="text-start mb-4">
                <p class="over-title">KROM INDUSTRY</p>
                <h1 class="title">NUESTROS FINES</h1>
            </div>
        </div>

        <!-- Contenedor del carrusel con imagen de fondo -->
        <div class="container-fluid bg-dark py-20" style="<?php if ($bg_imagen_url): ?>background-image: url('<?php echo esc_url($bg_imagen_url); ?>'); background-size: cover; background-position: center;<?php endif; ?>">
            <div class="offset-md-3 col-md-6">
                <div id="textCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php if ($items && is_array($items) && !empty($items)): ?>
                            <?php
                            $contador = 0;
                            foreach ($items as $item):
                                $contador++;
                                $is_active = ($contador === 1) ? ' active' : ''; // La primera diapositiva es activa
                            ?>
                                <div class="carousel-item<?php echo $is_active; ?>">
                                    <div class="d-flex align-items-center justify-content-center p-5">
                                        <div class="text-white bg-secondary-krom p-12 rounded">
                                            <h2 class="text-primary fs-1 text-center mb-3"><?php echo esc_html($item['title']); ?></h2>
                                            <div class="item-text wysiwyg">
                                                <?php echo ($item['text']); ?>
                                            </div>

                                                <a class="btn btn-krom mt-3 float-end px-5"  role="button" data-bs-target="#textCarousel" data-bs-slide="next">
                                                 
                                                    <i data-lucide="arrow-right"></i>
                                                </a>

                                            <?php if (!empty($item['button_text']) && !empty($item['button_url'])): ?>
                                                <a class="btn btn-primary mt-3 float-end" href="<?php echo esc_url($item['button_url']); ?>" role="button">
                                                    <?php echo esc_html($item['button_text']); ?>
                                                    <i class="bi bi-arrow-right"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Mensaje o diapositiva por defecto si no hay ítems -->
                            <div class="carousel-item active">
                                <div class="d-flex align-items-center justify-content-center p-5">
                                    <div class="text-white bg-secondary p-5" style="--bs-bg-opacity: .75;">
                                        <h2 class="text-uppercase fw-bold mb-3">No hay ítems</h2>
                                        <p>Agrega ítems en el panel de edición de esta página.</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                   
                </div>
            </div>
        </div>

        <?php
        // Opcional: Mostrar el contenido estándar de la página
        // the_content();
    }
}


?>