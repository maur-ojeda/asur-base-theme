<?php

/**
 * Definición del Custom Post Type para Comunas de Servicio.
 */

defined('ABSPATH') or exit;

class Asur_Comuna_CPT
{

    const POST_TYPE = 'comuna_servicio';

    public function __construct()
    {
        add_action('init', array($this, 'register_post_type'));
        add_action('admin_head', array($this, 'hide_publish_box'));
        add_filter('manage_' . self::POST_TYPE . '_posts_columns', array($this, 'set_custom_columns'));
        add_action('manage_' . self::POST_TYPE . '_posts_custom_column', array($this, 'custom_column_data'), 10, 2);
    }

    /**
     * Registra el Custom Post Type Comuna de Servicio.
     */
    public function register_post_type()
    {
        $labels = array(
            'name'                  => _x('Comunas de Servicio', 'Post type general name', 'asur-base-theme'),
            'singular_name'         => _x('Comuna de Servicio', 'Post type singular name', 'asur-base-theme'),
            'menu_name'             => _x('Comunas', 'Admin Menu text', 'asur-base-theme'),
            'name_admin_bar'        => _x('Comuna', 'Add New on Toolbar', 'asur-base-theme'),
            'add_new'               => __('Agregar Nueva', 'asur-base-theme'),
            'add_new_item'          => __('Agregar Nueva Comuna de Servicio', 'asur-base-theme'),
            'new_item'              => __('Nueva Comuna', 'asur-base-theme'),
            'edit_item'             => __('Editar Comuna', 'asur-base-theme'),
            'view_item'             => __('Ver Comuna', 'asur-base-theme'),
            'all_items'             => __('Todas las Comunas', 'asur-base-theme'),
            'search_items'          => __('Buscar Comunas', 'asur-base-theme'),
            'not_found'             => __('No se encontraron comunas.', 'asur-base-theme'),
            'not_found_in_trash'    => __('No se encontraron comunas en la papelera.', 'asur-base-theme'),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => 'cpt', // Agrupar en el menú "Contenidos" que ya tienes
            'query_var'          => false,
            'rewrite'            => array('slug' => 'comuna-servicio'),
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'supports'           => array('title'), // Solo título por ahora
            'show_in_rest'       => false, // Desactivamos el editor de bloques y REST para este CPT
            'menu_position'      => null,
        );

        register_post_type(self::POST_TYPE, $args);
    }

    /**
     * Oculta el botón de Publicar/Actualizar en el editor para este CPT.
     */
    public function hide_publish_box()
    {
        global $post;
        if (isset($post) && $post->post_type === self::POST_TYPE) {
            echo '<style type="text/css">#publishing-action, #post-preview { display: none; }</style>';
        }
    }

    /**
     * Define las columnas personalizadas en la lista de posts.
     */
    public function set_custom_columns($columns)
    {
        $new_columns = array();

        foreach ($columns as $key => $value) {
            if ($key === 'title') {
                $new_columns['nombre'] = 'Nombre de la Comuna'; // Renombramos la columna título
            } else {
                $new_columns[$key] = $value;
            }
        }
        $new_columns['estado'] = 'Estado';

        return $new_columns;
    }

    /**
     * Rellena las columnas personalizadas con datos.
     */
    public function custom_column_data($column, $post_id)
    {
        switch ($column) {
            case 'nombre':
                // Mostrar el campo personalizado 'crb_nombre_comuna' si existe, sino el título
                $nombre = carbon_get_post_meta($post_id, 'crb_nombre_comuna');
                echo esc_html($nombre ?: get_the_title($post_id));
                break;
            case 'estado':
                $estado = carbon_get_post_meta($post_id, 'crb_estado_comuna');
                echo esc_html(ucfirst($estado));
                break;
        }
    }
}

// Inicializar la clase
new Asur_Comuna_CPT();
