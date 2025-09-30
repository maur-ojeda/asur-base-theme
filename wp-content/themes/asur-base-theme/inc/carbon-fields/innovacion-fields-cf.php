<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Contenido de innovación')
    ->where('post_type', '=', 'innovacion')
    ->add_fields([


        Field::make('text', 'crb_content_over_title', 'Sobre título')
        ->set_default_value('INFORMACIÓN'), 
        Field::make('text', 'crb_content_title', 'título'),
        Field::make( 'rich_text', 'crb_content_texto_enriquecido', 'Texto enriquecido' ),
        Field::make( 'image', 'crb_content_imagen', 'Imagen' ),

        
        Field::make('separator', 'crb_hero', 'Hero' ),
            Field::make('text', 'crb_hero_title', 'Título'),
            Field::make( 'image', 'crb_hero_imagen', 'Imagen ' ),
            Field::make('select', 'crb_hero_overlay_opacity', 'Nivel de opacidad')
            ->add_options([
            '' => 'Selecciona una opacidad',
            'opacity-25' => '25%',
            'opacity-50' => '50%',
            'opacity-75' => '75%',
            'opacity-100' => '100%',
            ])
            ->set_default_value('opacity-50') 
            ->set_width(50),
        Field::make('color', 'crb_hero_background_color', 'Color de fondo')
            ->set_palette(['#ffffff', '#000000'])
            ->set_help_text('Este color se usará como mascara de fondo ')
            ->set_default_value('#000000') 
            ->set_width(50),    
        
        Field::make('separator', 'crb_info_a', 'Información tipo a' ),
            
        
        Field::make( 'image', 'crb_info_a_imagen_1', 'Imagen 1' )
            ->set_width(50)
            ->set_help_text('imagen superior'),

        Field::make( 'image', 'crb_info_a_imagen_2', 'Imagen 2' )
        ->set_width(50)
            ->set_help_text('imagen inferior'),

        
        Field::make( 'rich_text', 'crb_info_a_texto_enriquecido', 'Texto enriquecido' ),

        Field::make( 'text', 'crb_info_a_titulo_3', 'Sobre título' )
        ->set_default_value('INSTALACIÓN'), 
        Field::make( 'text', 'crb_info_a_titulo_1', 'Título' ),
        Field::make( 'text', 'crb_info_a_titulo_2', 'Texto en imagen' ),
        
        Field::make( 'complex', 'crb_info_a_listado', 'Listado de ítems' )
            ->add_fields( [
                Field::make( 'text', 'item', 'Ítem del listado' ),
            ])
            ->set_layout( 'tabbed-vertical' ),     


    Field::make('separator', 'crb_video', 'Video' ),

            
            Field::make('text', 'crb_video_title', 'Título')
            ->set_width(50),    
            Field::make( 'file', 'crb_video_file', 'Archivo de video' )
            ->set_width(50),  
    


    Field::make('separator', 'crb_info_b', 'Información tipo b' ),    
        Field::make( 'image', 'crb_info_b_imagen_1', 'Imagen 1' ),    
        Field::make( 'rich_text', 'crb_info_b_texto_enriquecido', 'Texto enriquecido' ),
        Field::make( 'text', 'crb_info_b_titulo_1', 'Título 1' ),
        Field::make( 'text', 'crb_info_b_titulo_2', 'Título 2' ),
        Field::make( 'complex', 'crb_info_b_listado', 'Listado de ítems' )
            ->add_fields( [
                Field::make( 'text', 'item', 'Ítem del listado' ),
            ])
            ->set_layout( 'tabbed-vertical' ),     


        Field::make('separator', 'crb_info_file_separator', 'Ficha técnica y material de apoyo' ),

        Field::make('complex', 'crb_info_file', 'Ficha técnica y material de apoyo')
            ->set_help_text('Agrega fichas técnicas, brochures y otros materiales.')
            ->add_fields([
                Field::make('text', 'crb_info_file_name', 'Título del Material'),
                Field::make( 'image', 'crb_info_file_image', 'Imagen ' )
                ->set_value_type('url'),    
                Field::make('file', 'crb_info_file_esp', 'Archivo español')
                    ->set_value_type('url'),
                Field::make('file', 'crb_info_file_eng', 'Archivo ingles')
                    ->set_value_type('url'),    
                
            ]),
            


    ]);