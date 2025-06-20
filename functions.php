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

    register_nav_menus([
        'main_menu' => __('Main Menu', 'asur-base-theme')
    ]);
}
add_action('after_setup_theme', 'asur_theme_setup');


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

