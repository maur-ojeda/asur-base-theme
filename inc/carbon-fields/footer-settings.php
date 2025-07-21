<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Configuración del Footer')
    ->where('post_type', '=', 'footer_settings')
    ->add_fields([

           Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
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

        Field::make('separator', 'crb_links_separator', 'Secciones de Enlaces del Footer'),

        Field::make('complex', 'footer_link_sections', 'Columnas de Enlaces')
            ->set_layout('tabbed-horizontal')
            ->set_help_text('Añade y organiza las columnas de enlaces que aparecerán en el footer. Cada entrada es una nueva columna.')
            ->add_fields('link_section', [
                Field::make('text', 'section_title', 'Título de la Columna')
                    ->set_width(50),
                Field::make('text', 'section_title_link', 'Enlace del Título (Opcional)')
                    ->set_help_text('Puede ser una URL completa (https://...), una ruta relativa (/contacto) o un ancla (#servicios).')
                    ->set_width(50),
                Field::make('complex', 'section_links', 'Enlaces de la Columna')
                    ->set_layout('tabbed-vertical')
                    ->add_fields('link_item', [
                        Field::make('text', 'link_text', 'Texto del Enlace')->set_width(50)->set_required(true),
                        Field::make('text', 'link_url', 'URL del Enlace')->set_width(50)->set_required(true),
                    ]),
            ]),

        Field::make('text', 'footer_phone', 'Teléfono de Contacto')->set_attribute('type', 'tel'),
        Field::make('text', 'footer_email', 'Email de Contacto')->set_attribute('type', 'email'),
        Field::make('text', 'footer_address', 'Dirección de Contacto'),
    ]);