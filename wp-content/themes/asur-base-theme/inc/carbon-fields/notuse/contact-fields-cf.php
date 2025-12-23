<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;



Container::make('post_meta', __('Configuración del Mapa', 'asur-base-theme'))
    ->where('post_id', '=', get_page_id_by_slug('contact'))
    ->add_fields([
        Field::make('map', 'map_location', __('Ubicación en el mapa', 'asur-base-theme'))
            ->set_position(-33.40885168488163, -70.55265854593394, 15) // Lat, Lng, Zoom (Av. Francisco Bilbao 3028)
            ->set_help_text('Arrastra el pin para ajustar la ubicación.')
    ]);


Container::make('post_meta', 'Contenido contacto')
    ->where('post_id', '=', get_page_id_by_slug('contact'))
    ->add_fields([
        Field::make('text', 'contact_shortcode', 'Shortcode de formulario de contacto'),

        Field::make('text', 'form_title', 'Título en el formulario')
            ->set_default_value('Completa el formulario'),
        Field::make('image', 'bg_imagen', 'Imagen de fondo')
            ->set_value_type('url'),

        Field::make('text', 'info_form_title', 'Título')
            ->set_default_value('Pregúntenos cualquier cosa. En cualquier momento.'),

        Field::make('rich_text', 'info_form_content', 'Contenido')
            ->set_default_value('No te preocupes, solo es un paso sencillo y podras mantenerte en contacto con nosotros para cualquier cotización, proyecto en planta, proyecto innovación, etc. '),

        Field::make('complex', 'info_form_content_item', 'Listado de ítems')
            ->add_fields([
                Field::make('text', 'title', 'Título'),
                Field::make('text', 'icon', 'Icono (clase de lucide)')
                    ->set_help_text('Ingresa la clase del icono de Lucide, por ejemplo: lucide-phone, lucide-mail, lucide-map-pin. Puedes encontrar las clases en https://lucide.dev/icons/'),
                Field::make('rich_text', 'text', 'Texto'),


            ]),


        Field::make('complex', 'info_contact_cards', 'Listado de ítems de contacto')
            ->add_fields([
                Field::make('text', 'title', 'Título'),
                Field::make('text', 'icon', 'Icono (clase de lucide)')
                    ->set_help_text('Ingresa la clase del icono de Lucide, por ejemplo: lucide-phone, lucide-mail, lucide-map-pin. Puedes encontrar las clases en https://lucide.dev/icons/'),
                Field::make('rich_text', 'text', 'Texto'),
                Field::make('image', 'image', 'Imagen de fondo')
                    ->set_value_type('url'),


            ])

    ]);
