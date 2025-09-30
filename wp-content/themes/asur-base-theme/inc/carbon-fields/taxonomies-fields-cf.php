<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

    Container::make('term_meta', 'Información de Línea de Producto ')
         ->where( 'term_taxonomy', 'IN', array(  
            'industrias',
            'procesos' 
        ) ) 
        
        ->add_fields([
            Field::make('separator', 'crb_lp', 'información tax-fields' ),            
            
            Field::make('image', 'linea_producto_imagen', 'Imagen')->set_value_type('url'),                
            Field::make('rich_text', 'linea_producto_descripcion', 'Descripción '),
            

            Field::make('separator', 'crb_mt', 'hero' ), 
            Field::make('select', 'hero_overlay_opacity', 'Nivel de opacidad')
            ->add_options([
            '' => 'Selecciona una opacidad',
            'opacity-25' => '25%',
            'opacity-50' => '50%',
            'opacity-75' => '75%',
            'opacity-100' => '100%',
            ])
            ->set_width(50),
            Field::make('color', 'hero_background_color', 'Color de fondo')
            ->set_palette(['#ffffff', '#000000'])
            ->set_help_text('Este color se usará como mascara de fondo ')
            ->set_width(50),    
            Field::make('image', 'hero_background_image', 'Imagen de fondo')
            ->set_value_type('url'),

            Field::make('separator', 'crb_mt_content', 'custom data' ), 
            Field::make('text', 'taxonomy_custom_over_title', 'Sobre título personalizado')
            ->set_help_text('Introduce un sobre título para esta página de taxonomía.'),
            Field::make('text', 'taxonomy_custom_title', 'Título personalizado')
            ->set_help_text('Introduce un título para esta página de taxonomía.'),
            



        ]);





   Container::make('term_meta', 'Información de Línea de Producto ')
         ->where( 'term_taxonomy', 'IN', array(  
            'industrias',
            
        ) ) 
        
        ->add_fields([
          Field::make('separator', 'crb_lp0', 'asociar proyecto de innovación' ),            
          Field::make('association', 'crb_innovacion', 'proyecto de innovación')
            ->set_types([
                [
                        'type' => 'post',
                        'post_type' => 'innovacion'
                    ]
            ])
            ->set_duplicates_allowed( false )
 ]);

