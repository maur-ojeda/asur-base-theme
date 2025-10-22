<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;




Container::make('post_meta', 'partners carousel')
    ->where('post_id', '=', get_page_id_by_slug('partners'))
    ->add_fields([
        Field::make('association', 'selected_partner_carousel', 'Seleccionar partner-carousel')
            ->set_types([
                [
                    'type' => 'post',
                    'post_type' => 'partner-carousel'
                ]
            ])
            ->set_duplicates_allowed(false)
            ->set_help_text('Selecciona los partner-carousel  que se mostrarán en esta página.')
    ]);


Container::make('post_meta', 'service cycle')
    ->where('post_id', '=', get_page_id_by_slug('partners'))
    ->add_fields([
        Field::make('association', 'selected_service_cycle', 'Seleccionar service cycle')
            ->set_types([
                [
                    'type' => 'post',
                    'post_type' => 'service-cycle'
                ]
            ])
            ->set_duplicates_allowed(false)
            ->set_help_text('Selecciona los service-cycle  que se mostrarán en esta página.')
    ]);
