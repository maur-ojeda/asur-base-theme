<?php
// CPT: Producto
add_action('init', function () {
    $labels = [
        'name'               => __('Productos', 'asur-base-theme'),
        'singular_name'      => __('Producto', 'asur-base-theme'),
        'menu_name'          => __('Productos', 'asur-base-theme'),
        'name_admin_bar'     => __('Producto', 'asur-base-theme'),
        'add_new'            => __('Añadir nuevo', 'asur-base-theme'),
        'add_new_item'       => __('Añadir nuevo producto', 'asur-base-theme'),
        'new_item'           => __('Nuevo producto', 'asur-base-theme'),
        'edit_item'          => __('Editar producto', 'asur-base-theme'),
        'view_item'          => __('Ver producto', 'asur-base-theme'),
        'all_items'          => __('Productos', 'asur-base-theme'),
        'search_items'       => __('Buscar productos', 'asur-base-theme'),
        'not_found'          => __('No se encontraron productos', 'asur-base-theme'),
        'not_found_in_trash' => __('No se encontraron productos en la papelera', 'asur-base-theme'),
    ];

    register_post_type('producto', [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => ['slug' => 'productos'],
        'menu_icon'          => 'dashicons-cart',
        'supports'           => ['title', 'editor', 'thumbnail'],
        'show_in_rest'       => true,
        'show_in_menu'       => 'menu-taxonomias',

        'taxonomies'         => ['industria', 'procesos'],
    ]);
});