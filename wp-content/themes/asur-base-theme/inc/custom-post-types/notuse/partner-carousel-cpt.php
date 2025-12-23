<?php
// CPT: partner carousel
add_action('init', function () {
    $labels = [
        'name'               => __('partner carousel', 'textdomain'),
        'singular_name'      => __('partner carousel', 'textdomain'),
        'menu_name'          => __('partner carousel', 'textdomain'),
        'add_new'            => __('Añadir Nuevo', 'textdomain'),
        'add_new_item'       => __('Añadir Nuevo partner carousel', 'textdomain'),
        'edit_item'          => __('Editar partner carousel', 'textdomain'),
        'new_item'           => __('Nuevo partner carousel', 'textdomain'),
        'view_item'          => __('Ver partner carousel', 'textdomain'),
        'all_items'          => __('Todos los partner carousel', 'textdomain'),
        'search_items'       => __('Buscar partner carousel', 'textdomain'),
        'not_found'          => __('No se encontraron partner carousel', 'textdomain'),
        'not_found_in_trash' => __('No se encontraron partner carousel en la Papelera', 'textdomain'),
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

    register_post_type('partner-carousel', $args);
});
