<?php
// CPT: Innovacion
add_action('init', function () {
    $labels = [
        'name'               => __('Innovaciones', 'asur-base-theme'),
        'singular_name'      => __('Innovación', 'asur-base-theme'),
        'menu_name'          => __('Innovaciones', 'asur-base-theme'),
        'name_admin_bar'     => __('Innovacion', 'asur-base-theme'),
        'add_new'            => __('Añadir nuevo', 'asur-base-theme'),
        'add_new_item'       => __('Añadir nueva innovación', 'asur-base-theme'),
        'new_item'           => __('Nueva innovación', 'asur-base-theme'),
        'edit_item'          => __('Editar innovación', 'asur-base-theme'),
        'view_item'          => __('Ver innovación', 'asur-base-theme'),
        'all_items'          => __('Innovaciones', 'asur-base-theme'),
        'search_items'       => __('Buscar innovación', 'asur-base-theme'),
        'not_found'          => __('No se encontraron innovación', 'asur-base-theme'),
        'not_found_in_trash' => __('No se encontraron innovación en la papelera', 'asur-base-theme'),
    ];

    register_post_type('innovacion', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'innovacion'],
        'menu_icon'          => 'dashicons-lightbulb',
        'supports'           => ['title','editor', 'thumbnail'],
        'show_in_rest'       => true,
        'show_in_menu'       => 'menu-taxonomias',
        'show_in_nav_menus' => true, 
    ]);
});



  