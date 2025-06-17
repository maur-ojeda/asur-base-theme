<?php
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_products',
        'title' => 'Campos de Producto',
        'fields' => array(
            array(
                'key' => 'field_product_description',
                'label' => 'Descripción',
                'name' => 'product_description',
                'type' => 'textarea',
            ),
            array(
                'key' => 'field_product_images',
                'label' => 'Galería de Imágenes',
                'name' => 'product_images',
                'type' => 'gallery',
                'preview_size' => 'thumbnail',
                'return_format' => 'array',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'product',
                ),
            ),
        ),
    ));
    
endif;