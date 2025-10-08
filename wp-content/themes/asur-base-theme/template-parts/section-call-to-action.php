<?php
$page_id = get_the_ID();
$selected_call_action = carbon_get_post_meta($page_id, 'selected_call_to_action');

if (empty($selected_call_action)) {
    return;
}

$selected_call_action_id = $selected_call_action[0]['id'];


$title   = get_the_title($selected_call_action_id);
$content = apply_filters('the_content', get_post_field('post_content', $selected_call_action_id));
$btnUrl  = carbon_get_post_meta($selected_call_action_id, 'cta_link');
$btnText = carbon_get_post_meta($selected_call_action_id, 'cta_link_text');
$icon    = 'arrow-right';
?>

<section class="call-to-action my-20 py-20">
  <div class="container">
    <div class="row">
      <div class="call-to-action-item">
        <h2 class="title" data-aos="fade-up" data-aos-delay="400"><?= esc_html($title); ?></h2>
        <p data-aos="fade-up" data-aos-delay="600"><?= esc_html(strip_tags($content)); ?></p>       
        <?php if ($btnUrl && $btnText): ?>  
          <a href="<?= esc_url($btnUrl); ?>" class="btn-krom" data-aos="fade-up" data-aos-delay="800">
            <?= esc_html($btnText); ?>
            <i data-lucide="<?= esc_attr($icon); ?>"></i>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>