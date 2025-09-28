// contact-form.js
jQuery(document).ready(function($) {
    console.log('Document ready - jQuery Validation loaded');
    
    // Configurar jQuery Validation para todos los formularios de contacto
    $('.contact-form').each(function() {
        const $form = $(this);
        
        $form.validate({
            // Deshabilitar validación HTML5 nativa
            onfocusout: false,
            onkeyup: false,
            onclick: false,
            
            // Reglas de validación
            rules: getValidationRules($form),
            
            // Mensajes personalizados
            messages: getValidationMessages($form),
            
            // Clase para campos inválidos
            errorClass: "is-invalid",
            
            // Elemento para mostrar errores
            errorElement: "div",
            
            // Personalizar cómo se muestran los errores
            errorPlacement: function(error, element) {
                error.addClass("error-message text-danger small");
                error.insertAfter(element);
            },
            
            // Remover errores cuando se escribe
            success: function(label, element) {
                $(element).removeClass("is-invalid");
                label.remove();
            },
            
            // Submit handler
            submitHandler: function(form) {
                console.log('Form validation passed, sending AJAX request');
                
                const $form = $(form);
                const formData = $form.serialize();

                // Mostrar mensaje de carga
                $form.find('.form-response').text('Enviando...').removeClass('text-success text-danger').addClass('text-warning').show();

                $.ajax({
                    url: my_ajax_object.ajax_url,
                    method: 'POST',
                     formData + '&action=handle_custom_contact_form',
                    success: function(response) {
                        console.log('AJAX success response:', response);
                        if (response.success) {
                            $form.find('.form-response').text(response.data.message).removeClass('text-warning text-danger').addClass('text-success').show();
                            $form[0].reset();
                            
                            // Opcional: limpiar mensajes de error de jQuery Validation
                            $form.validate().resetForm();
                        } else {
                            $form.find('.form-response').text(response.data.message).removeClass('text-warning text-success').addClass('text-danger').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX error details:');
                        console.log('Status:', status);
                        console.log('Error:', error);
                        console.log('Response text:', xhr.responseText);
                        
                        $form.find('.form-response').text('Error al enviar el formulario. Por favor intente nuevamente.').removeClass('text-warning text-success').addClass('text-danger').show();
                    }
                });
                
                return false; // Prevenir submit tradicional
            }
        });
    });
    
    // Función para obtener reglas de validación basadas en los campos del formulario
    function getValidationRules($form) {
        const rules = {};
        
        $form.find('input, textarea').each(function() {
            const $field = $(this);
            const name = $field.attr('name');
            const type = $field.attr('type');
            const isRequired = $field.attr('required') !== undefined;
            
            if (name) {
                rules[name] = {};
                
                if (isRequired) {
                    rules[name].required = true;
                }
                
                if (type === 'email') {
                    rules[name].email = true;
                }
                
                if (type === 'number' || type === 'tel') {
                    rules[name].number = true;
                }
                
                // Validar longitud mínima para campos de texto
                if (type === 'text' || type === 'textarea') {
                    const minLength = $field.attr('minlength');
                    if (minLength) {
                        rules[name].minlength = parseInt(minLength);
                    }
                }
            }
        });
        
        return rules;
    }
    
    // Función para obtener mensajes de validación personalizados
    function getValidationMessages($form) {
        const messages = {};
        
        $form.find('input, textarea').each(function() {
            const $field = $(this);
            const name = $field.attr('name');
            const type = $field.attr('type');
            const isRequired = $field.attr('required') !== undefined;
            const label = $field.attr('placeholder') || name;
            
            if (name) {
                messages[name] = {};
                
                if (isRequired) {
                    messages[name].required = `El campo ${label} es obligatorio`;
                }
                
                if (type === 'email') {
                    messages[name].email = `Por favor ingrese un email válido`;
                }
                
                if (type === 'number' || type === 'tel') {
                    messages[name].number = `Por favor ingrese un número válido`;
                }
                
                const minLength = $field.attr('minlength');
                if (minLength) {
                    messages[name].minlength = `El campo ${label} debe tener al menos ${minLength} caracteres`;
                }
            }
        });
        
        return messages;
    }
});