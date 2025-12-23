<?php
// CPT: Category Showcase
add_action('init', function () {
    $labels = [
        'name'               => __('Category Showcase', 'textdomain'),
        'singular_name'      => __('Category Showcase', 'textdomain'),
        'menu_name'          => __('Category Showcases', 'textdomain'),
        'add_new'            => __('Añadir Nuevo', 'textdomain'),
        'add_new_item'       => __('Añadir Nuevo Category Showcase', 'textdomain'),
        'edit_item'          => __('Editar Category Showcase', 'textdomain'),
        'new_item'           => __('Nuevo Category Showcase', 'textdomain'),
        'view_item'          => __('Ver Category Showcase', 'textdomain'),
        'all_items'          => __('Todos los Category Showcases', 'textdomain'),
        'search_items'       => __('Buscar Category Showcases', 'textdomain'),
        'not_found'          => __('No se encontraron Category Showcases', 'textdomain'),
        'not_found_in_trash' => __('No se encontraron Category Showcases en la Papelera', 'textdomain'),
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title'],
        'menu_icon'     => 'dashicons-grid-view',
        'show_in_menu' => 'cpt',
    ];

    register_post_type('category-showcase', $args);
});