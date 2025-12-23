<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Opciones del Simulador')
    ->where('post_type', '=', 'simulator_settings')
    ->add_fields([
        Field::make('separator', 'crb_company_separator_00', 'Comunas de Servicio'),
        Field::make('complex', 'crb_comunas_servicio', 'Comunas de Servicio')
            ->set_layout('tabbed-horizontal')
            ->add_fields(array(
                Field::make('text', 'nombre', 'Nombre de la Comuna')
                    ->set_required(true)
                    ->set_width(33),
                Field::make('text', 'comuna_slug', 'Slug')
                    ->set_required(true)
                    ->set_width(33)
                    ->set_help_text('sin acentos, minusculas, reemplazar espacios por guiones "-"'),
                Field::make('select', 'estado', 'Estado')
                    ->set_required(true)
                    ->set_width(33)
                    ->add_options(array(
                        'activo' => 'Activo',
                        'inactivo' => 'Inactivo'
                    ))
                    ->set_default_value('activo'),
            ))->set_layout('tabbed-horizontal'),
        Field::make('separator', 'crb_company_separator_01', 'Tipo de techo'),
        Field::make('complex', 'enercity_multiplicadores_techo', 'Multiplicadores por tipo de techo')
            ->set_layout('tabbed-horizontal')
            ->add_fields(array(
                Field::make('text', 'techo_label', 'Etiqueta')
                    ->set_width(33),
                Field::make('text', 'techo_slug', 'Slug')
                    ->set_width(33)
                    ->set_help_text('sin acentos, minusculas, reemplazar espacios por guiones "-"'),
                Field::make('text', 'techo_multiplier', 'Multiplicador')
                    ->set_width(33)
                    ->set_default_value("1.5")
                    ->set_attribute('type', 'number')
            )),
        Field::make('separator', 'crb_company_separator_02', 'Ubicación de  de medidor'),
        Field::make('complex', 'enercity_multiplicadores_medidor', 'Multiplicadores por ubicación medidor')
            ->set_layout('tabbed-horizontal')
            ->add_fields(array(
                Field::make('text', 'medidor_label', 'Etiqueta')
                    ->set_width(33),
                Field::make('text', 'medidor_slug', 'Slug')
                    ->set_width(33)
                    ->set_help_text('sin acentos, minusculas, reemplazar espacios por guiones "-"'),
                Field::make('text', 'medidor_multiplier', 'Multiplicador')
                    ->set_width(33)
                    ->set_default_value("1.5")
                    ->set_attribute('type', 'number')
            )),

        Field::make('separator', 'crb_company_separator_03', 'Datos'),

        Field::make('complex', 'enercity_data_table', 'Datos de Simulación')

            ->set_layout('tabbed-horizontal')
            ->add_fields(array(
                Field::make('text', 'consumo_bruto', 'Consumo Promedio Bruto')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'amperaje_necesario', 'Amperaje Necesario')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'potencia_inversor', 'Potencia Inversor')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'cantidad_paneles', 'Cantidad de Paneles')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'potencia_total_fv', 'Potencia Total Sistema FV')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'on_grid_neto', '$ On Grid Neto')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'hibrido_5kwh_neto', '$ Hibrido 5 kWh Neto')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'valor_60', 'Valor 60')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
                Field::make('text', 'valor_144', 'Valor 144')
                    ->set_width(33)
                    ->set_attribute('type', 'number'),
            ))




    ]);
