<?php
// inc/carbon-fields/product-fields.php
use Carbon_Fields\Container;
use Carbon_Fields\Field;


    Container::make('post_meta', 'Detalles del Producto')
        ->where('post_type', '=', 'product')
        ->add_fields([
            Field::make('textarea', 'product_description', 'Descripción'),
            Field::make('text', 'product_gallery_shortcode', 'Shortcode de Galería')->set_help_text('Pega aquí el shortcode de la galería.'),

            Field::make('complex', 'product_features', 'Características')
                ->set_layout('tabbed-horizontal')
                ->add_fields([
                    Field::make('text', 'feature_icon', 'Ícono Lucide')->set_help_text('Ej: wine, knife, etc.'),
                    Field::make('text', 'feature_title', 'Título'),
                    Field::make('textarea', 'feature_description', 'Descripción'),
                ]),
        ]);

