<?php

$hero_args = array(
  'post_type' => 'photo',
  'posts_per_page' => 1,
  'orderby' => 'rand',
  'tax_query' => array(
    array(
      'taxonomy' => 'photo_format',
      'field'    => 'slug',
      'terms'    => 'landscape',
    ),
  ),
);

$hero_query = new WP_Query($hero_args);

if ($hero_query->have_posts()) :
  $hero_query->the_post();
  $hero_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
endif;
wp_reset_postdata();

?>

<section class="hero" style="background-image: url('<?= esc_url($hero_image_url); ?>');">
  <h1 class="hero-title">Photographe Event</h1>
</section>