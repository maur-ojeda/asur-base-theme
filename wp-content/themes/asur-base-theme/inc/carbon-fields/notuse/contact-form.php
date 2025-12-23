<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('post_meta', 'Opciones del Formulario de Contacto')
    ->where('post_type', '=', 'contact_form')
    ->add_fields([
        Field::make('complex', 'form_fields', 'Campos del Formulario')
            ->set_layout('tabbed-horizontal')
            ->set_duplicate_groups_allowed(true)
            ->add_fields('field', [
                Field::make('text', 'field_label', 'Etiqueta del campo')->set_required(true),
                Field::make('text', 'field_name', 'Nombre del campo (name)')->set_required(true),
                Field::make('select', 'field_type', 'Tipo de campo')
                    ->add_options([
                        'text' => 'Texto',
                        'email' => 'Email',
                        'textarea' => 'Área de texto',
                        'tel' => 'Teléfono',
                    ])
                    ->set_default_value('text'),
                Field::make('checkbox', 'field_required', 'Requerido')
                    ->set_option_value('yes'),
            ])
            ->set_help_text('Define los campos que aparecerán en el formulario.'),

        Field::make('text', 'recipient_email', 'Correo de destino')
            ->set_help_text('Correo del destinatario que recibirá los mensajes de este formulario.'),

        Field::make('text', 'success_message', 'Mensaje de éxito')
            ->set_default_value('Gracias por contactarnos. Te responderemos pronto.'),

        Field::make('text', 'submit_button_text', 'Texto del botón de envío')
            ->set_default_value('Enviar'),
    ]);
