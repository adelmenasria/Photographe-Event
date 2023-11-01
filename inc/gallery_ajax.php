<?php

// Ajoutez l'action pour l'API REST
add_action('rest_api_init', 'pe_register_gallery_route');
// Fonction pour enregistrer la route
function pe_register_gallery_route() {
  register_rest_route('gallery/v1', '/photos/', array(
    'methods' => WP_REST_Server::READABLE,
    'callback' => 'pe_filter_photos_rest',
    'permission_callback' => '__return_true' // Tout le monde peut accéder à cette route
  ));
}


function pe_filter_photos_rest($request) {
  // Récupérer les données de la requête
  $page = isset($request['page']) ? absint($request['page']) : 1;

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
  if (!empty($request['category']) && $request['category'] != 'default-category') {
    $tax_queries[] = array(
      'taxonomy' => 'photo_category',
      'field' => 'slug',
      'terms' => $request['category']
    );
  }

  // Filtrage par format
  if (!empty($request['format']) && $request['format'] != 'default-format') {
    $tax_queries[] = array(
      'taxonomy' => 'photo_format',
      'field' => 'slug',
      'terms' => $request['format']
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
  if (!empty($request['sort']) && $request['sort'] != 'default-sort') {
    switch ($request['sort']) {
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
      get_template_part('template-parts/gallery/gallery_item');
    endwhile;
    wp_reset_postdata();
  endif;

  $response = ob_get_clean();  // Récupérer le contenu capturé

  // Retourner la réponse pour l'API REST
  return new WP_REST_Response($response, 200);
}
