<?php

/**
 * Definición de campos personalizados para el CPT Comuna de Servicio usando Carbon Fields.
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Aseguramos que este archivo se ejecute solo dentro de WordPress
defined('ABSPATH') or exit;

Container::make('post_meta', 'datos_comuna')
    ->where('post_type', '=', 'comuna_servicio')
    ->add_fields(array(
        Field::make('text', 'crb_nombre_comuna', 'Nombre de la Comuna')
            ->set_required(true)
            ->help_text('Ingrese el nombre exacto de la comuna.')
            ->set_width(50),
        Field::make('select', 'crb_estado_comuna', 'Estado')
            ->set_required(true)
            ->add_options(array(
                'activo' => 'Activo',
                'inactivo' => 'Inactivo'
            ))
            ->set_default_value('activo')
            ->set_width(50),
    ));
