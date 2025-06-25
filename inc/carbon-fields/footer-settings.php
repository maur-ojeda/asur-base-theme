<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Configuración del Footer')
    ->where('post_type', '=', 'footer_settings')
    ->add_fields([
        Field::make('image', 'footer_background_image', 'Imagen de Fondo del Footer')
            ->set_help_text('Sube la imagen que se mostrará en el fondo del pie de página.')
            ->set_value_type('url'),

        Field::make('complex', 'footer_social_links', 'Redes Sociales')
            ->set_layout('tabbed-horizontal')
            ->add_fields([
                Field::make('text', 'social_icon_name', 'Nombre del Ícono (Lucide)')
                    ->set_help_text('Ej: facebook, instagram, linkedin. Ver https://lucide.dev/icons/')
                    ->set_width(50),
                Field::make('text', 'social_url', 'URL del Enlace')
                    ->set_attribute('type', 'url')
                    ->set_width(50),
            ]),
        
        Field::make('text', 'footer_phone', 'Teléfono de Contacto')->set_attribute('type', 'tel'),
        Field::make('text', 'footer_email', 'Email de Contacto')->set_attribute('type', 'email'),
        Field::make('text', 'footer_address', 'Dirección de Contacto'),
    ]);