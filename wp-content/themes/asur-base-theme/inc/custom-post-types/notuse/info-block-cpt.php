<?php
function asur_register_cpt_info_block() {
    $labels = [
        'name' => __('info-block', 'asur-base-theme'),
        'singular_name' => __('info-block', 'asur-base-theme'),
        'add_new' => __('Agregar Nuevo info-block', 'asur-base-theme'),
        'add_new_item' => __('Agregar Nuevo info-block', 'asur-base-theme'),
        'edit_item' => __('Editar info-block', 'asur-base-theme'),
        'new_item' => __('Nuevo info-block', 'asur-base-theme'),
        'view_item' => __('Ver info-block', 'asur-base-theme'),
        'search_items' => __('Buscar info-block', 'asur-base-theme'),
        'not_found' => __('No se encontraron info-block', 'asur-base-theme'),
        'not_found_in_trash' => __('No se encontraron info-block en la papelera', 'asur-base-theme'),
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_icon' => 'dashicons-format-image',
        'show_in_menu' => 'cpt',
    
    ];

    register_post_type('info-block', $args);
}
add_action('init', 'asur_register_cpt_info_block');
