<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="container py-3">
  <div class="d-flex justify-content-between align-items-center">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="text-decoration-none h4 m-0">
      <?php bloginfo('name'); ?>
    </a>

    <?php
      wp_nav_menu([
        'theme_location' => 'main_menu',
        'container' => 'nav',
        'container_class' => 'd-none d-md-block',
        'menu_class' => 'nav justify-content-end gap-3'
      ]);
    ?>
  </div>
</header>
