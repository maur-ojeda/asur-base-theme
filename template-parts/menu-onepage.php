<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-transparent transition-navbar py-3">
  <div class="container" data-aos="fade-up" 
                        data-aos-delay="400">
    <a class="navbar-brand" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
            <?php
            wp_nav_menu([
                'theme_location' => 'main_menu',
                'menu_class'     => 'navbar-nav ms-auto',
                'container'      => false,
                'walker'         => new Bootstrap_5_Walker_Nav_Menu(), 
            ]);
            ?>
           <a href="#contact" class="btn btn-primary ms-lg-3 d-none d-lg-inline-flex align-items-center">
                Contáctanos
            </a>
        </div>
  </div>
</nav>

