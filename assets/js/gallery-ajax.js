jQuery(function ($) {
  let page = 1;  // Pagination initiale

  $('#filter-category, #filter-format, #filter-order').change(function () {
    page = 1;  // Réinitialisation de la pagination lors du changement de filtre

    const category = $('#filter-category').val();
    const format = $('#filter-format').val();
    const sort = $('#filter-order').val();

    $('#load-more').text("Chargement...").prop("disabled", true);

    $.ajax({
      url: frontendajax.ajaxurl,
      type: 'POST',
      data: {
        action: 'filter_photos',
        category: category,
        format: format,
        sort: sort
      },
      success: function (response) {
        $('.gallery').html(response);

        // Réactiver le bouton "Charger plus" s'il y a une réponse
        if (response.trim() !== "") {
          $('#load-more').text("Charger plus").prop("disabled", false);
        } else {
          $('#load-more').text("Aucune photo trouvée").prop("disabled", true);
        }

        return false;
      }
    });
  });

  $('#load-more').click(function () {
    const category = $('#filter-category').val();
    const format = $('#filter-format').val();
    const sort = $('#filter-order').val();

    $('#load-more').text("Chargement...").prop("disabled", true);

    // Incrémentation pour charger les prochaines photos
    page++;

    $.ajax({
      url: frontendajax.ajaxurl,
      type: 'POST',
      data: {
        action: 'filter_photos',
        category: category,
        format: format,
        sort: sort,
        page: page
      },
      success: function (response) {
        if (response.trim() !== "" && !response.includes("Aucune photo trouvée")) {
          $('.gallery').append(response);
          $('#load-more').text("Charger plus").prop("disabled", false);
        } else {
          $('#load-more').text("Aucune autre photo").prop("disabled", true);
        }
      }
    });
  });
});
