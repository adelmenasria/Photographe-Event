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
  wp_enqueue_script('lightbox', get_template_directory_uri() . '/assets/js/lightbox.js', array('jquery'), filemtime($lightbox_path), true);
  
  //  wp_localize_script() est un moyen efficace et propre de passer des données de PHP à JavaScript dans WP.
  wp_localize_script('gallery-ajax', 'frontendajax', array(
    'resturl' => esc_url_raw(rest_url('gallery/v1/photos/')),
    'nonce' => wp_create_nonce('wp_rest')
  ));
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

// Includes
require_once get_template_directory() . '/inc/plugins_tweaks.php'; // Modifications du comportement de certains plugins (CF7)
require_once get_template_directory() . '/inc/gallery_ajax.php'; // Traitement de la requête Ajax (Gallery filters & pagination)
