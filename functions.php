<?php
require_once get_template_directory() . '/inc/class-bootstrap-navwalker.php';
use Carbon_Fields\Carbon_Fields;

// Cargar Carbon Fields
$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
    Carbon_Fields::boot();
}

// Activar características del theme
function asur_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('custom-logo');

    register_nav_menus([
        'main_menu' => __('Main Menu', 'asur-base-theme')
    ]);
}
add_action('after_setup_theme', 'asur_theme_setup');

// Añadir opción para logo blanco en el personalizador
function asur_customize_register( $wp_customize ) {
    // Setting for white logo
    $wp_customize->add_setting( 'white_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ) );

    // Control for white logo
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'white_logo_control', array(
        'label'       => __( 'Logo Blanco (para header transparente)', 'asur-base-theme' ),
        'description' => __( 'Sube una versión en blanco del logo para mostrar cuando el encabezado es transparente.', 'asur-base-theme' ),
        'section'     => 'title_tagline', // Se agrega a la sección "Identidad del Sitio"
        'settings'    => 'white_logo',
        'priority'    => 8, // Justo después del logo estándar
    ) ) );
}
add_action( 'customize_register', 'asur_customize_register' );

add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
    // Solo usar el editor clásico en CPTs personalizados
    $core_post_types = ['post', 'page', 'attachment', 'revision', 'nav_menu_item'];

    if (!in_array($post_type, $core_post_types)) {
        return false; // Forzar editor clásico
    }

    return $use_block_editor;
}, 10, 2);



// Encolar scripts y estilos
require_once get_template_directory() . '/inc/enqueue.php';

// Registrar CPTs personalizados (se cargan automáticamente)
foreach (glob(__DIR__ . '/inc/custom-post-types/*.php') as $cpt_file) {
    require_once $cpt_file;
}

// Registrar campos de Carbon Fields
add_action('carbon_fields_register_fields', function () {
    foreach (glob(__DIR__ . '/inc/carbon-fields/*.php') as $carbon_fields) {
        require_once $carbon_fields;
    }
});

function ensure_https($url) {
    return esc_url(set_url_scheme($url, 'https'));
}