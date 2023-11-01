<aside class="related-photos">
  <h2 class="related-photos-title">Vous aimerez aussi</h2>
  <div class="gallery">
    <?php
    $categories = get_the_terms(get_the_ID(), 'photo_category');
    $category_ids = $categories ? wp_list_pluck($categories, 'term_id') : array();

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

    if ($photos_query->have_posts()) :
      while ($photos_query->have_posts()) : $photos_query->the_post();
        get_template_part('template-parts/gallery/gallery_item');
      endwhile;
      wp_reset_postdata();
    else :
      echo "<p>Aucune photo apparentée n'est disponible pour le moment.</p>";
    endif;
    ?>
  </div>

  <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn--related-photos" role="button" aria-label="Voir toutes les photos">Toutes les photos</a>
</aside>