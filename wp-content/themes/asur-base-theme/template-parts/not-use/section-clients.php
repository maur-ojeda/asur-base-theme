<?php
$client_query = new WP_Query([
    'post_type'      => 'client',
    'posts_per_page' => -1,
]);


$default_title = 'Nuestros Clientes';
$default_desc = 'Estas son algunas de las empresas que confían en nosotros.';
$default_logo = '';
$default_client_name = 'Empresa Anónima';
$default_client_text = 'Descripción no disponible.';

if ($client_query->have_posts()) :
    while ($client_query->have_posts()) : $client_query->the_post();

        $title = get_the_title() ?: $default_title;
        $desc = get_the_content() ?: $default_desc;
        $clients = carbon_get_the_post_meta('clients') ?: [];
        $is_visible = carbon_get_the_post_meta('is_visible');

        if (!$is_visible) continue;
        ?>

        <section id="clients" class="py-5 bg-light">
            <div class="container">
                <div class="intro-section text-center mb-5" data-aos="fade" data-aos-delay="200">
                    <h1><?= esc_html($title); ?></h1>
                    <p class="lead"><?= esc_html(strip_tags($desc)); ?></p>
                </div>

                <div class="row justify-content-center g-4">
                    <?php foreach ($clients as $client):
                        $client_name = !empty($client['client_name']) ? esc_html($client['client_name']) : $default_client_name;
                        $client_text = !empty($client['client_text']) ? esc_html($client['client_text']) : $default_client_text;
                        $client_logo = !empty($client['client_logo']) ? esc_url($client['client_logo']) : $default_logo;
                    ?>
                        <div class="col-md-4 col-sm-6 client-item text-center" data-aos="fade-up" data-aos-delay="200">
                            <div class="p-4 bg-white shadow-sm h-100 rounded">
                                <img src="<?= ensure_https($client_logo); ?>" alt="Logo de <?= esc_attr($client_name); ?>" class="img-fluid mb-3" style="max-height: 100px;">
                                <h4><?= $client_name; ?></h4>
                                <p class="small text-muted"><?= $client_text; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

    <?php endwhile;
    wp_reset_postdata();
else: ?>
    <p class="text-center my-5">Aún no hay clientes cargados.</p>
<?php endif; ?>
