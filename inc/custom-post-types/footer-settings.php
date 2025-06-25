<?php
/**
 * Registers the Footer Settings Custom Post Type.
 *
 * @package asur-base-theme
 */

function asur_register_footer_settings_cpt() {
    $labels = array(
        'name'                  => _x( 'Ajustes de Footer', 'Post type general name', 'asur-base-theme' ),
        'singular_name'         => _x( 'Ajuste de Footer', 'Post type singular name', 'asur-base-theme' ),
        'menu_name'             => _x( 'Ajustes de Footer', 'Admin Menu text', 'asur-base-theme' ),
        'add_new_item'          => __( 'Añadir Nuevo Ajuste', 'asur-base-theme' ),
        'edit_item'             => __( 'Editar Ajuste', 'asur-base-theme' ),
        'all_items'             => __( 'Todos los Ajustes', 'asur-base-theme' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_icon'          => 'dashicons-admin-settings',
        'supports'           => array( 'title' ),
    );

    register_post_type( 'footer_settings', $args );
}
add_action( 'init', 'asur_register_footer_settings_cpt' );