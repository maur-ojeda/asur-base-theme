<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_hero',
    'title' => 'Sección Hero',
    'fields' => array(
        array(
            'key' => 'field_hero_headline',
            'label' => 'Frase principal',
            'name' => 'hero_headline',
            'type' => 'text',
            'instructions' => 'Frase grande que se muestra en la sección Hero.',
            'required' => 1,
        ),
        array(
            'key' => 'field_hero_subtext',
            'label' => 'Bajada de texto',
            'name' => 'hero_subtext',
            'type' => 'textarea',
            'instructions' => 'Texto más pequeño que aparece bajo la frase principal.',
            'required' => 0,
        ),
        array(
            'key' => 'field_hero_button_1_text',
            'label' => 'Texto Botón 1',
            'name' => 'hero_button_1_text',
            'type' => 'text',
        ),
        array(
            'key' => 'field_hero_button_1_link',
            'label' => 'Enlace Botón 1',
            'name' => 'hero_button_1_link',
            'type' => 'url',
        ),
        array(
            'key' => 'field_hero_button_2_text',
            'label' => 'Texto Botón 2',
            'name' => 'hero_button_2_text',
            'type' => 'text',
        ),
        array(
            'key' => 'field_hero_button_2_link',
            'label' => 'Enlace Botón 2',
            'name' => 'hero_button_2_link',
            'type' => 'url',
        ),
        array(
            'key' => 'field_hero_background_image',
            'label' => 'Imagen de fondo',
            'name' => 'hero_background_image',
            'type' => 'image',
            'return_format' => 'url',
            'preview_size' => 'medium',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'hero',
            ),
        ),
    ),
));

endif;
