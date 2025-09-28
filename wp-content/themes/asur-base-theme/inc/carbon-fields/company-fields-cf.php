<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Contenido de empresa')
    ->where('post_type', '=', 'page')
    
 
    ->add_fields([
                Field::make( 'image', 'bg_company_imagen', 'Imagen de fondo' )
                ->set_value_type('url'),
                Field::make( 'complex', 'crb_company_item', 'Listado de ítems' )
                    ->add_fields( [
                        Field::make( 'text', 'title', 'Título' ),
                        Field::make( 'rich_text', 'text', 'Texto' ),

                    ])
                    ->set_layout( 'tabbed-horizontal' ),     


    ]);