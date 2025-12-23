<?php
// CPT: Info
add_action('init', function () {
    $labels = [
        'name'          => __('Información', 'asur-base-theme'),
        'singular_name' => __('Información', 'asur-base-theme'),
        'menu_name'     => __('Información', 'asur-base-theme'),
    ];

    register_post_type('info', [
        'labels'       => $labels,
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => ['slug' => 'informacion'],
        'menu_icon'    => 'dashicons-media-document',
        'supports'     => ['title', 'editor', 'thumbnail'],
        'show_in_rest' => true,
        'show_in_menu' => 'cpt',    
        'taxonomies'   => ['tipo_info'],
    ]);
});
