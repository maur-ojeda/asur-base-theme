<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Contenido contacto')
        ->where('post_type', '=', 'contact')
        ->add_fields([    
                    
           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
            Field::make('text', 'contact_shortcode', 'Shortcode de formulario de contacto')
                ->set_help_text('Pega aquí el shortcode del plugin de contacto.'),
            Field::make('complex', 'contact_items', 'Formas de contacto')
                ->set_layout('tabbed-horizontal')
                ->set_duplicate_groups_allowed(true)
                ->add_fields([
                    Field::make('text', 'contact_icon', 'Ícono Lucide')
                        ->set_required(true)
                        ->set_help_text('Nombre del ícono Lucide, sin el prefijo (ej: chef-hat)'),
                    Field::make('text', 'contact_title', 'Titulo')
                        ->set_required(true),
                        Field::make('text', 'contact_text', 'Texto')
                        ->set_required(true),
                          Field::make('text', 'contact_url', 'Enlace')
                        ->set_required(true),
                ]),
        ]);

