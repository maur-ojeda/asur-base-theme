<?php
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_gallery',
        'title' => 'Campos Galería',
        'fields' => array(
            array(
                'key' => 'field_gallery_image',
                'label' => 'Imagen',
                'name' => 'gallery_image',
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
                    'value' => 'gallery',
                ),
            ),
        ),
    ));
    
endif;