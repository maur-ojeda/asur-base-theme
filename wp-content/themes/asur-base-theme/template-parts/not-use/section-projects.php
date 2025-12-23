<?php
$query = new WP_Query([
    'post_type' => 'project',
    'posts_per_page' => 6,
]);

$is_visible = carbon_get_theme_option('projects_section_is_visible');

if ($is_visible) : 
    if ($query->have_posts()) : 
    ?>
        <section id="projects">    
            <div class="container">
                <div class="row mb-4">
                    <div class="offset-md-2 col-md-8 text-center">
                        <h6 class="text-primary fw-semibold" data-aos="fade" data-aos-delay="800">
                            <?= esc_html(carbon_get_theme_option('projects_section_tag')); ?>
                        </h6>
                        <h3 class="display-6" data-aos="fade-up" data-aos-delay="400">
                            <?= esc_html(carbon_get_theme_option('projects_section_title')); ?>
                        </h3>
                        <p class="text-muted" data-aos="fade-up" data-aos-delay="600">
                            <?= esc_html(carbon_get_theme_option('projects_section_description')); ?>
                        </p>
                    </div>
                </div>
                <div class="row">
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="col-md-4 mb-4">                    
                        <div class="project">
                            <a class="project-wrapper" href="<?php the_permalink(); ?>">                                                                
                                <div class="project-image-container">                                                
                                    <?php if (has_post_thumbnail()) : ?>                              
                                                <?php the_post_thumbnail('full', ['class' => 'project-image']); ?>                              
                                    <?php endif; ?>                        
                                </div> 
                                <div class="project-info">
                                    <h4><?php the_title(); ?></h4>
                                    <p class="text-muted fs-xs mt-2"   >
                                        <?= esc_html(carbon_get_the_post_meta('descripcion_corta')); ?>
                                    </p>                                
                                </div>   
                            </a>                
                        </div>    
                        </div>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>



