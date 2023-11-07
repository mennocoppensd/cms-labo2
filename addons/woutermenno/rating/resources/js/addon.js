document.addEventListener('DOMContentLoaded', function (event) {
  init();
});

const init = () => {
  const starContainer = document.getElementById('starContainer');
  const stars = starContainer.querySelectorAll('.star');
  const ratingInput = document.getElementById('rating');
  const entryId = document.querySelector('form').dataset.id; // Get the entry ID from the form's data attribute
  const form = document.querySelector('form');
  const feedbackMessage = document.getElementById('feedbackMessage');
  const submitButton = document.querySelector('button[type="submit"]');

  function highlightStars(event) {
      const mouseX = event.clientX;

      stars.forEach((star, index) => {
          const starX = star.getBoundingClientRect().left;

          if (mouseX >= starX) {
              star.classList.add('highlight');
          } else {
              star.classList.remove('highlight');
          }
      });
  }

  function resetStars() {
      stars.forEach((star, index) => {
          star.classList.remove('highlight');
          if (index > clickedIndex) {
              star.classList.remove('active');
          }
      });
  }

  let clickedIndex = -1;

  starContainer.addEventListener('click', (event) => {
      const clickedStar = event.target;
      if (clickedStar.classList.contains('star')) {
          resetStars();
          clickedIndex = Array.from(stars).indexOf(clickedStar);
          for (let i = 0; i <= clickedIndex; i++) {
              stars[i].classList.toggle('active', true);
          }

          // Update the rating input value
          const value = clickedStar.getAttribute('value');
          ratingInput.value = value;

          
      }
  });

  // disable the submit button if there is a localstorage already
  if (localStorage.getItem(`liked`)) {
      submitButton.disabled = true;
      feedbackMessage.innerText = 'You have already liked this entry.';

  }

  stars.forEach((star) => {
      star.addEventListener('mouseover', highlightStars);
      star.addEventListener('mouseout', resetStars);
  });

  form.addEventListener('submit', (event) => {
      if (!ratingInput.value) {
          event.preventDefault(); // Prevent form submission
          feedbackMessage.innerText = "Please give a rating";
      }
  });
};
