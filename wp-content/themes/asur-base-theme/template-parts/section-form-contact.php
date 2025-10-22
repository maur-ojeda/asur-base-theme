<?php
$contact_page = get_page_by_path('contact');
if (!$contact_page) {
    return;
}
$page_id = $contact_page->ID;

$form_bg = carbon_get_post_meta($page_id, 'bg_imagen');
$form_title = carbon_get_post_meta($page_id, 'form_title');
$shortcode = carbon_get_post_meta($page_id, 'contact_shortcode');
$info_form_title = carbon_get_post_meta($page_id, 'info_form_title');
$info_form_content = carbon_get_post_meta($page_id, 'info_form_content');
$info_form_content_items = carbon_get_post_meta($page_id, 'info_form_content_item');
$info_contact_cards = carbon_get_post_meta($page_id, 'info_contact_cards');
?>




<div id="contact-section" class='container-fluid p-0'>
    <section class="hero-section" style="background-image: url('<?php echo ($form_bg); ?>">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <h1><?php echo ($info_form_title); ?></h1>
                        <p class="lead mb-10"><?php echo ($info_form_content); ?></p>
                        <div class="timeline-container">
                            <?php
                            if (!empty($info_form_content_items) && is_array($info_form_content_items)) :
                                foreach ($info_form_content_items as $info_form_content_item) :
                                    $title = $info_form_content_item['title'] ?? '';
                                    $text = $info_form_content_item['text'] ?? '';
                                    $icon = $info_form_content_item['icon'] ?? '';
                            ?>
                                    <div class="step-item">
                                        <div class="step-icon-wrapper">
                                            <i data-lucide="<?php echo ($icon); ?>" class="step-icon"></i>
                                        </div>
                                        <div class="step-text">
                                            <h5><?php echo ($title); ?></h5>
                                            <p><?php echo ($text); ?></p>
                                        </div>
                                    </div>
                            <?php endforeach;
                            endif;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6  d-lg-block pt-lg-20">
                    <div class="hero-content shadow-lg bg-white">
                        <h2 class="title mb-5"><?php echo ($form_title); ?></h2>
                        <?php echo do_shortcode($shortcode); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-info py-5 bg-light-gray mt-20 mb-20">
        <div class="container">
            <div class="row g-4">

                <?php
                if (!empty($info_contact_cards) && is_array($info_contact_cards)) :
                    foreach ($info_contact_cards as $info_contact_card) :
                        $title = $info_contact_card['title'] ?? '';
                        $text = $info_contact_card['text'] ?? '';
                        $icon = $info_contact_card['icon'] ?? '';
                        $image = $info_contact_card['image'] ?? '';


                ?>



                        <div class="col-md-4">
                            <div class="contact-card" style="background-image: url(<?php echo ($image); ?>)">
                                <div class="card-content">
                                    <i data-lucide="<?php echo ($icon); ?>" class="card-icon" style="width:32px; height:32px;"></i>
                                    <h5><?php echo ($title); ?></h5>
                                    <p><?php echo ($text); ?></p>
                                </div>
                            </div>
                        </div>

                <?php endforeach;
                endif;
                ?>


            </div>
        </div>
    </section>
</div>