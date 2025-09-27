<?php
function register_cpt_investors() {
    $labels = array(
        'name'               => 'investor',
        'singular_name'      => 'investor',
        'menu_name'          => 'investor',
        'name_admin_bar'     => 'investor',
        'add_new'            => 'Agregar investor',
        'add_new_item'       => 'Agregar nuevo investor',
        'edit_item'          => 'Editar investor',
        'new_item'           => 'Nuevo investor',
        'view_item'          => 'Ver investor',
        'all_items'          => 'Investors',
        'search_items'       => 'Buscar investor',
        'not_found'          => 'No encontrado',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 21,
        'menu_icon'          => 'dashicons-email-alt2',
        'supports'           => array('title'),
        'has_archive'        => false,
        'show_in_rest'       => true,
        'show_in_menu' => 'cpt',
        'menu_position' => null, // 5-100
    );

    register_post_type('investor', $args);
}
add_action('init', 'register_cpt_investors');
