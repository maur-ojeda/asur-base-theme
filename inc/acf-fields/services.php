<?php
// ACF Fields for Services Custom Post Type

if (function_exists('acf_add_local_field_group')) :
acf_add_local_field_group(array(
    'key' => 'group_services',
    'title' => 'Campos de Servicio',
    'fields' => array(
        array(
            'key' => 'field_service_description',
            'label' => 'Descripción',
            'name' => 'service_description',
            'type' => 'textarea',
            'required' => 1,
        ),
        array(
            'key' => 'field_service_shortcode',
            'label' => 'Galería (Shortcode)',
            'name' => 'service_shortcode',
            'type' => 'text',
            'instructions' => 'Pega aquí el shortcode de la galería',
            'required' => 0,
        ),
      array(
    'key' => 'field_service_features',
    'label' => 'Características',
    'name' => 'service_features',
    'type' => 'repeater',
    'layout' => 'table',
    'min' => 1,
    'sub_fields' => array(
        array(
            'key' => 'field_service_feature_icon',
            'label' => 'Ícono Lucide',
            'name' => 'feature_icon',
            'type' => 'text',
            'placeholder' => 'chef-hat, wine, etc.',
            'instructions' => 'Nombre del ícono Lucide, sin el prefijo.',
            'required' => 1,
        ),
        array(
            'key' => 'field_service_feature_text',
            'label' => 'Texto',
            'name' => 'feature_text',
            'type' => 'text',
            'required' => 1,
        ),
    ),
),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'service',
            ),
        ),
    ),
));



endif;


