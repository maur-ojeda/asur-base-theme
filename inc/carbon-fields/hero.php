<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Campos Hero')
    ->where('post_type', '=', 'hero')
    ->add_fields([
        Field::make('text', 'hero_headline', 'Frase principal')
            ->set_required(true),

        Field::make('textarea', 'hero_subtext', 'Bajada de texto'),

        Field::make('text', 'hero_button_1_text', 'Texto Botón 1'),
        Field::make('text', 'hero_button_1_link', 'Enlace Botón 1'),

        Field::make('text', 'hero_button_2_text', 'Texto Botón 2'),
        Field::make('text', 'hero_button_2_link', 'Enlace Botón 2'),

        Field::make('image', 'hero_background_image', 'Imagen de fondo')
            ->set_value_type('url'),
    ]);
