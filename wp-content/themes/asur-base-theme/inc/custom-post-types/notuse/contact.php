<?php
function register_cpt_contact() {
    $labels = array(
        'name'               => 'Contacto',
        'singular_name'      => 'Contacto',
        'menu_name'          => 'Contacto',
        'name_admin_bar'     => 'Contacto',
        'add_new'            => 'Agregar Contacto',
        'add_new_item'       => 'Agregar nuevo contacto',
        'edit_item'          => 'Editar contacto',
        'new_item'           => 'Nuevo contacto',
        'view_item'          => 'Ver contacto',
        'all_items'          => 'Contactos',
        'search_items'       => 'Buscar contacto',
        'not_found'          => 'No encontrado',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-email-alt2',
        'supports'           => array('title', 'editor'),
        'has_archive'        => false,
        'show_in_rest'       => true,
        'show_in_menu' => 'cpt',
        'menu_position' => null, // 5-100
    );

    register_post_type('contact', $args);
}
add_action('init', 'register_cpt_contact');
