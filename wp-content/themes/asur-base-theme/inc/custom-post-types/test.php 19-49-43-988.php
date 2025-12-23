<?php
// Register Custom Post Type for Services
function register_cpt_test()
{
    register_post_type('test', array(
        'labels' => array(
            'name' => 'test',
            'singular_name' => 'test',
            'add_new' => 'Agregar nuevo',
            'add_new_item' => 'Agregar nuevo test',
            'edit_item' => 'Editar test',
            'new_item' => 'Nuevo test',
            'view_item' => 'Ver test',
            'all_items' => 'test',
            'search_items' => 'Buscar nosotrs',
            'not_found' => 'No se encontraron nosotrs',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title', 'editor', 'page-attributes'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_cpt_test');
