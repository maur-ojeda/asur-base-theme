<?php

$wsp = carbon_get_theme_option('projects_section_is_visible');


?>



<div class="header">

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-transparent transition-navbar py-3">

    <div class="container" data-aos="fade-up" data-aos-delay="400">

      <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
        <?php
        // Obtener logos del personalizador
        $white_logo_url = get_theme_mod('white_logo');
        $custom_logo_id = get_theme_mod('custom_logo');
        $color_logo_url = $custom_logo_id ? wp_get_attachment_image_url($custom_logo_id, 'full') : '';
        ?>

        <?php if ($white_logo_url) : ?>
          <img src="<?php echo ensure_https($white_logo_url); ?>" alt="<?php bloginfo('name'); ?> Logo" class="logo-white">
        <?php endif; ?>

        <?php if ($color_logo_url) : ?>
          <img src="<?php echo ensure_https($color_logo_url); ?>" alt="<?php bloginfo('name'); ?> Logo" class="logo-color">
        <?php else : // Fallback si no hay logos, muestra el nombre del sitio 
        ?>
          <span class="logo-text"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <i data-lucide="menu" class="text-white"></i>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <?php
        wp_nav_menu([
          'theme_location' => 'main_menu',
          'menu_class'     => 'navbar-nav',
          'container'      => false,
          'walker'         => new Bootstrap_5_Walker_Nav_Menu(),
          'depth'          => 4, // 👈 Ajusta la profundidad del menú aquí

        ]);

        ?>
        <div class="ms-auto d-lg-inline-flex ">

          <div class="ms-auto d-lg-inline-flex">
            <button type="button" class="menu-search-btn" data-bs-toggle="modal" data-bs-target="#searchModal">
              <i data-lucide="search"></i>
              <span class="d-block-xs d-md-none">Buscar</span>
            </button>
          </div>

        </div>

      </div>
    </div>
  </nav>
</div>




<!-- Modal de Búsqueda -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content position-relative">

      <div class="position-absolute top-0 start-100 translate-middle">
        <button type="button" class="btn-close rounded-circle btn-primary-krom" data-bs-dismiss="modal" aria-label="Cerrar">
          <i data-lucide="x"></i>
        </button>
      </div>
      <div class="modal-body p-5">
        <div class="w-100">
          <?php get_search_form(); ?>
        </div>
      </div>
    </div>
  </div>
</div>