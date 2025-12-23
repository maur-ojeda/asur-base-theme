<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Datos del Proyecto')
    ->where('post_type', '=', 'project')
    ->add_fields([
        Field::make('text', 'subtitulo_proyecto', 'Subtítulo'),
        Field::make('textarea', 'descripcion_corta', 'Descripción corta'),
        Field::make('text', 'link_proyecto', 'Link externo (opcional)'),
    ]);


