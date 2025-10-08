<?php
$footer_settings_query = new WP_Query([
    'post_type'      => 'footer_settings',
    'posts_per_page' => 1,
    'post_status'    => 'publish',
    'orderby'        => 'date',
    'order'          => 'DESC',
]);


if ($footer_settings_query->have_posts()) {
    while ($footer_settings_query->have_posts()) {
        $footer_settings_query->the_post();
        

        $footer_bg_image = carbon_get_the_post_meta('footer_background_image');
        $footer_logo = carbon_get_the_post_meta('footer_logo');
        $footer_description = carbon_get_the_post_meta('footer_description');
        $contact_phone   = carbon_get_the_post_meta('footer_phone') ;
        $contact_email   = carbon_get_the_post_meta('footer_email') ;
        $contact_address = carbon_get_the_post_meta('footer_address') ;
        $footer_opening = carbon_get_the_post_meta('footer_opening'); 
        
    }


    wp_reset_postdata();
}
?>
 
</main>
<div class="footer-bg d-none d-lg-block">   
    <div class="footer-image-clipped" style="background-image: url('<?php echo ensure_https($footer_bg_image); ?>');">
    <div class="py-5 " style="z-index: 4;">
        <div class="container footer-content">
            <div class="row">
                <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                    <img src="<?php echo ensure_https($footer_logo); ?>" alt="KROM">
                    
                    <p class="small text-white"><?php echo esc_html( $footer_description ); ?></p>
                    <div class="d-flex gap-2">
                        <span class="rounded-circle bg-white" style="width:10px; height:10px;"></span>
                        <span class="rounded-circle bg-white" style="width:10px; height:10px;"></span>
                        <span class="rounded-circle bg-white" style="width:10px; height:10px;"></span>
                        <span class="rounded-circle bg-white" style="width:10px; height:10px;"></span>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-6 col-md-4 col-lg-3 mb-4 mb-lg-0">
                            
                        </div>
                        <div class="offfset-ms-6 col-6 col-md-4 col-lg-3 mb-4 mb-lg-0">
                            <h5 class="fw-bold">Servicios</h5>

  <?php
                            // Mostrar el menú principal en el footer
                            wp_nav_menu([
                                'theme_location' => 'main_menu', // Ajusta según tu ubicación de menú
                                'menu_class'     => 'list-unstyled',
                                'container'      => 'ul',
                                'fallback_cb'    => false, // No mostrar nada si no hay menú
                                'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
                                'depth'          => 1, // Solo mostrar primer nivel
                                'walker'         => new class extends Walker_Nav_Menu {
                                    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                                        if ($depth === 0) { // Solo primer nivel
                                            $output .= '<li class="small">';
                                            $output .= '<i data-lucide="chevron-right" class="text-primary me-2"></i>';
                                            $output .= '<a href="' . esc_url($item->url) . '" class="text-white text-decoration-none">';
                                            $output .= esc_html($item->title);
                                            $output .= '</a>';
                                            $output .= '</li>';
                                        }
                                    }
                                }
                            ]);
                            ?>

                   
                        </div>
                        <div class="col-12 col-md-4 col-lg-6">
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <h5 class="fw-bold">Información</h5>
                                    <ul class="list-unstyled">
                                        <li><i data-lucide="chevron-right" class="text-primary me-2"></i> <span class="text-white"><?php echo esc_html( $contact_phone ); ?></span></li>
                                        <li><i data-lucide="chevron-right" class="text-primary me-2"></i> <span class="text-white"><?php echo esc_html( $contact_email ); ?></span></li>
                                        <li><i data-lucide="chevron-right" class="text-primary me-2"></i> <span class="text-white"><?php echo esc_html( $contact_address ); ?></span></li>
                                    </ul>
                                </div>
                                <div class="col-12">
                                    <h5 class="fw-bold">Horarios</h5>
                                    <p class="small text-white"><?php echo esc_html( $footer_opening ); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p class="small text-white mb-0">Copyright © 2024 All rights reserved.</p>
                </div>
            </div>
        </div>
                                </div>



    </div>


    <div class="shape-top-orange"></div>
    
    
    <div class="shape-bottom-orange"></div>
</div>

 <footer class="footer-movil">                                                                      
      <div class="container">                                                                                             
          <div class="row">                                                                                               
              <div class="col-md-6 mb-3">                                                                                 
                  <img src="<?php echo ensure_https($footer_logo); ?>" alt="KROM" class="footer-movil-logo">
                  <p class="fs-xs"><?php echo esc_html( $footer_description ); ?></p>                                     
              </div>                                                                                                      
              <div class="col-md-3 mb-3">                                                                                 
                  <h5 class="fw-bold">Servicios</h5>                                                                      
                  <?php                                                                                                   
                  wp_nav_menu([                                                                                           
                      'theme_location' => 'main_menu',                                                                    
                      'menu_class'     => 'list-unstyled',                                                                
                      'container'      => 'ul',                                                                           
                      'fallback_cb'    => false,                                                                          
                      'depth'          => 1,                                                                              
                  ]);                                                                                                     
                  ?>                                                                                                      
              </div>                                                                                                      
              <div class="col-md-3 mb-3">                                                                                 
                  <h5 class="fw-bold">Contacto</h5>                                                                       
                  <ul class="list-unstyled small">                                                                        
                      <li><i class="icon-xs" data-lucide="phone"></i> <?php echo esc_html( $contact_phone ); ?></li>                                                  
                      <li><i class="icon-xs" data-lucide="mail"></i> <?php echo esc_html( $contact_email ); ?></li>                                                  
                      <li><i class="icon-xs" data-lucide="map-pin"></i> <?php echo esc_html( $contact_address ); ?></li>                                                
                  </ul>                                                                                                   
            </div>                                                                                                      
          </div>                                                                                                          
          <div class="row">                                                                                               
              <div class="col-12 text-center border-top border-secondary pt-3 mt-3">                                      
                  <p class="small mb-0">Copyright ©  <?php echo date('Y'); ?> All rights reserved.</p>                    
              </div>                                                                                                      
         </div>                                                                                                          
  </div>                                                                                                              
  </footer>                                                                                                               
       




    <?php wp_footer();?>
</body>
</html>