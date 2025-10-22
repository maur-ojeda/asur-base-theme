<?php
function asur_register_cpt_presence()
{
    $labels = [
        'name' => __('presence', 'asur-base-theme'),
        'singular_name' => __('presence', 'asur-base-theme'),
        'add_new' => __('Agregar Nuevo presence', 'asur-base-theme'),
        'add_new_item' => __('Agregar Nuevo presence', 'asur-base-theme'),
        'edit_item' => __('Editar presence', 'asur-base-theme'),
        'new_item' => __('Nuevo presence', 'asur-base-theme'),
        'view_item' => __('Ver presence', 'asur-base-theme'),
        'search_items' => __('Buscar presence', 'asur-base-theme'),
        'not_found' => __('No se encontraron presence', 'asur-base-theme'),
        'not_found_in_trash' => __('No se encontraron presence en la papelera', 'asur-base-theme'),
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

    register_post_type('presence', $args);
}
add_action('init', 'asur_register_cpt_presence');
