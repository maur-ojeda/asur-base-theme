<?php
function register_cpt_call_to_action() {
    register_post_type('call-to-action', array(
        'labels' => array(
            'name' => 'call-to-action',
            'singular_name' => '',
            'add_new' => 'Agregar nuevo',
            'add_new_item' => 'Agregar nuevo call to action',
            'edit_item' => 'Editar call to action',
            'new_item' => 'Nuevo call to action',
            'view_item' => 'Ver call to action',
            'all_items' => 'Call to actions',
            'search_items' => 'Buscar call to action',
            'not_found' => 'No se encontraron call to action',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'show_in_menu' => 'cpt',
        15

    ));
}
add_action('init', 'register_cpt_call_to_action');
