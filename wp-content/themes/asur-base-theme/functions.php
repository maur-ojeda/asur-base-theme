<?php

/**
 * Funciones y definiciones del tema asur-base-theme.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package asur-base-theme
 */

// =============================================================================
// 1. INCLUDES ESENCIALES
// =============================================================================
// Archivos necesarios para funcionalidades clave del tema.
// =============================================================================

use Carbon_Fields\Carbon_Fields;

$autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoload)) {
    require_once $autoload;
    Carbon_Fields::boot();
}

// Incluye el Nav Walker personalizado para menús de Bootstrap.
require_once get_template_directory() . '/inc/class-bootstrap-navwalker.php';

// Incluye la lógica para el shortcode del formulario de contacto.
require_once get_template_directory() . '/inc/shortcodes/contact-form.php';

// Incluye el manejador AJAX para el envío del formulario de contacto.
require_once get_template_directory() . '/inc/ajax/contact-form-handler.php';

require_once get_template_directory() . '/inc/ajax/simulation-form-handler.php';

// Incluye la función para encolar los scripts y estilos del tema.
require_once get_template_directory() . '/inc/enqueue.php';

require_once get_template_directory() . '/inc/reusable-blocks.php';



// =============================================================================
// 2. CONFIGURACIÓN DEL TEMA
// =============================================================================
// Hooks y funciones que configuran las características básicas del tema.
// =============================================================================

/**
 * Configura las características soportadas por el tema.
 */
function asur_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('custom-logo');

    // Registra las ubicaciones de los menús de navegación.
    register_nav_menus([
        'main_menu' => __('Main Menu', 'asur-base-theme')
    ]);
}
add_action('after_setup_theme', 'asur_theme_setup');


// =============================================================================
// 3. PERSONALIZADOR DE WORDPRESS (CUSTOMIZER)
// =============================================================================
// Añade nuevas opciones al personalizador de temas de WordPress.
// =============================================================================

/**
 * Añade la opción para subir un logo blanco en el personalizador.
 * Útil para encabezados con fondo transparente.
 *
 * @param WP_Customize_Manager $wp_customize Instancia del personalizador.
 */
function asur_customize_register($wp_customize)
{
    // Define el ajuste para el logo blanco.
    $wp_customize->add_setting('white_logo', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);

    // Añade el control para subir la imagen del logo blanco.
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'white_logo_control', [
        'label'       => __('Logo Blanco (para header transparente)', 'asur-base-theme'),
        'description' => __('Sube una versión en blanco del logo para mostrar cuando el encabezado es transparente.', 'asur-base-theme'),
        'section'     => 'title_tagline', // Se añade a la sección "Identidad del Sitio".
        'settings'    => 'white_logo',
        'priority'    => 8, // Justo después del logo estándar.
    ]));
}
add_action('customize_register', 'asur_customize_register');


// =============================================================================
// 4. REGISTRO DE TIPOS DE CONTENIDO Y CAMPOS PERSONALIZADOS
// =============================================================================
// Carga automática de Custom Post Types (CPT) y campos de Carbon Fields.
// =============================================================================

/**
 * Registra los Custom Post Types (CPT) definidos en la carpeta /inc/custom-post-types/.
 * Carga cada archivo PHP de forma automática.
 */
foreach (glob(__DIR__ . '/inc/custom-post-types/*.php') as $cpt_file) {
    require_once $cpt_file;
}

/**
 * Registra los campos personalizados de Carbon Fields.
 * Carga cada archivo de definición de campos desde /inc/carbon-fields/.
 */
add_action('carbon_fields_register_fields', function () {
    foreach (glob(__DIR__ . '/inc/carbon-fields/*.php') as $carbon_fields) {
        require_once $carbon_fields;
    }
});


// =============================================================================
// 5. AJUSTES DEL ÁREA DE ADMINISTRACIÓN (WP-ADMIN)
// =============================================================================
// Modificaciones y personalizaciones del backend de WordPress.
// =============================================================================

/**
 * Deshabilita el editor de bloques (Gutenberg) para los CPTs personalizados.
 * Fuerza el uso del editor clásico para una experiencia más consistente con Carbon Fields.
 */
/*add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
    //$core_post_types = ['post', 'page', 'attachment', 'revision', 'nav_menu_item'];

    // Si el tipo de post no es uno de los principales de WordPress, deshabilita Gutenberg.
    if (!in_array($post_type, $core_post_types)) {
        return false;
    }

    return $use_block_editor;
}, 10, 2);*/
add_filter('use_block_editor_for_post_type', '__return_false', 10, 2);


/**
 * Añade una página de menú en el administrador para agrupar los CPTs.
 * Facilita el acceso a los tipos de contenido personalizados.
 */
add_action('admin_menu', function () {
    add_menu_page(
        'CPT',                     // Título de la página
        'Contenidos',              // Título del menú
        'edit_posts',              // Capacidad requerida
        'cpt',                     // Slug del menú
        '',                        // Función de callback (vacía para ser un separador)
        'dashicons-category',      // Icono del menú
        5                          // Posición en el menú
    );
});


