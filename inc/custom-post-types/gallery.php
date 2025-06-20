<?php
function register_cpt_gallery() {
    register_post_type('gallery', array(
        'labels' => array(
            'name' => 'Galería',
            'singular_name' => 'Imagen de Galería',
            'add_new' => 'Agregar nueva',
            'add_new_item' => 'Agregar imagen',
            'edit_item' => 'Editar imagen',
            'new_item' => 'Nueva imagen',
            'view_item' => 'Ver imagen',
            'search_items' => 'Buscar imágenes',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array('title', 'editor'), // Solo título y editor
        'show_in_rest' => true,
        'has_archive' => false,
        'rewrite' => false,
        'publicly_queryable' => false,
    ));
}
add_action('init', 'register_cpt_gallery');
