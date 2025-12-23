<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Opciones de Destacado')
    ->where('post_type', '=', 'category-showcase')
    ->add_fields([
        Field::make('complex', 'crb_destacados_agrupados', 'Destacados Agrupados')
            ->set_help_text('Agrega los bloques destacados para esta sección.')
            ->add_fields([
                Field::make('association', 'taxonomia_destacada', 'Taxonomía de Industria')
                    ->set_types([
                        [
                            'type'     => 'term',
                            'taxonomy' => 'industrias',
                        ],
                    ]),
                Field::make('image', 'image', 'Imagen de fondo'),
                Field::make('color', 'title_color', 'Color de fondo')
                    ->set_palette(['#ffffff', '#000000'])
                    ->set_help_text('Este color se usará para el título de la sección.')
                    ->set_width(50),        
            ])
            
        
    ]);



    Container::make('post_meta', 'category showcase Asociado (solo en home)')
        ->where('post_type', '=', 'page')
        ->add_fields([
        Field::make('association', 'selected_category_showcase', 'Seleccionar category showcase')
            ->set_types([
                [
                    'type' => 'post',
                    'post_type' => 'category-showcase'
                ]
            ])
        ->set_duplicates_allowed( false )
        ->set_help_text('Selecciona los info blocks que se mostrarán en esta página.')
    ]);




    