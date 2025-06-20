<?php
function register_cpt_product() {
    register_post_type('product', array(
        'labels' => array(
            'name' => 'Productos',
            'singular_name' => 'Producto',
            'add_new' => 'Agregar nuevo',
            'add_new_item' => 'Agregar nuevo producto',
            'edit_item' => 'Editar producto',
            'new_item' => 'Nuevo producto',
            'view_item' => 'Ver producto',
            'search_items' => 'Buscar productos',
            'not_found' => 'No se encontraron productos.',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-cart',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
        'has_archive' => false,
        'rewrite' => false,
        'publicly_queryable' => false,
    ));
}
add_action('init', 'register_cpt_product');
