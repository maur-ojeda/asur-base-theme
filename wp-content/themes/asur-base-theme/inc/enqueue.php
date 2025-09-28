<?php

// Cargar CSS y JS del theme desde /dist/
function asur_enqueue_assets() {
    wp_enqueue_style(
        'asur-theme-style',
        get_template_directory_uri() . '/dist/css/style.min.css',
        [],
        filemtime(get_template_directory() . '/dist/css/style.min.css')
    );

    wp_enqueue_style(
        'aos',
        'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
        [],
        '2.3.4'
    );

    wp_enqueue_script(
        'asur-theme-script',
        get_template_directory_uri() . '/dist/js/app.min.js',
        [],
        filemtime(get_template_directory() . '/dist/js/app.min.js'),
        true
    );

    wp_enqueue_script(
        'jquery-validation',
        'https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js',
        ['jquery'],
        '1.19.5',
        true
    );

    wp_enqueue_script(
        'custom-contact-form',
        get_template_directory_uri() . '/dist/js/contact-form.js', 
        ['jquery', 'jquery-validation'], // Añadido jquery-validation como dependencia
        filemtime(get_template_directory() . '/dist/js/contact-form.js'),
        true
    );

    wp_localize_script('custom-contact-form', 'my_ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'asur_enqueue_assets');