<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Servicio')
        ->where('post_type', '=', 'service')
        ->add_fields([
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
                ]),
        ]);

