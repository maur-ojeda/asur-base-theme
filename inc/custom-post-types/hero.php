<?php
function asur_register_cpt_hero() {
    $labels = [
        'name' => __('Heros', 'asur-base-theme'),
        'singular_name' => __('Hero', 'asur-base-theme'),
        'add_new' => __('Agregar Nuevo Hero', 'asur-base-theme'),
        'add_new_item' => __('Agregar Nuevo Hero', 'asur-base-theme'),
        'edit_item' => __('Editar Hero', 'asur-base-theme'),
        'new_item' => __('Nuevo Hero', 'asur-base-theme'),
        'view_item' => __('Ver Hero', 'asur-base-theme'),
        'search_items' => __('Buscar Hero', 'asur-base-theme'),
        'not_found' => __('No se encontraron Heros', 'asur-base-theme'),
        'not_found_in_trash' => __('No se encontraron Heros en la papelera', 'asur-base-theme'),
    ];

    $args = [
        'labels' => $labels,
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => ['title', 'editor', 'thumbnail'],
        'menu_position' => 20,
        'menu_icon' => 'dashicons-format-image',
    ];

    register_post_type('hero', $args);
}
add_action('init', 'asur_register_cpt_hero');
