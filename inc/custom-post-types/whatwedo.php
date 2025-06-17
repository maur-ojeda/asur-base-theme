<?php
function register_cpt_whatwedo() {
    register_post_type('whatwedo', array(
        'labels' => array(
            'name' => 'Lo que hacemos',
            'singular_name' => 'Elemento',
        ),
        'public' => true,
        'has_archive' => false,
        'menu_icon' => 'dashicons-chart-pie',
        'supports' => array('title'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_cpt_whatwedo');
