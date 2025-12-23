<?php
// CPT: innovation files
add_action('init', function () {
    $labels = [
        'name'               => __('innovation files', 'textdomain'),
        'singular_name'      => __('innovation files', 'textdomain'),
        'menu_name'          => __('innovation files', 'textdomain'),
        'add_new'            => __('Añadir Nuevo', 'textdomain'),
        'add_new_item'       => __('Añadir Nuevo innovation files', 'textdomain'),
        'edit_item'          => __('Editar innovation files', 'textdomain'),
        'new_item'           => __('Nuevo innovation files', 'textdomain'),
        'view_item'          => __('Ver innovation files', 'textdomain'),
        'all_items'          => __('Innovation files', 'textdomain'),
        'search_items'       => __('Buscar innovation files', 'textdomain'),
        'not_found'          => __('No se encontraron innovation files', 'textdomain'),
        'not_found_in_trash' => __('No se encontraron innovation files en la Papelera', 'textdomain'),
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title', 'editor'],
        'menu_icon'     => 'dashicons-grid-view',
        'show_in_menu' => 'cpt',
    ];

    register_post_type('innovation-files', $args);
});
