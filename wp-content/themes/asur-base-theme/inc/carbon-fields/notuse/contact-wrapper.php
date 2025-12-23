<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Contenido contacto')
        ->where('post_type', '=', 'contact')
        ->add_fields([    
                
            Field::make('text', 'contact_shortcode', 'Shortcode de formulario de contacto')
                ->set_help_text('Pega aquí el shortcode del plugin de contacto. [contact_form id="00"]'),
            Field::make('text', 'over_title', 'Sobre título')
                ->set_default_value('CONTÁCTANOS'),
            Field::make('text', 'form_title', 'Título en el formulario')
                ->set_default_value('Completa el formulario'),
            Field::make( 'image', 'bg_imagen', 'Imagen de fondo' )
                ->set_value_type('url'),
           
        ]);


        