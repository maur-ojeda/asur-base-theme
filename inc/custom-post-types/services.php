<?php
// Register Custom Post Type for Services
function register_cpt_service() {
    register_post_type('service', array(
        'labels' => array(
            'name' => 'Servicios',
            'singular_name' => 'Servicio',
            'add_new' => 'Agregar nuevo',
            'add_new_item' => 'Agregar nuevo servicio',
            'edit_item' => 'Editar servicio',
            'new_item' => 'Nuevo servicio',
            'view_item' => 'Ver servicio',
            'all_items' => 'Todos los servicios',
            'search_items' => 'Buscar servicios',
            'not_found' => 'No se encontraron servicios',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-hammer',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_cpt_service');
