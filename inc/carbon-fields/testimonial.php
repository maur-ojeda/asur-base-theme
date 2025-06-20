<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Contenido Testimonios')
        ->where('post_type', '=', 'testimonial')
        ->add_fields([            
            Field::make('text', 'testimonial_shortcode', 'Shortcode de testimonios')
                ->set_help_text('Pega aquí el shortcode del plugin de testimonios.'),
        ]);

