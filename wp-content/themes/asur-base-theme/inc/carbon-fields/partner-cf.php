<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de partners')
        ->where('post_type', '=', 'partner')
        ->add_fields([     

           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),


            Field::make('text', 'over_title', 'Sobre título'),

            Field::make('complex', 'partners', 'Lista de partner')
                ->set_layout('tabbed-horizontal')
                ->set_duplicate_groups_allowed(true)
                ->add_fields([
                    Field::make('image', 'client_logo', 'Logo del Cliente')                        
                        ->set_value_type('url'),
                ]),
        ]);

