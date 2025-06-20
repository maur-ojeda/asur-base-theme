<?php
function register_cpt_testimonial() {
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => 'Testimonios',
            'singular_name' => 'Testimonio',
            'add_new' => 'Agregar nuevo',
            'add_new_item' => 'Nuevo testimonio',
            'edit_item' => 'Editar testimonio',
            'new_item' => 'Nuevo testimonio',
            'view_item' => 'Ver testimonio',
        ),
        'public' => true,
        'menu_icon' => 'dashicons-format-quote',
        'supports' => array('title', 'editor'),
        'show_in_rest' => true,
        'has_archive' => false,
        'rewrite' => false,
        'publicly_queryable' => false,
    ));
}
add_action('init', 'register_cpt_testimonial');
