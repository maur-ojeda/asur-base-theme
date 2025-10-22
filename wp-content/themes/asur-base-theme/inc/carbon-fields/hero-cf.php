<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Campos Hero')
    ->where('post_type', '=', 'hero')
    ->add_fields([
        Field::make('checkbox', 'is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
        Field::make('checkbox', 'is_home', 'Esta sección es para la página de inicio (maneja el alto)')
            ->set_option_value('no')
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
        Field::make('file', 'hero_background_video', 'Video de fondo (opcional)')
            ->set_type('video/mp4')
            ->set_value_type('url'),
        Field::make('select', 'hero_overlay_opacity', 'Nivel de opacidad')
            ->add_options([
                '' => 'Selecciona una opacidad',
                'opacity-25' => '25%',
                'opacity-50' => '50%',
                'opacity-75' => '75%',
                'opacity-100' => '100%',
            ])
            ->set_width(33),
        Field::make('color', 'hero_background_color', 'Color de fondo')
            ->set_palette(['#ffffff', '#000000'])
            ->set_help_text('Este color se usará como mascara de fondo ')
            ->set_width(33),
        Field::make('image', 'hero_background_image', 'Imagen de fondo')
            ->set_value_type('url')
            ->set_width(33),
    ]);

Container::make('post_meta', 'Hero Asociado')
    ->where('post_type', '=', 'page')
    ->add_fields([
        Field::make('association', 'selected_hero', 'Seleccionar Hero')
            ->set_types([
                [
                    'type' => 'post',
                    'post_type' => 'hero'
                ]
            ])
            ->set_max(1)
            ->set_help_text('Selecciona el hero que se mostrará en esta página.')
    ]);

Container::make('theme_options', 'Opciones del Tema')
    ->add_tab('Hero', [
        Field::make('association', 'search_hero', 'Hero para página de búsqueda')
            ->set_types([['type' => 'post', 'post_type' => 'hero']])
            ->set_max(1)
    ]);
