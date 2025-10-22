<?php
    $current_term = get_queried_object();
    $custom_title = carbon_get_term_meta($current_term->term_id, 'taxonomy_custom_title');
    $custom_over_title = carbon_get_term_meta($current_term->term_id, 'taxonomy_custom_over_title');
    $overlay_opacity_tx   = carbon_get_term_meta($current_term->term_id,'hero_overlay_opacity');
    $background_color_tx   = carbon_get_term_meta($current_term->term_id,'hero_background_color');
    $background_image_tx = carbon_get_term_meta($current_term->term_id,'hero_background_image');
    $innovaciones_data = carbon_get_term_meta($current_term->term_id, 'crb_innovacion');

  



    $child_terms = get_terms([
        'taxonomy'   => 'procesos',
        'hide_empty' => false,
        'meta_query' => [
            [
                'key'     => '_crb_industria_parent',
                'value'   => $current_term->term_id,
                'compare' => 'LIKE',
            ],
        ],
    ]);
?>

<?php get_header(); ?>

<section class="hero home" style="background-image: url('<?php echo esc_url(ensure_https($background_image_tx)); ?>')">        
            <div class="hero-overlay <?= esc_attr($overlay_opacity_tx); ?>" style="background-color: <?= esc_attr($background_color_tx); ?>;"></div>
        
            <div class="hero-title">
                    <div class="row">
                    <div class="offset-lg-05 col-md-11 col-12">
                        
                            <h1 data-aos="fade-up"><?php echo single_term_title(); ?></h1>
                        
                        </div>

                    </div>
                </div>
            </div>

            <div class="hero-shape">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/img/hero-shape.png" alt="hero-shape">
            </div>

        </section>





    <div class="container py-5 mt-20">
     <div class="row mb-4">
        <div class="col-12">
            <h6 class="over-title text-uppercase"><?= $custom_over_title ?></h6>
            <h1 class="title text-uppercase"><?php echo $custom_title ? esc_html($custom_title) : single_term_title('', false); ?></h1>
        </div>
    </div>
    <div class="row g-4 justify-content-left py-5 mt-10 mb-20">
        <?php if (!empty($child_terms) && !is_wp_error($child_terms)) : ?>
            <?php foreach ($child_terms as $child_term) :
                $term_description = carbon_get_term_meta($child_term->term_id, 'linea_producto_descripcion');
                $term_image_url = carbon_get_term_meta($child_term->term_id, 'linea_producto_imagen');
            ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card border-0 h-100">
                    <?php if ($term_image_url) : ?>
                        <img src="<?php echo esc_url($term_image_url); ?>" class="card-img-top" alt="<?php echo esc_attr($child_term->name); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="fs-4 text-uppercase"><?php echo esc_html($child_term->name); ?></h5>
                        <p class="fs-sm"><?php echo esc_html($term_description); ?></p>
                    </div>
                   <div class="card-footer border-0 d-flex">
    
    <a href="<?php echo esc_url(get_term_link($child_term)); ?>" class="ms-auto btn btn-krom">
        Ver Más <i data-lucide="arrow-right"></i>
    </a>
</div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12">
                <p>No se encontraron líneas de producto para esta industria.</p>
            </div>
        <?php endif; ?>
    </div>
</div>






<div class="container  py-5 mt-20 mb-20">
    <div class="row mb-4">
        <div class="col-12">
            <h6 class="over-title">Proyectos</h6>
            <h1 class="title">Innovación</h1>
        </div>
    </div>
    
<?php
if ( ! empty( $innovaciones_data ) ) {
    foreach ( $innovaciones_data as $item ) {
        $post_id = (int) $item['id'];

        // Obtener el post completo
        $innovacion = get_post( $post_id );

        // Verificar que exista y sea del tipo correcto
        if ( ! $innovacion || $innovacion->post_type !== 'innovacion' || $innovacion->post_status !== 'publish' ) {
            continue;
        }
        $image_html = get_the_post_thumbnail_url( $post_id, 'large' );



        $content_html = get_the_content( $post_id);
        // Obtener campos de Carbon Fields del post 'innovacion'
        $crb_content_over_title      = carbon_get_post_meta( $post_id, 'crb_content_over_title' );
        $crb_content_title           = carbon_get_post_meta( $post_id, 'crb_content_title' );
        $crb_content_texto           = carbon_get_post_meta( $post_id, 'crb_content_texto_enriquecido' );
        $crb_content_imagen          = carbon_get_post_meta( $post_id, 'crb_content_imagen' );
        $crb_hero_title              = carbon_get_post_meta( $post_id, 'crb_hero_title' );
        $crb_hero_imagen             = carbon_get_post_meta( $post_id, 'crb_hero_imagen' );
        $crb_hero_overlay_opacity    = carbon_get_post_meta( $post_id, 'crb_hero_overlay_opacity' );
        $crb_hero_background_color   = carbon_get_post_meta( $post_id, 'crb_hero_background_color' );
        $crb_info_file = carbon_get_post_meta( $post_id, 'crb_info_file' );


        if ( ! empty( $crb_info_file ) && is_array( $crb_info_file ) ) {
        foreach ( $crb_info_file as $item ) {
            $title_file = isset( $item['crb_info_file_name'] ) ? $item['crb_info_file_name'] : '';
            $image_file_id = isset( $item['crb_info_file_image'] ) ? $item['crb_info_file_image'] : '';
            $file_esp = isset( $item['crb_info_file_esp'] ) ? $item['crb_info_file_esp'] : '';
            $file_eng = isset( $item['crb_info_file_eng'] ) ? $item['crb_info_file_eng'] : '';
  }
}
        

        ?>





    <div class="row gx-lg-5 mb-20">
        <div class="col-12 col-lg-8">
            <div class="mb-4 position-relative">
                <div class="bg-orange position-absolute top-0 start-0 m-4"></div>
                
<div class="w-100 position-relative rounded" style="background-image: url('<?php echo $image_html; ?>'); background-size: cover; background-position: center center; background-repeat: no-repeat; min-height: 352px;  "></div>
                   

            </div>
            
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class=""><?php echo esc_html( $crb_content_title ?: $innovacion->post_title ); ?></h4>
                    <?php echo $content_html; ?>                
                </div>
            </div>
        </div>
        
        <div class="col-12 col-lg-3 d-flex flex-column align-items-left mt-5 mt-lg-0">
        
        




        

        
        <div class="card border-0 shadow-sm w-100 h-100 rounded-3 overflow-hidden">
            
                    

                <img src="<?= esc_url($image_file_id); ?>" class="card-img-top" alt="Brochure" style="max-height: 352px; ">
                <div class="card-img-overlay d-flex flex-column justify-content-end bg-dark-gray text-white p-3">
                
                    
                </div>
                <div class="card-body">
                                                <p class="card-text fw-bold"><?= esc_html($title_file); ?></p>
                                                <?php if ($file_esp): ?>
                                                    <div class="d-flex justify-content-between align-items-center card-download-links mt-2">
                                                        <a href="<?= esc_url($file_esp); ?>" target="_blank" class="text-decoration-none">PDF / ESP</a>
                                                        <i data-lucide="download" class="lucide lucide-download"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($file_eng): ?>
                                                    <div class="d-flex justify-content-between align-items-center card-download-links mt-2">
                                                        <a href="<?= esc_url($file_eng); ?>" target="_blank" class="text-decoration-none">PDF / EN</a>
                                                        <i data-lucide="download" class="lucide lucide-download"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
            </div>
        </div>
    </div>



        
        <?php
    }
}
?>

</div>









              


<?php get_footer(); ?>