document.addEventListener('DOMContentLoaded', function (event) {
  init();
});

const init = () => {
  const starContainer = document.getElementById('starContainer');
  const stars = starContainer.querySelectorAll('.star');
  const ratingInput = document.getElementById('rating');

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

  stars.forEach((star) => {
    star.addEventListener('mouseover', highlightStars);
    star.addEventListener('mouseout', resetStars);
  });

  // check if there is a value in the rating input before submitting the form
   const form = document.querySelector('form');

   form.addEventListener('submit', (event) => {
       if (!ratingInput.value) {
           event.preventDefault(); // Prevent form submission
           alert("Please give a rating");
           // You can also add a message to your HTML instead of using alert
       }
   });
};


