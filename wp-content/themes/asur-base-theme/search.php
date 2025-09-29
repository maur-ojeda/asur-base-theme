<?php get_header(); ?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">
                Resultados de la búsqueda para: 
                <span class="text-primary">"<?php echo esc_html( get_search_query() ); ?>"</span>
            </h1>

            <?php if ( have_posts() ) : ?>
                <div class="row g-4">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col-12">
                            <article class="card border-0 shadow-sm h-100">
                                <div class="card-body">
                                    <h2 class="h4 card-title">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                    <p class="card-text text-muted">
                                        <?php 
                                        if ( has_excerpt() ) {
                                            the_excerpt();
                                        } else {
                                            echo wp_trim_words( get_the_content(), 30, '...' );
                                        }
                                        ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                        Leer más
                                    </a>
                                </div>
                                <div class="card-footer bg-transparent border-0 pt-0">
                                    <small class="text-muted">
                                        Publicado el <?php echo get_the_date(); ?>
                                        <?php if ( get_the_category_list() ) : ?>
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
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '&laquo; Anterior',
                        'next_text' => 'Siguiente &raquo;',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <div class="alert alert-info" role="alert">
                    <p>No se encontraron resultados para tu búsqueda.</p>
                    <p>Intenta con otras palabras clave o usa el menú para navegar por el sitio.</p>
                </div>

                <!-- Formulario de búsqueda nuevamente -->
                <div class="mt-4">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>