<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Servicio')
        ->where('post_type', '=', 'service')
        ->add_fields([

           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),

            Field::make('select', 'service_layout', 'Disposición de la sección')
                ->set_options([
                    'left' => 'Detalles + Galería',
                    'right' => 'Galería + Detalles'
                ])
                ->set_default_value('left')
                ->set_help_text('Elige si quieres que los detalles aparezcan a la izquierda o a la derecha'),

Field::make('select', 'service_margin_bottom', 'Margen inferior')
    ->set_options([
        'mb-0' => 'Sin margen',
        'mb-3' => 'Pequeño (1rem)',
        'mb-4' => 'Mediano (1.5rem)',
        'mb-5' => 'Grande (3rem)',
    ])
    ->set_default_value('mb-5')
    ->set_help_text('Espacio debajo de este servicio'),

            Field::make('text', 'service_title', 'Título')
                ->set_required(true),
                
            Field::make('textarea', 'service_description', 'Descripción')
                ->set_required(true),

            Field::make('text', 'service_shortcode', 'Galería (Shortcode)')
                ->set_help_text('Pega aquí el shortcode de la galería'),

            Field::make('complex', 'service_features', 'Características')
                ->set_layout('tabbed-horizontal')
                ->set_duplicate_groups_allowed(true)
                ->add_fields([
                    Field::make('text', 'feature_icon', 'Ícono Lucide')
                        ->set_required(true)
                        ->set_help_text('Nombre del ícono Lucide, sin el prefijo (ej: chef-hat)'),
                    Field::make('text', 'feature_text', 'Texto')
                        ->set_required(true),
                    Field::make('textarea', 'feature_description', 'Descripción'),
                ]),
        ]);

