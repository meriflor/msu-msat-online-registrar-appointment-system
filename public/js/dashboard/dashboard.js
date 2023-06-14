const walkInRadio = document.getElementById('walk-in');
const gcashRadio = document.getElementById('gcash');
const walkInSect = document.getElementById('walk-in-sect');
const gcashSect = document.getElementById('gcash-sect');

walkInRadio.addEventListener('change', () => {
  if (walkInRadio.checked) {
    walkInSect.style.display = 'block';
    gcashSect.style.display = 'none';
  }
});

gcashRadio.addEventListener('change', () => {
  if (gcashRadio.checked) {
    gcashSect.style.display = 'block';
    walkInSect.style.display = 'none';
  }
});