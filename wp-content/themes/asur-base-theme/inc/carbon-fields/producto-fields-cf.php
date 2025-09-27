<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Información del Producto')
    ->where('post_type', '=', 'producto')
    ->add_fields([
        /*Field::make('textarea', 'crb_descripcion_corta', 'Descripción Corta')
            ->set_help_text('Una breve descripción que se usará en listados o resúmenes.'),
        */
        /* Campo complejo para Monitoreo
        Field::make('complex', 'crb_soluciones_monitoreo', 'Soluciones de Monitoreo')
            ->set_help_text('Agrega las soluciones de monitoreo asociadas a este producto.')
            ->add_fields([
                Field::make('text', 'nombre_solucion', 'Nombre de la Solución'),
                Field::make('rich_text', 'descripcion_solucion', 'Descripción'),
                Field::make('association', 'segmento_relacionado', 'Segmento') // Se cambió el nombre del campo para evitar conflictos
                    ->set_types([
                        [
                            'type'      => 'term',
                            'taxonomy'  => 'segmento',
                        ],
                    ]),
            ]),
*/
        // Campo complejo para Info & Brochure
        Field::make('complex', 'crb_material_apoyo', 'Ficha técnica y material de apoyo')
            ->set_help_text('Agrega fichas técnicas, brochures y otros materiales.')
            ->add_fields([
                Field::make('text', 'nombre_material', 'Título del Material'),
                Field::make('file', 'archivo_material', 'Archivo')
                    ->set_value_type('url'),
                Field::make('association', 'tipo_info_relacionado', 'Tipo de Información') // Se cambió el nombre del campo
                    ->set_types([
                        [
                            'type'      => 'term',
                            'taxonomy'  => 'tipo_info',
                        ],
                    ]),
            ]),
    ]);