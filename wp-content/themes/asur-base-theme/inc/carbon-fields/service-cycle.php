<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Nosotros')
        ->where('post_type', '=', 'service-cycle')
        ->add_fields([
            Field::make('checkbox', 'service-cycles-direction', 'orientación izq - der')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
            
            Field::make('complex', 'service-cycles', 'service-cycle')
                ->set_layout('tabbed-horizontal')
                ->set_duplicate_groups_allowed(true)
                ->add_fields([
                    Field::make('text', 'over-title', 'Sobre título'),                                            
                    Field::make('text', 'title', 'Título'),                                            
                    Field::make('textarea', 'text', 'Texto'),                        
                    Field::make('image', 'image', 'Imagen')                        
                        ->set_value_type('url'),
                ]),

        ]);

