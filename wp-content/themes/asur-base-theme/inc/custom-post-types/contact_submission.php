<?php
function register_cpt_contact_submission()
{
    register_post_type('contact_submission', [
        'label' => 'Contactos recibidos',
        'public' => false,
        'show_ui' => true,
        'supports' => ['title', 'custom-fields'],
        'menu_icon' => 'dashicons-email-alt',
    ]);
}
add_action('init', 'register_cpt_contact_submission');
