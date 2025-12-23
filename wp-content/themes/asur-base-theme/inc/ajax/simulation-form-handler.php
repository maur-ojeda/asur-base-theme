<?php
// wp-content/themes/asur-base-theme/inc/ajax/simulation-form-handler.php

// Agregar acciones AJAX para usuarios logueados y no logueados
add_action('wp_ajax_handle_simulation_form', 'handle_simulation_form');
add_action('wp_ajax_nopriv_handle_simulation_form', 'handle_simulation_form');

/**
 * Función principal para manejar el envío del formulario de simulación.
 */
function handle_simulation_form()
{
    // --- DEBUG 1: Verificar si el handler se ejecuta ---
    error_log("DEBUG: handle_simulation_form - Handler iniciado.");

    // Opcional: Validar nonce (seguridad) - Descomenta si implementaste el nonce
    /*
    $nonce = $_POST['simulation_nonce'] ?? '';
    if (!wp_verify_nonce($nonce, 'simulation_form_nonce')) {
        error_log("DEBUG: handle_simulation_form - Nonce inválido.");
        wp_send_json_error(['message' => 'Error de seguridad (nonce inválido).']);
    }
    */

    // --- DEBUG 2: Verificar $_POST recibido ---
    error_log("DEBUG: handle_simulation_form - Datos recibidos en \$_POST: " . print_r($_POST, true));

    // --- 2. Obtener y sanitizar el tipo de cliente ---
    $client_type = sanitize_text_field($_POST['clientType'] ?? '');
    if (!in_array($client_type, ['residencial', 'industrial'])) {
        error_log("DEBUG: handle_simulation_form - Tipo de cliente no válido: " . $client_type);
        wp_send_json_error(['message' => 'Tipo de cliente no válido: ' . $client_type]);
    }

    // --- 3. Recolectar y sanitizar datos del formulario ---
    $entry_data = [];
    $errors = [];

    // Campos de contacto (comunes)
    $entry_data['nombre'] = sanitize_text_field($_POST['nombre'] ?? '');
    $entry_data['telefono'] = sanitize_text_field($_POST['telefono'] ?? '');
    $entry_data['email'] = sanitize_email($_POST['email'] ?? '');

    // Validaciones de contacto
    if (empty($entry_data['nombre'])) {
        $errors[] = 'El nombre es obligatorio.';
    }
    if (empty($entry_data['telefono'])) {
        $errors[] = 'El teléfono es obligatorio.';
    }
    if (empty($entry_data['email']) || !is_email($entry_data['email'])) {
        $errors[] = 'El email no es válido.';
    }

    // Campos específicos para residencial
    if ($client_type === 'residencial') {
        $entry_data['comuna'] = sanitize_text_field($_POST['comuna'] ?? '');
        $entry_data['direccion'] = sanitize_text_field($_POST['direccion'] ?? '');
        $entry_data['roofType'] = sanitize_text_field($_POST['roofType'] ?? '');
        $entry_data['meterLocation'] = sanitize_text_field($_POST['meterLocation'] ?? '');
        // Usar filter_var para enteros es más seguro que intval en entradas de usuario
        $entry_data['monthlyBillCLP'] = filter_var($_POST['monthlyBillCLP'] ?? 0, FILTER_VALIDATE_INT);

        // Validaciones residenciales
        if (empty($entry_data['comuna'])) {
            $errors[] = 'La comuna es obligatoria.';
        }
        if (empty($entry_data['direccion'])) {
            $errors[] = 'La dirección es obligatoria.';
        }
        if (empty($entry_data['roofType'])) {
            $errors[] = 'El tipo de techo es obligatorio.';
        }
        if (empty($entry_data['meterLocation'])) {
            $errors[] = 'La ubicación del medidor es obligatoria.';
        }
        if ($entry_data['monthlyBillCLP'] === false || $entry_data['monthlyBillCLP'] <= 0) { // FILTER_VALIDATE_INT devuelve false si no es válido
            $errors[] = 'El monto de la boleta debe ser un número entero positivo.';
        }
    } else { // Industrial
        // Puedes agregar validaciones específicas para industrial si es necesario
        // Por ahora, solo se validan los datos de contacto
    }

    // --- 4. Verificar si hay errores de validación ---
    if (!empty($errors)) {
        $error_message = implode(' ', $errors);
        error_log("DEBUG: handle_simulation_form - Errores de validación: " . $error_message);
        wp_send_json_error(['message' => $error_message]);
    }

    // --- 5. DEBUG: Verificar datos recolectados antes de guardar ---
    error_log("DEBUG: handle_simulation_form - Datos recolectados y validados: " . print_r($entry_data, true));

    // --- 6. Guardar en la base de datos como un nuevo 'simulation_submission' ---
    $post_title = 'Simulación ' . $client_type . ' - ' . $entry_data['email'] . ' - ' . current_time('Y-m-d H:i:s');
    error_log("DEBUG: handle_simulation_form - Intentando crear post con título: " . $post_title);

    $post_id = wp_insert_post([
        'post_type' => 'simulation_sub', // Asegúrate que este CPT esté registrado
        'post_title' => $post_title,
        'post_status' => 'publish',
        'meta_input' => [
            'client_type' => $client_type,
            'form_data' => $entry_data, // Guardar todos los datos recolectados
        ],
    ]);

    // --- 7. Verificar si wp_insert_post tuvo éxito ---
    if (is_wp_error($post_id)) {
        $error_message = $post_id->get_error_message();
        error_log("DEBUG: handle_simulation_form - Error en wp_insert_post: " . $error_message);
        wp_send_json_error(['message' => 'Error al guardar la simulación en la base de datos: ' . $error_message]);
    }

    if ($post_id === 0) {
        error_log("DEBUG: handle_simulation_form - wp_insert_post devolvió ID 0.");
        wp_send_json_error(['message' => 'Error al guardar la simulación en la base de datos (ID 0).']);
    }

    // --- 8. DEBUG: Confirmar guardado exitoso ---
    error_log("DEBUG: handle_simulation_form: Simulación guardada exitosamente con ID: $post_id");

    // 9. Enviar correos (opcional)
    // Aquí puedes llamar a funciones para enviar emails si lo deseas.
    // send_user_confirmation_simulation_email($entry_data);
    // send_admin_notification_simulation_email($entry_data);

    // 10. Responder con éxito
    $response_message = $client_type === 'residencial'
        ? 'Gracias por enviar tu solicitud. Tu simulación está siendo procesada. Revisa tu email para los detalles.'
        : 'Gracias por tu interés. Un especialista se contactará contigo pronto para tu proyecto industrial/comercial.';

    wp_send_json_success(['message' => $response_message]);
}
