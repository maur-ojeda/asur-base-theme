<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Contenido - Lo que hacemos')
    ->where('post_type', '=', 'whatwedo')
    ->add_fields([
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
                ]),
    ]);




   