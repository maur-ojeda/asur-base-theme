<?php
// CPT: Monitoreo
add_action('init', function () {
    $labels = [
        'name'          => __('Monitoreos', 'asur-base-theme'),
        'singular_name' => __('Monitoreo', 'asur-base-theme'),
        'menu_name'     => __('Monitoreos', 'asur-base-theme'),
    ];

    register_post_type('monitoreo', [
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'monitoreos'],
        'menu_icon'    => 'dashicons-visibility',
        'supports'     => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'show_in_menu' => 'cpt',
        'taxonomies'   => ['industria', 'segmento'],
    ]);
});