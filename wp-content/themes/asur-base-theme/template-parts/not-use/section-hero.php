<?php
// Si se pasa un hero_id explícito (ej: desde search.php), usarlo
$hero_id = isset($args['hero_id']) ? (int) $args['hero_id'] : null;

// Si no se pasa, intentar obtener desde la página actual
if (!$hero_id) {
    $selected_hero = carbon_get_post_meta(get_the_ID(), 'selected_hero');
    $hero_id = !empty($selected_hero[0]['id']) ? (int) $selected_hero[0]['id'] : null;
}

// Valores por defecto
$default_background_image = 'https://picsum.photos/1200/600';
$default_title = 'Bienvenido a nuestra plataforma';

// Si no hay hero_id, salir silenciosamente o usar fallback
if (!$hero_id) {
    // Opcional: mostrar un hero genérico
    $background_image = $default_background_image;
    $title = $default_title;
    $background_color = '#000000';
    $overlay_opacity = 'opacity-50';
    $background_video = false;
    $is_home = false;
} else {
    $hero_post = get_post($hero_id);
    if (!$hero_post || $hero_post->post_status !== 'publish' || $hero_post->post_type !== 'hero') {
        // Fallback si el hero no es válido
        $background_image = $default_background_image;
        $title = $default_title;
        $background_color = '#000000';
        $overlay_opacity = 'opacity-50';
        $background_video = false;
        $is_home = false;
    } else {
        setup_postdata($hero_post);

        $title = get_the_title($hero_id) ?: $default_title;
        $background_image = carbon_get_post_meta($hero_id, 'hero_background_image') ?: $default_background_image;
        $background_video = carbon_get_post_meta($hero_id, 'hero_background_video');
        $background_color = carbon_get_post_meta($hero_id, 'hero_background_color') ?: '#000000';
        $overlay_opacity = carbon_get_post_meta($hero_id, 'hero_overlay_opacity') ?: 'opacity-50';
        $is_home = (carbon_get_post_meta($hero_id, 'is_home') === 'yes');

        wp_reset_postdata();
    }
}

// Sanitizar
$background_image = esc_url($background_image);
$background_video = $background_video ? esc_url($background_video) : false;
$background_color = sanitize_hex_color($background_color) ?: '#000000';
$overlay_opacity = esc_attr($overlay_opacity);
$hero_class = $is_home ? 'home' : 'inner';
?>

<section class="hero <?= $hero_class; ?>"
    <?php if (!$background_video): ?>
    style="background-image: url('<?= $background_image; ?>')"
    <?php endif; ?>>

    <?php if ($background_video): ?>
        <video autoplay muted loop playsinline class="hero-video">
            <source src="<?= $background_video; ?>" type="video/mp4">
            Tu navegador no soporta video.
        </video>
    <?php endif; ?>

    <div class="hero-overlay <?= $overlay_opacity; ?>"
        style="background-color: <?= $background_color; ?>;"></div>

    <div class="hero-title">
        <div class="row">
            <div class="offset-lg-05 col-md-11 col-12">
                <?php if ($title): ?>
                    <h1 data-aos="fade-up"><?= esc_html($title); ?></h1>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="hero-shape">
        <img src="<?= esc_url(get_template_directory_uri() . '/dist/img/hero-shape.png'); ?>"
            alt="Forma decorativa del hero">
    </div>
</section>

<?php
// Añadir el CSS para el video (solo si se usa)
if ($background_video):
?>
    <style>
        .hero-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
    </style>
<?php endif; ?>