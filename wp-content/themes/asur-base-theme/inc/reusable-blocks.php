<?php
/**
 * Obtener un bloque de un CPT asociado a un post.
 *
 * @param int    $post_id        ID del post actual.
 * @param string $cpt_name       Slug del Custom Post Type.
 * @param string $cf_association Nombre del campo de relación (Carbon Fields).
 * @param int    $block_index    Índice del bloque dentro del array.
 * @return WP_Post|null          Objeto WP_Post o null si no existe.
 */
function get_reusable_cpt_block($post_id, $cpt_name, $cf_association, $block_index = 0) {
    $selected_blocks = carbon_get_post_meta($post_id, $cf_association);

    if (empty($selected_blocks) || !isset($selected_blocks[$block_index]['id'])) {
        return null;
    }

    $block_id = $selected_blocks[$block_index]['id'];

    $block_query = new WP_Query([
        'post_type'      => $cpt_name,
        'p'              => $block_id,
        'post_status'    => 'publish',
        'posts_per_page' => 1,
    ]);

    if (!$block_query->have_posts()) {
        return null;
    }

    $block_query->the_post();
    $block_post = get_post(get_the_ID()); // devuelve objeto WP_Post
    wp_reset_postdata();

    return $block_post;
}




/**
 * Obtener un bloque de un CPT a partir de un array de IDs (sin campo de asociación).
 *
 * @param array  $block_ids   Array de IDs de posts (bloques).
 * @param string $cpt_name    Slug del Custom Post Type.
 * @param int    $block_index Índice dentro del array de IDs.
 * @return WP_Post|null       Objeto WP_Post o null si no existe.
 */
function get_reusable_cpt_block_simple($block_ids, $cpt_name, $block_index = 0) {
    if (empty($block_ids) || !isset($block_ids[$block_index])) {
        return null;
    }

    $block_id = $block_ids[$block_index];

    $block_query = new WP_Query([
        'post_type'      => $cpt_name,
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ]);

    if (!$block_query->have_posts()) {
        return null;
    }

    $block_query->the_post();
    $block_post = get_post(get_the_ID());
    wp_reset_postdata();

    return $block_post;
}
