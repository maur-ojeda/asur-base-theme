<?php
/*
|--------------------------------------------------------------------------
| Relaciones Jerárquicas con Carbon Fields
|--------------------------------------------------------------------------
*/

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Relación: procesos -> industria
Container::make('term_meta', 'Relación con padre industrias')
    ->where('term_taxonomy', '=', 'procesos')
    ->add_fields([
        Field::make('association', 'crb_industria_parent', 'Industria Padre')
            ->set_types([
                [
                    'type' => 'term',
                    'taxonomy' => 'industrias',
                ]
            ])
            ->set_max(1)
    ]);


// Relación: proceso -> producto
/*Container::make('post_meta', 'Relación con proceso padre')
    ->where('post_type', '=', 'producto')
    ->add_fields([
        Field::make('association', 'crb_proceso_parent', 'Proceso Padre')
            ->set_types([
                [
                    'type' => 'term',
                    'taxonomy' => 'procesos',
                ]
            ])
            ->set_max(1)
    ]);
*/


    // Relación: innovacion -> articulo
/* Container::make('post_meta', 'Relación con innovacion padre')
    ->where('post_type', '=', 'articulo')
    ->add_fields([
        Field::make('association', 'crb_innovacion_parent', 'innovación Padre')
            ->set_types([
                [
                    'type' => 'term',
                    'taxonomy' => 'innovacion',
                ]
            ])
            ->set_max(1)
    ]);
*/
    
    

/*
Container::make('post_meta', 'Relación con Fabricante')
    ->where('post_type', '=', 'producto')
    ->add_fields([
        Field::make('association', 'crb_fabricante_parent', 'Fabricante Padre')
            ->set_types([
                [
                    'type' => 'term',
                    'taxonomy' => 'fabricante',
                ]
            ])
            ->set_max(1)
    ]);
    */