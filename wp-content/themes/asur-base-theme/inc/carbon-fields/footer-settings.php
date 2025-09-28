<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Configuración del Footer')
    ->where('post_type', '=', 'footer_settings')
    ->add_fields([

           
        Field::make('image', 'footer_background_image', 'Imagen de Fondo del Footer')
            ->set_value_type('url'),
        Field::make('separator', 'crb_footer_separator_01', 'Contenido de footer'),
        Field::make('image', 'footer_logo', 'logo del Footer')        
        ->set_value_type('url')
        ->set_width(50),
        Field::make( 'rich_text', 'footer_description', 'descripción del sitio' )
        ->set_width(50),
        Field::make('text', 'footer_phone', 'Teléfono de Contacto')
        ->set_width(33),
        Field::make('text', 'footer_email', 'Email de Contacto')
        ->set_width(33),
        Field::make('text', 'footer_address', 'Dirección de Contacto')
        ->set_width(33),
        Field::make( 'rich_text', 'footer_opening', 'horario' ),


    ]);