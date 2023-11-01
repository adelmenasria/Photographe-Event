<div class="photo-navigation">
  <img class="photo-current-thumb" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?= get_the_title(); ?> thumbnail" />
  <nav class="photo-arrows">
    <div class="prev-photo">
      <?php
      $prev_post = get_adjacent_post(false, '', true); // Le 3ème paramètre true indique qu'on veut l'article précédent
      if ($prev_post): 
        $prev_link = get_permalink($prev_post->ID); // Récupère le lien de l'article précédent
      ?>
      <a href="<?= $prev_link; ?>" aria-label="Photo précédente"><img src="<?= get_stylesheet_directory_uri(); ?>/assets/img/arrow-left.png" alt="Photo précédente" /></a>
      <div id="prev-thumb" class="hover-thumb left"><?= get_the_post_thumbnail($prev_post->ID, 'thumbnail'); ?></div>
      <?php endif; ?>
    </div>
    <div class="next-photo">
      <?php
      $next_post = get_adjacent_post(false, '', false); // Le 3ème paramètre false indique qu'on veut l'article suivant
      if ($next_post): 
        $next_link = get_permalink($next_post->ID); // Récupère le lien de l'article précédent
      ?>
      <a href="<?= $next_link; ?>" aria-label="Photo suivante"><img src="<?= get_stylesheet_directory_uri(); ?>/assets/img/arrow-right.png" alt="Photo suivante" /></a>
      <div id="next-thumb" class="hover-thumb right"><?= get_the_post_thumbnail($next_post->ID, 'thumbnail'); ?></div>
      <?php endif; ?>
    </div>
  </nav>
</div>