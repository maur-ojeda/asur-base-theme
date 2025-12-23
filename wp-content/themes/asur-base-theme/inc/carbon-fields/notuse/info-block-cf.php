<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


Container::make('post_meta', 'Campos de Info Block')
    ->where('post_type', '=', 'info-block')
    ->add_fields([

        Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),

        Field::make('checkbox', 'is_home', 'En home')
            ->set_help_text('Marca esta casilla si la sección esta en el home.')
            ->set_width(50),

        Field::make('text', 'ib_order', 'Orden')
            ->set_attribute('type', 'number')
            ->set_help_text('Número que define el orden de aparición, de menor a mayor.'),


        Field::make('separator', 'crb_type_separator', 'Tipo de Página'),
        Field::make('select', 'type', 'Tipo de Info Block')
            ->add_options([
                '' => 'Selecciona un tipo',
                'type-1' => 'Texto izquierda, imagen derecha',
                'type-2' => 'Texto derecha, imagen izquierda, adorno izquierda',
                'type-3' => 'Texto derecha, imagen izquierda, adorno arriba',
                'type-4' => 'Texto derecha, imagen izquierda, sin adorno',
                'type-5' => 'Texto derecha, imagen izquierda, adorno arriba',
                'type-6' => 'Solo texto, sin imagen',
                'type-8' => 'Texto derecha, imagen izquierda, sin adorno',
                'type-9' => 'Texto izquierda, imagen derecha, sin adorno',
            ])
            ->set_width(50),

        Field::make('separator', 'crb_content_separator', 'Contenido'),
        Field::make('text', 'over_title', 'Sobre título'),
        Field::make('image', 'image', 'Imagen')
            ->set_value_type('url'),
        Field::make('text', 'extra_title', 'Título adicional'),
        Field::make('text', 'extra_overtitle', 'Adicional sobre título'),

        Field::make('separator', 'crb_links_separator', 'Botón'),
        Field::make('text', 'btn_icon', 'Nombre del Ícono (Lucide)')
            ->set_help_text('Ej: Ver https://lucide.dev/icons/')
            ->set_width(33),

        Field::make('text', 'btn_txt', 'Texto del botón')
            ->set_width(33),

        Field::make('text', 'btn_url', 'URL del Enlace')
            ->set_attribute('type', 'url')
            ->set_width(33),
    ]);


Container::make('post_meta', 'info blocks Asociados')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('association', 'selected_info_blocks', 'Seleccionar info blocks')
            ->set_types([
                [
                    'type' => 'post',
                    'post_type' => 'info-block'
                ]
            ])
            ->set_duplicates_allowed(false)
            ->set_help_text('Selecciona los info blocks que se mostrarán en esta página.')
    ]);
