document.addEventListener('DOMContentLoaded', function(event) {
  init();
});

const init = () => {
const btn = document.querySelector('button');

btn.onclick = function() {
  alert('Hello world');
};
};

