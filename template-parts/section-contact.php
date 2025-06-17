<?php
$args = array(
    'post_type'      => 'contact',
    'posts_per_page' => 1,
    'orderby'        => 'date',
    'order'          => 'DESC'
);

$contact_query = new WP_Query($args);

if ($contact_query->have_posts()) :
    while ($contact_query->have_posts()) : $contact_query->the_post();
        $title = get_field('contact_title');
        $text = get_field('contact_text');
        $shortcode = get_field('contact_form_shortcode');
        ?>

        <section id="contact" class="contact-section py-5">
            <div class="container">
                <?php if ($title): ?><h2><?php echo esc_html($title); ?></h2><?php endif; ?>
                <?php if ($text): ?><p><?php echo esc_html($text); ?></p><?php endif; ?>
                <?php if ($shortcode): ?>
                    <div class="mt-4">
                        <?php echo do_shortcode($shortcode); ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
