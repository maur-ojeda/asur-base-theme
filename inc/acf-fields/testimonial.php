<?php
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_testimonial',
        'title' => 'Testimonios',
        'fields' => array(
            array(
                'key' => 'field_testimonial_image',
                'label' => 'Foto',
                'name' => 'testimonial_image',
                'type' => 'image',
                'return_format' => 'url',
                'preview_size' => 'thumbnail',
            ),
            array(
                'key' => 'field_testimonial_text',
                'label' => 'Texto del testimonio',
                'name' => 'testimonial_text',
                'type' => 'textarea',
                'required' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'testimonial',
                ),
            ),
        ),
    ));
    
endif;