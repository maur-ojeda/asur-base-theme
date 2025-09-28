<?php

function render_contact_form_shortcode($atts) {
    $atts = shortcode_atts([
        'id' => 0,
    ], $atts);

    $form_id = (int) $atts['id'];
    if (!$form_id) return '';

    $fields = carbon_get_post_meta($form_id, 'form_fields');
    $recipient = carbon_get_post_meta($form_id, 'recipient_email');
    $success_message = carbon_get_post_meta($form_id, 'success_message');
    $submit_text = carbon_get_post_meta($form_id, 'submit_button_text') ?: 'Enviar';

    ob_start(); ?>

    <form method="post" class="contact-form" data-form-id="<?= esc_attr($form_id); ?>" novalidate="novalidate">
        <input type="hidden" name="contact_form_id" value="<?= esc_attr($form_id); ?>">
        <div class="form-response mt-2" style="display: none;"></div>
        
        <div class="row">
            <?php foreach ($fields as $field): ?>
                <?php
                $name = esc_attr($field['field_name']);
                $label = esc_html($field['field_label']);
                $type = esc_attr($field['field_type']);
                $required = !empty($field['field_required']) ? 'required' : '';
                $minlength = !empty($field['field_minlength']) ? (int)$field['field_minlength'] : '';
                $maxlength = !empty($field['field_maxlength']) ? (int)$field['field_maxlength'] : '';
                $placeholder = esc_attr($field['field_placeholder'] ?? $label);
                
                // Añadir atributos adicionales basados en el tipo de campo
                $additional_attrs = '';
                if ($minlength) $additional_attrs .= ' minlength="' . $minlength . '"';
                if ($maxlength) $additional_attrs .= ' maxlength="' . $maxlength . '"';
                
                $classType = '';
                switch ($type) {
                    case 'text':
                        $classType = 'col-md-6 col-12';
                        break;
                    case 'email':
                        $classType = 'col-12';
                        break;
                    case 'textarea':
                        $classType = 'col-12';
                        break;
                    case 'number':
                        $classType = 'col-md-6 col-12';
                        break;
                    case 'tel':
                        $classType = 'col-md-6 col-12';
                        break;
                    case 'url':
                        $classType = 'col-12';
                        break;
                    default:
                        $classType = 'col-md-6 col-12';
                        break;
                }
                ?>
                
                <div class="mb-3 <?= $classType ?>">                           
                    <?php if ($type === 'textarea'): ?>
                        <textarea 
                            name="<?= $name ?>" 
                            id="<?= $name ?>" 
                            class="form-control rounded-3 border-primary p-3" 
                            <?= $required ?> 
                            <?= $additional_attrs ?>
                            placeholder="<?= $placeholder ?>"
                            rows="5"
                        ></textarea>
                    <?php else: ?>
                        <input 
                            type="<?= $type ?>" 
                            name="<?= $name ?>" 
                            id="<?= $name ?>" 
                            class="form-control p-3 rounded-3 border-primary" 
                            <?= $required ?>  
                            <?= $additional_attrs ?>
                            placeholder="<?= $placeholder ?>"
                        >
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        
        <button type="submit" class="btn btn-krom">        
            <?= esc_html($submit_text); ?> 
            <i class="hvr-icon" data-lucide="arrow-right"></i>
        </button>
        
        <div class="form-response mt-2" style="display: none;"></div>
    </form>

    <?php return ob_get_clean();
}
add_shortcode('contact_form', 'render_contact_form_shortcode');