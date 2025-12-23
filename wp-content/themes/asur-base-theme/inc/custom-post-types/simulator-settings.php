<?php
// Register Custom Post Type for Services
function register_cpt_simulator_settings()
{
    register_post_type('simulator_settings', array(
        'labels' => array(
            'name' => 'Opciones del simulador',
            'singular_name' => 'simulator-settings',
            'add_new' => 'Agregar simulador',
            'add_new_item' => 'Agregar nuevo simulador',
            'edit_item' => 'Editar simulador',
            'new_item' => 'Nuevo simulador',
            'view_item' => 'Ver simulador',
            'all_items' => 'Simuladores',
            'search_items' => 'Buscar simulador',
            'not_found' => 'No se encontraron simulador',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-groups',
        'supports' => array('title'),
        'show_in_rest' => true,
        'show_in_menu' => 'cpt',
        'menu_position' => null, // 5-100
    ));
}
add_action('init', 'register_cpt_simulator_settings');
