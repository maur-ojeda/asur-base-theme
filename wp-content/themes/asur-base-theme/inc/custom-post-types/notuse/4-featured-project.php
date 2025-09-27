<?php
function register_cpt_featured_projects() {
    $labels = array(
        'name'               => 'featured_project',
        'singular_name'      => 'featured_project',
        'menu_name'          => 'featured_project',
        'name_admin_bar'     => 'featured_project',
        'add_new'            => 'Agregar featured_project',
        'add_new_item'       => 'Agregar nuevo featured_project',
        'edit_item'          => 'Editar featured_project',
        'new_item'           => 'Nuevo featured_project',
        'view_item'          => 'Ver featured_project',
        'all_items'          => 'featured_projects',
        'search_items'       => 'Buscar featured_project',
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

    register_post_type('featured_project', $args);
}
add_action('init', 'register_cpt_featured_projects');
