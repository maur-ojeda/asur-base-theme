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
        Field::make('rich_text', 'footer_description', 'descripción del sitio')
            ->set_width(50),
        Field::make('text', 'footer_phone', 'Teléfono de Contacto')
            ->set_width(33),
        Field::make('text', 'footer_email', 'Email de Contacto')
            ->set_width(33),
        Field::make('text', 'footer_address', 'Dirección de Contacto')
            ->set_width(33),
        Field::make('rich_text', 'footer_opening', 'horario'),

        Field::make('separator', 'crb_footer_separator_02', 'Redes Sociales'),

        Field::make('complex', 'footer_social_links', 'Enlaces de Redes Sociales')
            ->set_max(5)
            ->add_fields([
                Field::make('text', 'social_url', 'URL de la Red Social'),
                Field::make('text', 'social_icon', 'Icono de la Red Social (lucide icon)')
                    ->set_attribute('placeholder', 'Ejempl o: facebook, twitter, instagram'),
            ]),


    ]);
