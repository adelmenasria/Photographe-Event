<?php

add_action('wp_ajax_filter_photos', 'pe_filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'pe_filter_photos');

function pe_filter_photos() {
  // Vérifie si le paramètre 'page' est défini. Si c'est la première fois, la valeur sera 1.
  $page = isset($_POST['page']) ? absint($_POST['page']) : 1;

  // Par défaut, nous voulons charger 8 photos et commencer depuis le début.
  $posts_count = 8;
  $offset = 0;

  // Si 'page' est défini et supérieur à 1, 
  // nous voulons seulement charger 4 photos à chaque fois.
  if ($page > 1) {
    $posts_count = 4;
    $offset = 8 + ($page - 2) * 4; // Calcul de l'offset en fonction du nombre de pages.
  }

  $args = array(
    'post_type' => 'photo',
    'posts_per_page' => $posts_count,
    'offset' => $offset
  );

  $tax_queries = array(); // Pour stocker toutes les requêtes taxonomiques

  // Filtrage par catégorie
  if (!empty($_POST['category']) && $_POST['category'] != 'default-category') {
    $tax_queries[] = array(
      'taxonomy' => 'photo_category',
      'field' => 'slug',
      'terms' => $_POST['category']
    );
  }

  // Filtrage par format
  if (!empty($_POST['format']) && $_POST['format'] != 'default-format') {
    $tax_queries[] = array(
      'taxonomy' => 'photo_format',
      'field' => 'slug',
      'terms' => $_POST['format']
    );
  }

  // Si on a plusieurs tax_queries, on les combine avec la relation 'AND'
  if (count($tax_queries) > 1) {
    $tax_queries['relation'] = 'AND';
  }

  if (!empty($tax_queries)) {
    $args['tax_query'] = $tax_queries;
  }

  // Tri des photos
  if (!empty($_POST['sort']) && $_POST['sort'] != 'default-sort') {
    switch ($_POST['sort']) {
      case 'new':
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
        break;
      case 'old':
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
        break;
    }
  }

  $photos_query = new WP_Query($args);

  ob_start();  // Commencer la capture de sortie

  if ($photos_query->have_posts()) :
    while ($photos_query->have_posts()) : $photos_query->the_post();
      get_template_part('template-parts/gallery_item');
    endwhile;
    wp_reset_postdata();
  endif;

  $response = ob_get_clean();  // Récupérer le contenu capturé
  echo $response;  // Echo pour renvoyer en tant que réponse AJAX

  die();
}
