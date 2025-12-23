<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Nosotros')
        ->where('post_type', '=', 'featured_project')
        ->add_fields([

           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes'),
           
            Field::make('text', 'fp_over_title', 'Sobre título'),                                            
            Field::make('text', 'fp_link_text', 'texto botón'),
            Field::make('text', 'fp_link', 'link botón'),
            Field::make('textarea', 'fp_info', 'Texto descriptivo del proyecto'),
            Field::make('image', 'fp_image', 'Imagen del proyecto')->set_value_type('url'),

        ]);

