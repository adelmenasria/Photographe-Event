/*------------------------------------------*\
  Variables
\*------------------------------------------*/
const body = document.body;

/*------------------------------------------*\
  Header Menu Mobile
\*------------------------------------------*/
function getScrollbarWidth() {
  const outer = document.createElement('div');
  outer.style.visibility = 'hidden';
  outer.style.overflow = 'scroll';
  document.body.appendChild(outer);

  const inner = document.createElement('div');
  outer.appendChild(inner);

  const scrollbarWidth = outer.offsetWidth - inner.offsetWidth;

  outer.parentNode.removeChild(outer);

  return scrollbarWidth;
}
/**
 * Cette fonction nous sert à éviter le décalage provoqué par le bloquage du scroll (overflow:hidden) lorsque l'icone de menu burger est ouvert.
 * En effet, lorsque le menu mobile est ouvert, la scrollbar disparaît et l'icone burger subit un décallage indésirable en conséquance.
 * Nous cherchons à obtenir la largeur de la scrollbar afin de pouvoir la resimuler lors de l'ouverture du menu, afin que l'icone du burger reste bien figée.
 **/

document.addEventListener("DOMContentLoaded", function () {
  const burger = document.getElementById("btn-menu-mobile");
  const menu = document.getElementById("header-nav");
  const scrollbarWidth = getScrollbarWidth();

  burger.addEventListener("click", function () {
    const isExpanded = burger.getAttribute('aria-expanded') === 'true'; // vérifier l'état actuel

    // Toggle menu
    if (!isExpanded) { // Si le menu est fermé, on l'ouvre
      menu.style.display = "flex";
      body.classList.add("no-scroll"); // Bloquer le scroll
      body.style.marginRight = scrollbarWidth + 'px'; // Compenser la largeur de la scrollbar
      burger.setAttribute('aria-expanded', 'true'); // Mettre à jour l'attribut aria-expanded
    } else { // Si le menu est ouvert, on le ferme
      menu.style.display = "none";
      body.classList.remove("no-scroll"); // Réactiver le scroll
      body.style.marginRight = '0px'; // Retirer la compensation de la scrollbar
      burger.setAttribute('aria-expanded', 'false'); // Mettre à jour l'attribut aria-expanded
    }

    burger.classList.toggle("is-cross"); // Ajoute/retire la classe is-cross pour transformer l'icone burger en croix
  });

  // Resizing event (reset)
  window.addEventListener("resize", function () {
    if (window.innerWidth > 680) {
      menu.removeAttribute("style");
      burger.classList.remove("is-cross");
      burger.setAttribute('aria-expanded', 'false'); // Réinitialisez l'attribut aria-expanded lors du redimensionnement
    }
  });
});

/*------------------------------------------*\
  Modal Header
\*------------------------------------------*/
const btnModalNav = document.querySelector(".toggler-modal-nav");
const modal = document.getElementById("modal");

// Open modal with fade-in effect
btnModalNav.onclick = function () {
  modal.classList.add('fade-in');
  modal.style.display = "flex";
  body.classList.add("no-scroll");
}

// Close modal with fade-out effect
window.onclick = function (event) {
  if (event.target == modal) {
    modal.classList.replace('fade-in', 'fade-out');

    // Wait for the animation to finish before hiding the modal
    modal.addEventListener('animationend', function() {
      modal.style.display = "none";
      modal.classList.remove('fade-out'); // Remove the class so it can be re-added next time the modal opens
      body.classList.remove("no-scroll");
    }, { once: true }); // The { once: true } option auto-removes the event listener after it's called

    // Reset reference field when modal is closed
    const refField = document.querySelector('input[name="photo-ref"]');
    if (refField) {
      refField.value = '';
    }
  }
}


/*------------------------------------------*\
  Modal Single Photo (référence)
\*------------------------------------------*/
const btnModalSingle = document.getElementById('toggler-modal-single');

// On s'assure que le bouton a bien été trouvé sur la page avant d'ajouter un gestionnaire d'événements.
if (btnModalSingle) {
  btnModalSingle.addEventListener('click', function () {
    const refElement = document.getElementById('single-photo-reference'); // Retrieves the "reference" value of the photo
    if (refElement) {
      const photoRef = refElement.textContent.split(' : ')[1].trim();
      const refField = document.querySelector('input[name="photo-ref"]');
      if (refField) {
        refField.value = photoRef; // Assigning this value to the form field
      }
    }

    modal.classList.add('fade-in');
    modal.style.display = "flex";
    body.classList.add("no-scroll");
  });
}
