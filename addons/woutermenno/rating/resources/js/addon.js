document.addEventListener('DOMContentLoaded', function(event) {
  init();
});

const init = () => {
  const starContainer = document.getElementById('starContainer');
  const stars = starContainer.querySelectorAll('.star');

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
    }
  });

  stars.forEach((star) => {
    star.addEventListener('mouseover', highlightStars);
    star.addEventListener('mouseout', resetStars);
  });
};
