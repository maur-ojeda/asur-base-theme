<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de partners')
        ->where('post_type', '=', 'partner-carousel')
        ->add_fields([
                Field::make('text', 'over-title', 'sobre título '),
                Field::make('text', 'title', 'Título '),                    
                Field::make('complex', 'partners', 'Lista de partner')
                    ->set_layout('tabbed-horizontal')                    
                    ->add_fields([
                        Field::make('image', 'client_logo', 'Logo del Cliente')                        
                            ->set_value_type('url'),
                    ]),
        ]);

