<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head() ?>
</head>

<body <?php body_class(); ?> id="post-<?php the_ID(); ?>">
  <!--Header-->
  <header class="header">
    <nav class="header-navbar">
      <?php if (function_exists('the_custom_logo')) {
        the_custom_logo();
      } ?>
      <button id="hamburger" class="hamburger" aria-controls="header-nav" aria-expanded="false" aria-label="Menu navigation">
        <span class="hamburger-icon"></span>
      </button>
      <nav id="header-nav" class="header-nav" role="navigation" aria-label="<?php __('Menu principal', 'PhotoEvent'); ?>">
        <?php
        wp_nav_menu([
          'theme_location' => 'header-menu',
          'menu_class'     => 'header-nav-list',
          'menu_id'        => 'header-nav-list',
          'container'      => false
        ]);
        ?>
      </nav>
    </nav>
  </header>