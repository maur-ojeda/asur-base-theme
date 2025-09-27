<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

    Container::make('term_meta', 'Metadatos de la Taxonomía')
        ->where( 'term_taxonomy', 'IN', array( 
            'linea_producto', 
            'familia_producto', 
            'tecnologia', 
            'industria',
            'fabricante' 
        ) ) 
        ->add_fields([
            Field::make('text', 'taxonomy_custom_title', 'Título personalizado')
                ->set_help_text('Introduce un título para esta página de taxonomía.'),
            Field::make('text', 'taxonomy_custom_over_title', 'Sobre título personalizado')
                ->set_help_text('Introduce un sobre título para esta página de taxonomía.'),

        ]);

