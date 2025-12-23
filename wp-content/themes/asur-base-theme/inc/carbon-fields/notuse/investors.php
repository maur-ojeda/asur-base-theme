<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Nosotros')
        ->where('post_type', '=', 'investor')
        ->add_fields([

            Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),

            Field::make('complex', 'investors-types', 'Tipos de inversores')
                ->set_layout('tabbed-horizontal')
                ->set_duplicate_groups_allowed(true)
                ->add_fields([
                    Field::make('text', 'title', 'Título del tipo de inversor'),                                            
                    Field::make('textarea', 'text', 'Texto descriptivo del tipo de inversor'),                        
                    Field::make('image', 'image', 'Imagen del tipo de inversor')                        
                        ->set_value_type('url'),
                ]),

        ]);

