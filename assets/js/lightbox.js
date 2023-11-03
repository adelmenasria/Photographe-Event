jQuery(document).ready(function ($) {
  let currentImage;

  $(document).on('click', '.gallery-fullscreen', function (e) {
    e.preventDefault(); // Empêche le comportement par défaut du lien

    currentImage = $(this).closest('.gallery-item'); // Récupère l'élément .gallery-item le plus proche de l'élément cliqué

    // Récupère les données de l'image et met à jour le contenu de la lightbox
    const imgSrc = $(this).data('src');
    const imgReference = $(this).data('reference'); // Récupère la référence
    const imgCategory = currentImage.find('.gallery-category').text();
    const imgTitle = currentImage.find('.gallery-title').text(); // Récupère le titre

    // Met à jour la source de l'image et les textes dans la lightbox
    $('.lightbox .lightbox-content img').attr('src', imgSrc);
    $('.lightbox .lightbox-title').text(imgTitle); // Affiche le titre
    $('.lightbox .lightbox-reference').text(imgReference);
    $('.lightbox .lightbox-category').text(imgCategory);

    $('body').addClass('no-scroll');
    // $('.lightbox').addClass('lightbox-visible');
    // Ajoute la classe 'fade-in' pour animer l'apparition de la lightbox
    $('.lightbox').addClass('fade-in').removeClass('fade-out').css('display', 'flex');
  });

  $(document).on('click', '.lightbox-next', function () {
    let nextImage = currentImage.next('.gallery-item');
    if (!nextImage.length) {
      nextImage = $('.gallery-item').first();  // Si on est à la dernière image, on revient à la première
    }

    currentImage = nextImage;
    const nextLink = nextImage.find('.gallery-fullscreen');
    nextLink.click();

    $('body').removeClass('no-scroll').addClass('no-scroll'); // Réajustement de la classe pour empêcher le défilement
  });

  $(document).on('click', '.lightbox-prev', function () {
    let prevImage = currentImage.prev('.gallery-item');
    if (!prevImage.length) {
      prevImage = $('.gallery-item').last();  // Si on est à la première image, on revient à la dernière
    }

    currentImage = prevImage;
    const prevLink = prevImage.find('.gallery-fullscreen');
    prevLink.click();

    $('body').removeClass('no-scroll').addClass('no-scroll'); // Réajustement de la classe pour empêcher le défilement
  });

  // Lors du clic sur le bouton pour fermer la lightbox
  $(document).on('click', '.lightbox-close', function () {
    $('.lightbox').removeClass('fade-in').addClass('fade-out');
    
    // Attend que l'animation de fade-out soit terminée avant de cacher la lightbox
    $('.lightbox').one('animationend', function() {
      $(this).css('display', 'none').removeClass('fade-out'); // Cacher la lightbox et nettoyer les classes d'animation
    });

    $('body').removeClass('no-scroll');
  });
});
