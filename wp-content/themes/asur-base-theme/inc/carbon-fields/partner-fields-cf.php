<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

 Container::make('post_meta', 'partner carousel')
                ->where('post_id', '=', get_page_id_by_slug('partners'))
            ->add_fields([
            Field::make('association', 'selected-partner-carousel', 'Seleccionar service partner carousel')
                ->set_types([
                    [
                        'type' => 'post',
                        'post_type' => 'partner-carousel'
                    ]
                ])
            ->set_duplicates_allowed( false )
            
        ]);