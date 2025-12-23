<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Contenido Galería')
        ->where('post_type', '=', 'gallery')
        ->add_fields([           
                       Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),            
            Field::make('text', 'gallery_shortcode', 'Shortcode de galería')
                ->set_help_text('Pega aquí el shortcode del plugin de galería.'),
        ]);

