<?php
//wp-content/themes/asur-base-theme/inc/ajax/contact-form-handler.php
add_action('wp_ajax_handle_custom_contact_form', 'handle_custom_contact_form');
add_action('wp_ajax_nopriv_handle_custom_contact_form', 'handle_custom_contact_form');

function handle_custom_contact_form() {
    if (!isset($_POST['contact_form_id'])) {
        wp_send_json_error(['message' => 'ID de formulario no enviado.']);
    }

    $form_id = absint($_POST['contact_form_id']);
    $fields = carbon_get_post_meta($form_id, 'form_fields');

    // Validación de campos
    $errors = [];
    $entry_data = [];
    $user_email_field = null;
    $user_name_field = null;

    foreach ($fields as $field) {
        $field_name = sanitize_text_field($field['field_name']);
        $field_label = sanitize_text_field($field['field_label']);
        $is_required = !empty($field['field_required']);
        $field_type = sanitize_text_field($field['field_type']);

        // Almacenar el valor del campo
        $field_value = isset($_POST[$field_name]) ? sanitize_text_field($_POST[$field_name]) : '';

        // Validar campos requeridos
        if ($is_required && empty($field_value)) {
            $errors[] = "El campo {$field_label} es obligatorio";
        }

        // Validar email
        if ($field_type === 'email' && !empty($field_value)) {
            if (!is_email($field_value)) {
                $errors[] = "El email en el campo {$field_label} no es válido";
            }
            $user_email_field = $field_name;
        }

        // Identificar campo de nombre del usuario
        if ($field_type === 'text' && (stripos($field_name, 'name') !== false || stripos($field_name, 'nombre') !== false)) {
            $user_name_field = $field_name;
        }

        $entry_data[$field_name] = $field_value;
    }

    // Si hay errores, retornarlos
    if (!empty($errors)) {
        wp_send_json_error(['message' => implode('. ', $errors)]);
    }

    // Guardar en la base de datos
    $post_id = wp_insert_post([
        'post_type' => 'contact_submission',
        'post_title' => 'Envío de formulario ' . $form_id . ' - ' . current_time('Y-m-d H:i:s'),
        'post_status' => 'publish',
        'meta_input' => [
            'form_id' => $form_id,
            'form_data' => $entry_data,
        ],
    ]);

    // Enviar correos si hay un email válido
    if ($user_email_field && !empty($entry_data[$user_email_field]) && is_email($entry_data[$user_email_field])) {
        // Enviar correo de confirmación al usuario
        send_user_confirmation_email($entry_data, $user_name_field, $entry_data[$user_email_field]);
        
        // Opcional: Enviar correo al administrador
        send_admin_notification_email($entry_data, $fields);
    }

    // Enviar respuesta AJAX
    wp_send_json_success(['message' => 'Gracias por contactarnos. Te responderemos pronto.']);
}

// Función para enviar email de confirmación al usuario
function send_user_confirmation_email($form_data, $user_name_field, $user_email) {
    $site_name = get_bloginfo('name');
    $name = !empty($user_name_field) && !empty($form_data[$user_name_field]) 
        ? $form_data[$user_name_field] 
        : 'Estimado usuario';
    
    $subject = "Confirmación de mensaje - {$site_name}";
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background-color: #f8f9fa; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .footer { background-color: #f8f9fa; padding: 15px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>¡Gracias por contactarnos!</h2>
        </div>
        <div class='content'>
            <p>Hola {$name},</p>
            <p>Hemos recibido tu mensaje correctamente. Agradecemos tu contacto y nos pondremos en contacto contigo a la brevedad.</p>
            <p><strong>Resumen de tu mensaje:</strong></p>
            <ul>
    ";
    
    foreach ($form_data as $key => $value) {
        $label = ucfirst(str_replace('_', ' ', $key));
        $message .= "<li><strong>{$label}:</strong> {$value}</li>";
    }
    
    $message .= "
            </ul>
            <p>Atentamente,<br>{$site_name}</p>
        </div>
        <div class='footer'>
            <p>Este es un mensaje automático, por favor no responda directamente a este correo.</p>
        </div>
    </body>
    </html>
    ";

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $site_name . ' <' . get_option('admin_email') . '>'
    ];

    wp_mail($user_email, $subject, $message, $headers);
}

// Función para enviar notificación al administrador
function send_admin_notification_email($form_data, $fields) {
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');
    
    $subject = "Nuevo mensaje de contacto - {$site_name}";
    
    $message = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .header { background-color: #0073aa; color: white; padding: 20px; text-align: center; }
            .content { padding: 20px; }
            .field-row { border-bottom: 1px solid #eee; padding: 10px 0; }
        </style>
    </head>
    <body>
        <div class='header'>
            <h2>Nuevo mensaje de contacto</h2>
        </div>
        <div class='content'>
            <table style='width: 100%; border-collapse: collapse;'>
    ";
    
    foreach ($fields as $field) {
        $field_name = $field['field_name'];
        $field_label = $field['field_label'];
        $field_value = isset($form_data[$field_name]) ? $form_data[$field_name] : '';
        
        $message .= "
            <tr class='field-row'>
                <td style='font-weight: bold; width: 30%; vertical-align: top;'>{$field_label}:</td>
                <td style='vertical-align: top;'>" . nl2br(esc_html($field_value)) . "</td>
            </tr>
        ";
    }
    
    $message .= "
            </table>
            <p><em>Enviado el: " . current_time('d/m/Y H:i:s') . "</em></p>
        </div>
    </body>
    </html>
    ";

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $site_name . ' <' . $admin_email . '>'
    ];

    wp_mail($admin_email, $subject, $message, $headers);
}