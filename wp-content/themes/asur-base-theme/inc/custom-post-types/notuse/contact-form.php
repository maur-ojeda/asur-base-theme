<?php

function register_cpt_contact_form()
{
    $labels = array(
        'name'                  => 'Formularios de Contacto',
        'singular_name'         => 'Formulario de Contacto',
        'menu_name'             => 'Formularios',
        'name_admin_bar'        => 'Formulario',
        'add_new'               => 'Agregar nuevo',
        'add_new_item'          => 'Agregar nuevo Formulario',
        'edit_item'             => 'Editar Formulario',
        'new_item'              => 'Nuevo Formulario',
        'view_item'             => 'Ver Formulario',
        'all_items'             => 'Todos los Formularios',
        'search_items'          => 'Buscar Formularios',
        'not_found'             => 'No se encontraron Formularios',
        'not_found_in_trash'    => 'No hay Formularios en la papelera',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false, // No se necesita frontend directo
        'show_ui'            => true,  // Mostrar en el admin
        'show_in_menu'       => 'cpt', // Acomodarlo en el menú "CPT"
        'menu_icon'          => 'dashicons-email-alt2',
        'supports'           => array('title'), // Solo título por ahora
        'has_archive'        => false,
        'show_in_rest'       => false, // No necesario en REST por ahora
        'capability_type'    => 'post',
    );

    register_post_type('contact_form', $args);
}
add_action('init', 'register_cpt_contact_form');
