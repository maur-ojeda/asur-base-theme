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
                Field::make('separator', 'crb_company_separator_01', 'company Team Picture'),     
                Field::make('select', 'crb_company_op', 'Nivel de opacidad')
                    ->add_options([
                    '' => 'Selecciona una opacidad',
                    'opacity-25' => '25%',
                    'opacity-50' => '50%',
                    'opacity-75' => '75%',
                    'opacity-100' => '100%',
                    ])
                    ->set_default_value('opacity-25')
                    ->set_width(33),
                Field::make('color', 'crb_company_bg', 'Color de fondo')
                    ->set_palette(['#ffffff', '#000000', '#162944'])
                    ->set_help_text('Este color se usará como mascara de fondo ')
                    ->set_default_value('#162944')
                    ->set_width(33),    
                Field::make( 'image', 'crb_company_img', 'Imagen de equipo')
                    ->set_value_type('url')
                        ->set_width(33),    
           


    ]);