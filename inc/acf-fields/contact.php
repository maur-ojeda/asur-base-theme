<?php
if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_contact',
        'title' => 'Sección Contacto',
        'fields' => array(
            array(
                'key' => 'field_contact_title',
                'label' => 'Título',
                'name' => 'contact_title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_contact_text',
                'label' => 'Texto introductorio',
                'name' => 'contact_text',
                'type' => 'textarea',
            ),
            array(
                'key' => 'field_contact_shortcode',
                'label' => 'Shortcode del formulario',
                'name' => 'contact_form_shortcode',
                'type' => 'text',
                'instructions' => 'Ej: [wpforms id="123"] o [contact-form-7 id="456"]',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'contact',
                ),
            ),
        ),
    ));
    
    
    
endif;