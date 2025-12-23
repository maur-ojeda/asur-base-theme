<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;



Container::make('post_meta', 'Información Adicional')
    ->where('post_type', '=', 'post')
    ->add_fields(array(
        Field::make('text', 'cf_post_subtitle', 'Subtítulo del Post'),
        Field::make('textarea', 'cf_post_summary', 'Resumen')
    ));
