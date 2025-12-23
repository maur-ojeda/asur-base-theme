<?php
// wp-content/themes/asur-base-theme/inc/custom-post-types/simulation-submission.php

function register_cpt_simulation_submission()
{
    register_post_type('simulation_sub', [
        'label' => 'Simulaciones recibidas',
        'labels' => [
            'name' => 'Simulaciones',
            'singular_name' => 'Simulación',
            'add_new' => 'Agregar Nueva',
            'add_new_item' => 'Agregar Nueva Simulación',
            'edit_item' => 'Editar Simulación',
            'new_item' => 'Nueva Simulación',
            'view_item' => 'Ver Simulación',
            'search_items' => 'Buscar Simulaciones',
            'not_found' => 'No se encontraron simulaciones.',
            'menu_name' => 'Simulaciones',
        ],
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-chart-line',
        'show_in_rest' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'rewrite' => false,
        'query_var' => false,
    ]);
}
add_action('init', 'register_cpt_simulation_submission');
