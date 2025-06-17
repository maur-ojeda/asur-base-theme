<?php
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_clients',
        'title' => 'Campos Clientes',
        'fields' => array(
            array(
                'key' => 'field_client_logo',
                'label' => 'Logo del cliente',
                'name' => 'client_logo',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_client_url',
                'label' => 'Enlace del cliente (opcional)',
                'name' => 'client_url',
                'type' => 'url',
                'instructions' => 'Enlace al sitio del cliente (opcional)',
                'required' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'client',
                ),
            ),
        ),
    ));
    
endif;