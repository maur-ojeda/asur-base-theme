<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Campos de Nosotros')
        ->where('post_type', '=', 'us')
        ->add_fields([

           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
            Field::make('text', 'us_over_title', 'Sobre título')
                ->set_required(true),
                
            Field::make('image', 'us_image', 'Imagen')
            ->set_value_type('url'),

        ]);