// =============================================================================
// 6. FUNCIONES DE AYUDA (HELPERS)
// =============================================================================
// Funciones de utilidad reutilizables en todo el tema.
// =============================================================================

/**
 * Asegura que una URL use el protocolo HTTPS.
 * Nota: Actualmente está forzando HTTP, probablemente para un entorno de desarrollo local.
 *
 * @param string $url La URL a procesar.
 * @return string La URL con el esquema correcto.
 */
function ensure_https($url)
{
    // Para producción, debería ser: return esc_url(set_url_scheme($url, 'https'));
    return esc_url(set_url_scheme($url, 'http'));
}


// 1. Registrar taxonomías (en init)
add_action('init', 'registrar_taxonomias_basicas');
function registrar_taxonomias_basicas()
{



    // Taxonomía para Industrias
    register_taxonomy('industrias', 'producto', [
        'labels' => [
            'name' => 'Industrias',
            'singular_name' => 'Industria',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'industrias'],
    ]);

    // Taxonomía para Procesos
    register_taxonomy('procesos', 'producto', [
        'labels' => [
            'name' => 'Procesos',
            'singular_name' => 'Proceso',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'procesos'],
    ]);

    // Taxonomía para Productos
    /*register_taxonomy('productos', 'producto', [
        'labels' => [
            'name' => 'Productos',
            'singular_name' => 'Producto',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'productos'],
    ]);*/

    // Taxonomía para Innovación
    register_taxonomy('innovacion', 'info', [
        'labels' => [
            'name' => 'Innovación',
            'singular_name' => 'Innovación',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'innovacion'],
    ]);

    // Taxonomía para Innovación Artículo
    register_taxonomy('innovacion_articulo', 'info', [
        'labels' => [
            'name' => 'Innovación artículo',
            'singular_name' => 'Innovación artículo',
        ],
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => ['slug' => 'innovacion-articulo'],
    ]);
}



add_action('admin_menu', 'crear_menu_taxonomias');
function crear_menu_taxonomias()
{
    add_menu_page(
        'Taxonomías',
        'Taxonomías',
        'manage_options',
        'menu-taxonomias',
        false,
        'dashicons-category',
        25
    );


    add_submenu_page('menu-taxonomias', 'Industrias', 'Industrias', 'manage_options', 'edit-tags.php?taxonomy=industrias');
    add_submenu_page('menu-taxonomias', 'Procesos', 'Procesos', 'manage_options', 'edit-tags.php?taxonomy=procesos');
    add_submenu_page('menu-taxonomias', 'Innovación', 'Innovación', 'manage_options', 'edit-tags.php?taxonomy=innovacion');
}

add_filter('carbon_fields_map_field_api_key', 'asur_google_maps_api_key');
function asur_google_maps_api_key($current_key)
{

    return defined('GOOGLE_MAPS_API_KEY') ? GOOGLE_MAPS_API_KEY : '';
}


// Columnas fijas para contact_submission
add_filter('manage_contact_submission_posts_columns', function ($columns) {
    $new_columns = [];
    $new_columns['cb']       = $columns['cb'];
    $new_columns['title']    = __('Nombre');
    $new_columns['form_id']  = __('Formulario');
    $new_columns['date']     = $columns['date'];
    return $new_columns;
});

// Rellenar las columnas con datos
add_action('manage_contact_submission_posts_custom_column', function ($column, $post_id) {
    $form_data = get_post_meta($post_id, 'form_data', true);
    if (is_serialized($form_data)) {
        $form_data = unserialize($form_data);
    }
    if (!is_array($form_data)) $form_data = [];

    switch ($column) {
        case 'form_id':
            echo esc_html(get_post_meta($post_id, 'form_id', true));
            break;

            // Se pueden agregar más columnas fijas aquí
    }
}, 10, 2);

// Añadir metabox para ver detalles de los envíos
add_action('add_meta_boxes', function () {
    add_meta_box(
        'contact_submission_details',
        'Detalles del envío',
        'render_contact_submission_metabox',
        'contact_submission',
        'normal',
        'high'
    );
});

// Función para mostrar los datos en el metabox
function render_contact_submission_metabox($post)
{
    $form_id   = get_post_meta($post->ID, 'form_id', true);
    $form_data = get_post_meta($post->ID, 'form_data', true);

    if (is_serialized($form_data)) {
        $form_data = unserialize($form_data);
    }

    echo '<p><strong>Formulario ID:</strong> ' . esc_html($form_id) . '</p>';

    if (!empty($form_data) && is_array($form_data)) {
        echo '<table class="widefat striped">';
        echo '<thead><tr><th>Campo</th><th>Valor</th></tr></thead>';
        echo '<tbody>';
        foreach ($form_data as $field => $value) {
            echo '<tr>';
            echo '<td>' . esc_html($field) . '</td>';
            echo '<td>' . esc_html($value) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<p>No hay datos enviados.</p>';
    }
}


function allow_svg_uploads($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');
