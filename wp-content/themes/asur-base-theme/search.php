<?php get_header(); ?>
<?php



$search_hero = carbon_get_theme_option('search_hero');
$hero_id = !empty($search_hero[0]['id']) ? (int) $search_hero[0]['id'] : null;


get_template_part('template-parts/section', 'hero', ['hero_id' => $hero_id]);
?>

<div class="container-krom py-5 mb-20 mt-20">
    <div class="row">
        <div class="col-12">
            <h6 class="over-title">
                Resultados de la búsqueda para:
                <span class="text-muted">"<?php echo esc_html(get_search_query()); ?>"</span>
            </h6>

            <?php if (have_posts()) : ?>
                <div class="row g-4">
                    <?php while (have_posts()) : the_post(); ?>


                        <?php
                        // Obtener los términos de la taxonomía 'procesos' asignados al post
                        $terms = get_the_terms(get_the_ID(), 'procesos');

                        // Si hay términos, usar el primero (o el que prefieras)
                        if (!empty($terms) && !is_wp_error($terms)) {
                            $first_term = reset($terms); // toma el primer término
                            $link = get_term_link($first_term);
                            $link_text = 'Ver más en ' . $first_term->name;
                        } else {
                            // Fallback: si no hay taxonomía, usar home o # (opcional)
                            $link = home_url();
                            $link_text = 'Ver más';
                        }
                        ?>

                        <div class="col-12 mb-10">
                            <article class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h2 class="title text-dark" data-aos="fade-up" data-aos-delay="400">
                                        <a href="<?php echo esc_url($link); ?>" class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    <p class="card-text text-muted">
                                        <?php
                                        if (has_excerpt()) {
                                            the_excerpt();
                                        } else {
                                            echo wp_trim_words(get_the_content(), 30, '...');
                                        }
                                        ?>
                                    </p>



                                    <a href="<?php echo esc_url($link); ?>" class="btn btn-krom">
                                        <?php echo esc_html($link_text); ?> <i data-lucide="arrow-right"></i>
                                    </a>


                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <small class="text-muted d-none">
                                        Publicado el <?php echo get_the_date(); ?>
                                        <?php if (get_the_category_list()) : ?>
                                            en <?php the_category(', '); ?>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Paginación -->
                <div class="mt-5">
                    <?php
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '&laquo; Anterior',
                        'next_text' => 'Siguiente &raquo;',
                    ));
                    ?>
                </div>

            <?php else : ?>

                <div class="card shadow">
                    <h5 class="card-header">No se encontraron resultados para tu búsqueda.</h5>
                    <div class="card-body">

                        <p class="card-text">
                            Intenta con otras palabras clave o usa el menú para navegar por el sitio.
                        </p>
                    </div>
                </div>
                <!-- Formulario de búsqueda nuevamente -->
                <div class="mt-4 mb-20">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>