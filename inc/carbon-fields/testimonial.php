<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Contenido Testimonios')
        ->where('post_type', '=', 'testimonial')
        ->add_fields([   
            
                       Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),

            Field::make('text', 'testimonial_shortcode', 'Shortcode de testimonios')
                ->set_help_text('Pega aquí el shortcode del plugin de testimonios.'),
        ]);

