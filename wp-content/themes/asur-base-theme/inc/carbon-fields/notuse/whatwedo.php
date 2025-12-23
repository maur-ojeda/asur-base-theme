<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Contenido - Lo que hacemos')
    ->where('post_type', '=', 'whatwedo')
    ->add_fields([

           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),

        Field::make('textarea', 'whatwedo_description', 'Descripción')
                ->set_required(true),
        
          Field::make('complex', 'whatwedo_numbers', 'Números destacados')            
                ->set_layout('tabbed-vertical')
                ->add_fields([
                    
                    Field::make('text', 'whatwedo_number', 'número destacado')
                        ->set_required(true)
                        ->set_help_text('Texto que se mostrará en grande'),
                    Field::make('text', 'whatwedo_text', 'Texto')
                        ->set_required(true),
                    Field::make('text', 'whatwedo_simbol', 'simbolo')
                        ->set_required(true),
                ]),
    ]);




   