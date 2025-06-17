<?php

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_whatwedo',
    'title' => 'Sección What We Do',
    'fields' => array(
        array(
            'key' => 'field_whatwedo_number',
            'label' => 'Número destacado',
            'name' => 'whatwedo_number',
            'type' => 'number',
            'instructions' => 'Número que se mostrará en grande.',
            'required' => 1,
        ),
        array(
            'key' => 'field_whatwedo_text',
            'label' => 'Texto corto',
            'name' => 'whatwedo_text',
            'type' => 'textarea',
            'instructions' => 'Texto descriptivo que acompaña al número.',
            'rows' => 2,
            'required' => 0,
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'whatwedo',
            ),
        ),
    ),
));

endif;
