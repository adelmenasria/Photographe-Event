/*------------------------------------------*\
  Variables
\*------------------------------------------*/
const body = document.body;

/*------------------------------------------*\
  Header Menu Responsive
\*------------------------------------------*/
/**********
 * Cette fonction nous servira principalement à éviter le décalage provoqué par le overflow:hidden lorsque l'icone du menu hamburger est ouvert. 
 * En effet, lorsque le menu mobile est ouvert, la scrollbar disparaît et l'icone du hamburger subit ainsi un décallage indésirable en conséquance. 
 * Nous cherchons à obtenir la largeur de la scrollbar afin de pouvoir la resimuler lors de l'ouverture du menu, cela afin que l'icone du hamburger reste bien figée.
 ***********/
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

document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.getElementById("hamburger");
  const headerNav = document.getElementById("header-nav");
  const scrollbarWidth = getScrollbarWidth();

  hamburger.addEventListener("click", function () {
    // Toggle menu
    if (headerNav.style.display === "none" || headerNav.style.display === "") {
      headerNav.style.display = "flex";
      body.classList.add("no-scroll"); // Bloquer le scroll
      body.style.marginRight = scrollbarWidth + 'px'; // Compenser la largeur de la scrollbar
    } else {
      headerNav.style.display = "none";
      body.classList.remove("no-scroll"); // Réactiver le scroll
      body.style.marginRight = '0px'; // Retirer la compensation de la scrollbar
    }

    hamburger.classList.toggle("is-opened"); // Ajoute/retire la classe is-opened
  });

  // Resizing event (for reset some rules in responsive)
  window.addEventListener("resize", function () {
    if (window.innerWidth > 680) {
      headerNav.removeAttribute("style");
      hamburger.classList.remove("is-opened");
    }
  });
});

/*------------------------------------------*\
  Modal Header
\*------------------------------------------*/
const btnModalNav = document.querySelector(".toggler-modal-nav");
const modal = document.getElementById("modal");

// Open menu
btnModalNav.onclick = function () {
  modal.style.display = "flex";
  body.classList.add("no-scroll");
}

// Close menu
window.onclick = function (event) { // Using window.onclick to close the modal when clicking outside of it
  if (event.target == modal) {
    modal.style.display = "none";
    body.classList.remove("no-scroll");

    // Reset reference field when modal is closed
    const subjectField = document.querySelector('input[name="photo-ref"]');
    if (subjectField) {
      subjectField.value = '';
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
    const photoRefElement = document.getElementById('single-photo-reference'); // Retrieves the "reference" value of the photo
    if (photoRefElement) {
      const photoRef = photoRefElement.textContent.split(' : ')[1].trim();
      const subjectField = document.querySelector('input[name="photo-ref"]');
      if (subjectField) {
        subjectField.value = photoRef; // Assigning this value to the form field
      }
    }

    modal.style.display = "flex";
    body.classList.add("no-scroll");
  });
}