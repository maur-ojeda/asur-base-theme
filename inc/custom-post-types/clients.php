<?php
function register_cpt_client() {
    register_post_type('client', array(
        'labels' => array(
            'name' => 'Clientes',
            'singular_name' => 'Cliente',
            'add_new' => 'Agregar nuevo cliente',
            'add_new_item' => 'Agregar cliente',
            'edit_item' => 'Editar cliente',
            'new_item' => 'Nuevo cliente',
            'view_item' => 'Ver cliente',
            'search_items' => 'Buscar clientes',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'has_archive' => false,
        'rewrite' => false,
        'publicly_queryable' => false,
    ));
}
add_action('init', 'register_cpt_client');
