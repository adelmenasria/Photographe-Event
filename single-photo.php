<?php

/**
 * The template for displaying all single photo
 *
 * @package WordPress
 * @subpackage Photographe Event
 * @since Photographe Event 1.0
 */

get_header()
?>

<!--Single-Photo-->
<main <?php post_class(array('single-photo-page', 'container')); ?>>
  <article class="single-photo">
    <section class="single-photo-wrapper">
      <div class="single-photo-content">
        <h1 class="single-photo-title"><?php the_title(); ?></h1>
        <div class="single-photo-infos">
          <span class="single-photo-txt" id="single-photo-category">Catégorie : <?php the_terms(get_the_ID(), 'photo_category', '', ', '); ?></span>
          <span class="single-photo-txt" id="single-photo-format">Format : <?php the_terms(get_the_ID(), 'photo_format', '', ', '); ?></span>
          <span class="single-photo-txt" id="single-photo-type">Type : <?php the_field('photo_type'); ?></span>
          <span class="single-photo-txt" id="single-photo-reference">Référence : <?php the_field('photo_reference'); ?></span>
          <time class="single-photo-txt" datetime="<?= get_the_date('Y-m-d'); ?>">Année : <?= get_the_date('Y'); ?></time>
        </div>
      </div>
      <figure class="single-photo-img">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="Photo individuelle" />
      </figure>
    </section>
    <div class="single-photo-footer">
      <p class="single-photo-footer-txt">Cette photo <span class="nowrap">vous intéresse ?</span></p>
      <button id="toggler-modal-single" class="btn">Contact</button>
      <?php get_template_part('template-parts/single-photo/photo_navigation') ?>
    </div>
  </article>
  <?php get_template_part('template-parts/single-photo/related_photos') ?>
</main>

<?php get_footer(); ?>