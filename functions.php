<?php

// Habilitar funcionalidades básicas
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('menus');

// Encolar scripts y estilos
require_once get_template_directory() . '/inc/enqueue.php';

// Registrar CPTs personalizados
foreach (glob(__DIR__ . '/inc/custom-post-types/*.php') as $cpt_file) {
    require_once $cpt_file;
}

register_nav_menus([
    'main_menu' => __('Main Menu', 'your-theme')
  ]);
  