<?php

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

// Encolar scripts y estilos
require_once get_template_directory() . '/inc/enqueue.php';

// Registrar CPTs personalizados (se cargan automáticamente)
foreach (glob(__DIR__ . '/inc/custom-post-types/*.php') as $cpt_file) {
    require_once $cpt_file;
}
