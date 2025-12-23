<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;


Container::make('post_meta', 'Campos de partners')
    ->where('post_type', '=', 'presence')
    ->add_fields([


        Field::make('text', 'over_title', 'Sobre título'),
        Field::make('text', 'title', 'Título'),

        Field::make('complex', 'presences', 'Items de Presencia')
            ->set_layout('tabbed-horizontal')
            ->set_duplicate_groups_allowed(true)
            ->add_fields([
                Field::make('image', 'presence-image', 'imagen')
                    ->set_value_type('url'),
                Field::make('text', 'presence-title', 'Título'),
                Field::make('rich_text', 'presence-description', 'Descripción'),
            ]),
    ]);
