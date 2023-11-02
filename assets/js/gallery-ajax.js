jQuery(function ($) { // On s'assure que jQuery est chargé
  let page = 1; // Initialisation de la variable de page à 1

  // Fonction pour charger les photos via AJAX
  function fetchPhotos() {
    // Récupération des valeurs actuelles des filtres
    const category = $('#filter-category').val();
    const format = $('#filter-format').val();
    const sort = $('#filter-order').val();

    // Mise à jour du texte du bouton et désactivation pendant le chargement
    $('#load-more').text("Chargement...").prop("disabled", true);

    // Exécution de la requête AJAX
    $.ajax({
      url: frontendajax.resturl, // URL du point de terminaison de l'API REST (définie en PHP et passée au JS)
      type: 'GET', // Type de la requête HTTP
      headers: {
        'X-WP-Nonce': frontendajax.nonce // Clé nonce pour la sécurité (définie en PHP et passée au JS)
      },
      data: {
        // Données envoyées avec la requête pour le filtrage et la pagination
        category: category,
        format: format,
        sort: sort,
        page: page
      },
      success: function (response) {
        // Fonction de callback en cas de succès
        if (response.trim() !== "" && !response.includes("Aucune photo trouvée")) {
          // Si la réponse n'est pas vide et ne contient pas le message "Aucune photo trouvée"
          $('.gallery').append(response); // On ajoute les nouvelles photos à la galerie
          $('#load-more').text("Charger plus").prop("disabled", false); // Réactivation du bouton
        } else {
          // Si la réponse est vide ou contient le message d'absence de photos
          $('#load-more').text("Aucune autre photo").prop("disabled", true); // Mise à jour du bouton pour indiquer la fin
        }
      }
    });
  }

  // Gestionnaire d'événement pour les changements de filtre
  $('#filter-category, #filter-format, #filter-order').change(function () {
    page = 1; // Réinitialisation à la première page
    $('.gallery').empty(); // Vidage de la galerie pour les nouveaux résultats filtrés
    fetchPhotos(); // Rechargement des photos avec les nouveaux filtres
  });

  // Gestionnaire d'événement pour le bouton de chargement de plus de photos
  $('#load-more').click(function () {
    page++; // Incrémentation de la variable de page pour charger la suite
    fetchPhotos(); // Rechargement des photos pour la nouvelle page
  });
});
