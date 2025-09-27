<?php
// Register Custom Post Type for Services
function register_cpt_us() {
    register_post_type('us', array(
        'labels' => array(
            'name' => 'Nosotros',
            'singular_name' => 'nosotros',
            'add_new' => 'Agregar nuevo',
            'add_new_item' => 'Agregar nuevo nosotros',
            'edit_item' => 'Editar nosotros',
            'new_item' => 'Nuevo nosotros',
            'view_item' => 'Ver nosotros',
            'all_items' => 'Nosotros',
            'search_items' => 'Buscar nosotrs',
            'not_found' => 'No se encontraron nosotrs',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
        'show_in_menu' => 'cpt',
        'menu_position' => null, // 5-100
    ));
}
add_action('init', 'register_cpt_us');
