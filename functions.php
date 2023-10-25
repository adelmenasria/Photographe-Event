<?php

// Enqueueing (styles & scripts)
add_action('wp_enqueue_scripts', 'pe_enqueue_assets');
function pe_enqueue_assets() {
  $css_path = get_template_directory() . '/assets/css/main.css';
  $js_path = get_template_directory() . '/assets/js/main.js';
  $filters_path = get_template_directory() . '/assets/js/gallery-ajax.js';
  $lightbox_path = get_template_directory() . '/assets/js/lightbox.js';
  
  wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime($css_path));
  wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), filemtime($js_path), true);
  wp_enqueue_script('gallery-ajax', get_template_directory_uri() . '/assets/js/gallery-ajax.js', array('jquery'), filemtime($filters_path), true);
  wp_localize_script('gallery-ajax', 'frontendajax', array('ajaxurl' => admin_url('admin-ajax.php')));   // Passez l'URL AJAX de WordPress au script
  wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), filemtime($lightbox_path), true);
}

// Menus
add_action('init', 'pe_register_menus');
function pe_register_menus() {
  register_nav_menus([
    'header-menu' => __('Menu En-tête', 'PhotographeEvent'),
    'footer-menu' => __('Menu Pied de Page', 'PhotographeEvent')
  ]);
}

// Supports WP
add_action('after_setup_theme', 'pe_supports');
function pe_supports() {
  add_theme_support('custom-logo');
  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');
  add_theme_support('menus');
}

// Add a custom menu-item in footer
add_filter('wp_nav_menu_items', 'pe_add_footer_menu_item', 10, 2);
function pe_add_footer_menu_item($items, $args) {
  if ($args->theme_location == 'footer-menu') {
    $items .= '<li class="menu-item-mention">Tous droits réservés</li>';
  }
  return $items;
}

// Plugin ContactForm7
add_filter('wpcf7_autop_or_not', '__return_false'); // Disable p tags

add_filter('wpcf7_form_elements', 'cf7_disable_span'); // Disable span tags
function cf7_disable_span($content) {
  $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
  return $content;
}

// Traitement de la requête Ajax (Gallery filters & pagination)
require_once get_template_directory() . '/inc/gallery-ajax.php';