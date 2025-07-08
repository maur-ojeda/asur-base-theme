<?php
    $client_query = new WP_Query(array('post_type' => 'client','posts_per_page' => -1,));

    if ($client_query->have_posts()) :
        while ($client_query->have_posts()) : $client_query->the_post();
            $title = get_the_title();
            $desc = get_the_content();
            $clients = carbon_get_the_post_meta('clients');           
            $is_visible = carbon_get_the_post_meta('is_visible');           
            
    ?>

<?php if ($is_visible) : ?>

    <pre class="theme-indicator">WIP :clients</pre> 
<section id="clients">
    <div class="container">

       <div class="intro-section" data-aos="fade" data-aos-delay="200">
                <h1><?= esc_html($title); ?></h1>
                <p><?= esc_html(strip_tags($desc)); ?></p>
        </div>

        <div class="row justify-content-center g-4">   
            <?php
            if ($clients):
                foreach ($clients as $client):
                    $clientName = esc_html($client['client_name']);
                    $clientText = esc_html($client['client_text']);
                    $clientLogo = esc_url($client['client_logo']);
             ?>   
        
        
            <div class="client-item" data-aos="fade-left" data-aos-delay="200">
                <div>
                        <?php if ($clientLogo): ?>
                            <img src="<?php echo ensure_https($clientLogo); ?>" alt="Logo cliente">
                        <?php endif; ?>    
                        <?php if ($clientName): ?>
                                <h4><?= esc_html($clientName); ?></h4>
                        <?php endif; ?>
                        <?php if ($clientText): ?>
                            <p><?= esc_html($clientText); ?></p>                        
                        <?php endif; ?>                
                    </div>
            </div>

        <?php endforeach; ?>
  
        
        
        </div>
    </div>
</section>

<?php endif; ?>

<?php endif; ?>
        <?php endwhile;
                wp_reset_postdata();
            else:
                echo '<p class="text-center">Aún no hay logos cargados.</p>';
            endif;
            ?>