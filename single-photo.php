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
          <time class="single-photo-txt" datetime="<?= get_the_date('Y-m-d'); ?>">Année : <?php echo get_the_date('Y'); ?></time>
        </div>
      </div>
      <figure class="single-photo-img">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="Photo individuelle" />
      </figure>
    </section>
    <div class="single-photo-footer">
      <p class="single-photo-footer-txt">Cette photo vous intéresse ?</p>
      <button id="toggler-modal-single" class="btn">Contact</button>
      <?php get_template_part('template-parts/photo_navigation') ?>
    </div>
  </article>
  <aside class="related-photos">
    <h2 class="related-photos-title">Vous aimerez aussi</h2>
    <?php
    $categories = get_the_terms(get_the_ID(), 'photo_category');
    $category_ids = array();

    if ($categories) {
      $category_ids = array_map(function ($category) {
        return $category->term_id;
      }, $categories);
    }

    $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 2,
      'tax_query' => array(
        array(
          'taxonomy' => 'photo_category',
          'field' => 'term_id',
          'terms' => $category_ids,
        )
      ),
      'post__not_in' => array(get_the_ID())
    );

    $photos_query = new WP_Query($args);
    ?>

    <?php if ($photos_query->have_posts()) : ?>
      <div class="gallery">
        <?php while ($photos_query->have_posts()) : $photos_query->the_post(); ?>
          <?php get_template_part('template-parts/gallery_item'); ?>
        <?php endwhile; wp_reset_postdata(); ?>
      </div>
    <?php else : ?>
      <p>Aucune photo apparentée n'est disponible pour le moment.</p>
    <?php endif; ?>

    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn view-all-photos flex-center">Toutes les photos</a>
  </aside>
</main>

<?php get_footer(); ?>