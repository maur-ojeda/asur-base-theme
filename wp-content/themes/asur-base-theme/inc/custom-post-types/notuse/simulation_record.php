<?php
function create_simulation_record_cpt()
{
    register_post_type(
        'simulation_record',
        [
            'labels'      => [
                'name'          => __('Registros de Simulación 0000', 'textdomain'),
                'singular_name' => __('Registro de Simulación', 'textdomain'),
            ],
            'public'      => false, // Generalmente oculto al público
            'show_ui'     => true,  // Visible en el panel de administración
            'has_archive' => false,
            'supports'    => ['title', 'custom-fields'],
        ]
    );
}
add_action('init', 'create_simulation_record_cpt');
