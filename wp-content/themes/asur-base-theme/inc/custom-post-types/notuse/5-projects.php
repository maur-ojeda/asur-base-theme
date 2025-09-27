<?php
function register_cpt_projects() {
    $labels = array(
        'name'               => 'projects',
        'singular_name'      => 'project',
        'menu_name'          => 'projects',
        'name_admin_bar'     => 'projects',
        'add_new'            => 'Agregar projects',
        'add_new_item'       => 'Agregar nuevo projects',
        'edit_item'          => 'Editar projects',
        'new_item'           => 'Nuevo projects',
        'view_item'          => 'Ver projects',
        'all_items'          => 'Proyects',
        'search_items'       => 'Buscar projects',
        'not_found'          => 'No encontrado',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 21,
        'rewrite' => ['slug' => 'project'],
        'has_archive' => true,
        'menu_icon'          => 'dashicons-portfolio',
        'supports' => ['title', 'thumbnail', 'editor', 'excerpt'],
        'has_archive'        => false,
        'show_in_rest'       => true,
        'show_in_menu' => 'cpt',
    );

    register_post_type('project', $args);
}
add_action('init', 'register_cpt_projects');
