<?php

// Plugin ContactForm7
add_filter('wpcf7_autop_or_not', '__return_false'); // Disable p tags

add_filter('wpcf7_form_elements', 'cf7_disable_span'); // Disable span tags
function cf7_disable_span($content) {
  $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);
  return $content;
}