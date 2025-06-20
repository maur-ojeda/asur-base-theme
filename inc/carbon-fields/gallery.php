<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Contenido Galería')
        ->where('post_type', '=', 'gallery')
        ->add_fields([            
            Field::make('text', 'gallery_shortcode', 'Shortcode de galería')
                ->set_help_text('Pega aquí el shortcode del plugin de galería.'),
        ]);

