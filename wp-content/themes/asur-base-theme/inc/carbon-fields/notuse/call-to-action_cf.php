<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Call to action')
        ->where('post_type', '=', 'call-to-action')
        ->add_fields([

           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
            
            Field::make('text', 'cta_link_text', 'Texto de enlace')                
                ->set_width(50),
            Field::make('text', 'cta_link', 'Enlace url')
                ->set_attribute('type', 'url')
                ->set_help_text('Debe ser una URL válida')
                ->set_width(50)
            
        ]);


    Container::make('post_meta', 'call to action asociados')
            ->where('post_type', '=', 'page')
            ->add_fields([
            Field::make('association', 'selected_call_to_action', 'Seleccionar')
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'call-to-action'
                    ]
                ])
            ->set_duplicates_allowed( false )
            ->set_help_text('Selecciona los call to action  que se mostrarán en esta página.')
        ]);
