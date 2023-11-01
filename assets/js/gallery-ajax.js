jQuery(function ($) {
  let page = 1;

  function fetchPhotos() {
    const category = $('#filter-category').val();
    const format = $('#filter-format').val();
    const sort = $('#filter-order').val();

    $('#load-more').text("Chargement...").prop("disabled", true);

    $.ajax({
      url: frontendajax.resturl,
      type: 'GET',
      headers: {
        'X-WP-Nonce': frontendajax.nonce
      },
      data: {
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
  }

  $('#filter-category, #filter-format, #filter-order').change(function () {
    page = 1;
    $('.gallery').empty();  // Vide la galerie
    fetchPhotos();
  });

  $('#load-more').click(function () {
    page++;
    fetchPhotos();
  });
});
