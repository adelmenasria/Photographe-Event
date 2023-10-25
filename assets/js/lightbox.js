jQuery(document).ready(function ($) {
  let currentImage;

  $(document).on('click', '.gallery-fullscreen', function (e) {
    e.preventDefault();

    currentImage = $(this).closest('.gallery-item');

    const imgSrc = $(this).data('src');
    const imgReference = $(this).data('reference'); // Récupère la référence
    const imgCategory = currentImage.find('.gallery-category').text();
    const imgTitle = currentImage.find('.gallery-title').text(); // Récupère le titre

    $('.lightbox .lightbox-content img').attr('src', imgSrc);
    $('.lightbox .lightbox-title').text(imgTitle); // Affiche le titre
    $('.lightbox .lightbox-reference').text(imgReference);
    $('.lightbox .lightbox-category').text(imgCategory);

    // Ajout de la classe pour empêcher le défilement et afficher la lightbox
    $('body').addClass('no-scroll');
    $('.lightbox').addClass('lightbox-visible');
  });

  $(document).on('click', '.lightbox-next', function () {
    let nextImage = currentImage.next('.gallery-item');
    if (!nextImage.length) {
      nextImage = $('.gallery-item').first();  // Si on est à la dernière image, on revient à la première
    }

    currentImage = nextImage;
    const nextLink = nextImage.find('.gallery-fullscreen');
    nextLink.click();

    // Réajustement de la classe pour empêcher le défilement
    $('body').removeClass('no-scroll').addClass('no-scroll');
  });

  $(document).on('click', '.lightbox-prev', function () {
    let prevImage = currentImage.prev('.gallery-item');
    if (!prevImage.length) {
      prevImage = $('.gallery-item').last();  // Si on est à la première image, on revient à la dernière
    }

    currentImage = prevImage;
    const prevLink = prevImage.find('.gallery-fullscreen');
    prevLink.click();

    // Réajustement de la classe pour empêcher le défilement
    $('body').removeClass('no-scroll').addClass('no-scroll');
  });

  $(document).on('click', '.lightbox-close', function () {
    $('.lightbox').removeClass('lightbox-visible');

    // Suppression de la classe pour permettre le défilement
    $('body').removeClass('no-scroll');
  });
});
