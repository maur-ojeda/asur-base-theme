<?php get_header(); ?>

<?php
$current_term = get_queried_object();
$custom_title = carbon_get_term_meta($current_term->term_id, 'taxonomy_custom_title');
$parent_data = carbon_get_term_meta($current_term->term_id, 'crb_industria_parent');

$custom_over_title = carbon_get_term_meta($current_term->term_id, 'taxonomy_custom_over_title');

$overlay_opacity_tx   = carbon_get_term_meta($current_term->term_id,'hero_overlay_opacity');
    $background_color_tx   = carbon_get_term_meta($current_term->term_id,'hero_background_color');
    $background_image_tx = carbon_get_term_meta($current_term->term_id,'hero_background_image');
    



$ficha_tecnica_term = get_term_by('slug', 'ficha-tecnica', 'tipo_info');
$ficha_tecnica_id = $ficha_tecnica_term ? $ficha_tecnica_term->term_id : 0;


if ( ! empty( $parent_data ) && isset( $parent_data[0]['id'] ) ) {
    $parent_term_id = (int) $parent_data[0]['id'];
    
    // Obtener el objeto del término
    $parent_term = get_term( $parent_term_id, 'industrias' );
    
    if ( ! is_wp_error( $parent_term ) && $parent_term ) {
        $parent_name = $parent_term->name;      // Nombre
        $parent_slug = $parent_term->slug;      // Slug
        $parent_link = get_term_link( $parent_term ); // URL
    }
}


?>





<section class="hero home" style="background-image: url('<?php echo esc_url(ensure_https($background_image_tx)); ?>')">
        
            <div class="hero-overlay <?= esc_attr($overlay_opacity_tx); ?>" style="background-color: <?= esc_attr($background_color_tx); ?>;"></div>
            
            <div class="hero-title">
                    <div class="row">
                    <div class="offset-lg-05 col-md-11 col-12">
                        
                            <h1 data-aos="fade-up"><?php echo $parent_name; ?></h1>
                        
                        </div>

                    </div>
                </div>
            </div>

            <div class="hero-shape">
                    <img src="<?php echo get_template_directory_uri(); ?>/dist/img/hero-shape.png" alt="hero-shape">
            </div>

        </section>






        <div class="container py-5 mt-20 mb-20">
     <div class="row mb-4">
        <div class="col-12 pb-5">
            <a href="<?php echo esc_url($parent_link); ?>" class="btn btn-sm btn-krom"><i data-lucide="arrow-left"></i></a>
        </div>
        <div class="col-12">
            <h6 class="over-title text-uppercase"><?= $custom_over_title ?></h6>
            <h1 class="title text-uppercase"><?php echo $custom_title ? esc_html($custom_title) : single_term_title('', false); ?></h1>
        </div>
    </div>

    <div class="row g-4 justify-content-left">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php
                // Obtiene los términos de la taxonomía 'tecnologia' para el post actual.
                $tecnologia_terms = get_the_terms(get_the_ID(), 'procesos');
                
                if ($tecnologia_terms && !is_wp_error($tecnologia_terms)) {
                    $tecnologia_term = array_shift($tecnologia_terms);
                
                }

                // Obtiene todos los materiales de apoyo de Carbon Fields
                $materiales_apoyo = carbon_get_the_post_meta('crb_material_apoyo');
                $ficha_tecnica_link = '';

                // Bucle para buscar el archivo de la ficha técnica
                if (!empty($materiales_apoyo)) {
                    foreach ($materiales_apoyo as $material) {
                            $ficha_tecnica_link = $material['archivo_material'];                            
                            break;
                        
                    }
                }
                ?>

                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                    <div class="card border-0 h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" class="card-img-top" alt="<?php the_title_attribute(); ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="fs-4 text-uppercase"><?php the_title(); ?></h5>
                            <div class="fs-sm"><?php the_content(); ?></div>
                        </div>
                        <div class="card-footer border-0">
                                
                            <?php if ($ficha_tecnica_link) : ?>
                                <a href="<?php echo esc_url($ficha_tecnica_link); ?>" class="btn w-100 btn-sm btn-krom mt-2" download>
                                     Ficha Técnica <i data-lucide="download"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12 vh-50">
                <p>No se encontraron productos.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

</div>




<div class="mb-20">&nbsp;</div>
<?php get_footer(); ?>