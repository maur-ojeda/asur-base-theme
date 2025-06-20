<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Clientes')
        ->where('post_type', '=', 'client')
        ->add_fields([            
            Field::make('complex', 'clients', 'Lista de Clientes')
                ->set_layout('tabbed-horizontal')
                ->set_duplicate_groups_allowed(true)
                ->add_fields([
                    Field::make('text', 'client_name', 'Nombre del Cliente')
                        ->set_required(true),                        
                    Field::make('text', 'client_text', 'Texto descriptivo')
                        ->set_required(true),
                    Field::make('image', 'client_logo', 'Logo del Cliente')                        
                        ->set_value_type('url'),
                ]),
        ]);

