<?php
function asur_register_cpt_partner() {
    $labels = [
        'name' => __('Partners', 'asur-base-theme'),
        'singular_name' => __('Partners', 'asur-base-theme'),
        'add_new' => __('Agregar Nuevo Partners', 'asur-base-theme'),
        'add_new_item' => __('Agregar Nuevo Partners', 'asur-base-theme'),
        'edit_item' => __('Editar Partners', 'asur-base-theme'),
        'new_item' => __('Nuevo Partners', 'asur-base-theme'),
        'view_item' => __('Ver Partners', 'asur-base-theme'),
        'search_items' => __('Buscar Partners', 'asur-base-theme'),
        'not_found' => __('No se encontraron Partners', 'asur-base-theme'),
        'not_found_in_trash' => __('No se encontraron Partners en la papelera', 'asur-base-theme'),
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title'],
        'menu_icon' => 'dashicons-format-image',
        'show_in_menu' => 'cpt',
    
    ];

    register_post_type('partner', $args);
}
add_action('init', 'asur_register_cpt_partner');
