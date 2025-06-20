<?php
    $client_query = new WP_Query(array('post_type' => 'client','posts_per_page' => -1,));

    if ($client_query->have_posts()) :
        while ($client_query->have_posts()) : $client_query->the_post();
$title = get_the_title();
$content = get_the_content();
$clients = carbon_get_the_post_meta('clients');           
    ?>

<section id="clients" class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4 text-center">
            <div class="col">
                <h2 class="section-title"><?= esc_html($title); ?></h2>
                <p class="section-subtitle"><?= esc_html($content); ?></p>
            </div
        </div>

        <div class="row justify-content-center g-4">   
            <?php
            if ($clients):
                foreach ($clients as $client):
                    $clientName = esc_html($client['client_name']);
                    $clientText = esc_html($client['client_text']);
                    $clientLogo = esc_url($client['client_logo']);
             ?>   
        
        
        <div class="col col-md-4 col-lg-3 text-center">
            <div class="card">
        <h2><?= esc_html($clientName); ?></h2>
            <p><?= esc_html($clientText); ?></p>
                    <?php if ($clientLogo): ?>
                            <img src="<?php echo esc_url($clientLogo); ?>" class="img-fluid grayscale" alt="Logo cliente">                                            
                    <?php endif; ?>
</div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        
        
        <?php endwhile;
                wp_reset_postdata();
            else:
                echo '<p class="text-center">Aún no hay logos cargados.</p>';
            endif;
            ?>
        </div>
    </div>
</section>
