// Menu toggle with smooth slide
document.addEventListener("DOMContentLoaded", function() {
  const btn = document.getElementById("menuToggle");
  const nav = document.querySelector(".nav");

  if (btn) {
    btn.addEventListener("click", function() {
      if (nav.style.display === "flex") {
        nav.style.height = nav.scrollHeight + "px"; // start animation
        requestAnimationFrame(() => {
          nav.style.height = "0px";
        });
        nav.addEventListener('transitionend', function hide() {
          nav.style.display = "none";
          nav.style.height = null;
          nav.removeEventListener('transitionend', hide);
        });
      } else {
        nav.style.display = "flex";
        nav.style.height = "0px";
        requestAnimationFrame(() => {
          nav.style.height = nav.scrollHeight + "px";
        });
        nav.addEventListener('transitionend', function reset() {
          nav.style.height = null;
          nav.removeEventListener('transitionend', reset);
        });
      }
    });
  }
});

// Confirm deletion
function confirmDelete() { 
  return confirm("Are you sure you want to delete this booking?"); 
}

// Inline message display instead of alert
function showMessage(msg, type = 'info') {
  const div = document.createElement('div');
  div.textContent = msg;
  div.className = `msg ${type}`;
  const main = document.querySelector('main');
  main.prepend(div);
  setTimeout(() => div.remove(), 4000);
}

// Booking form validation with inline hints
function validateBookingForm(event){
  const name = document.getElementById("guest_name").value.trim();
  const email = document.getElementById("email").value.trim();
  const checkin = document.getElementById("check_in_date").value;
  const checkout = document.getElementById("check_out_date").value;
  const paymentInput = document.getElementById("payment");
  const payment = paymentInput ? parseFloat(paymentInput.value) : 0;

  let valid = true;

  // Clear previous warnings
  document.querySelectorAll('.form-warning').forEach(w => w.remove());

  function showWarning(input, message) {
    const warn = document.createElement('small');
    warn.className = 'form-warning';
    warn.style.color = '#a02b2b';
    warn.textContent = message;
    input.parentNode.appendChild(warn);
    valid = false;
  }

  if(name.length < 2) showWarning(document.getElementById("guest_name"), "Enter a valid name");
  if(!/^\S+@\S+\.\S+$/.test(email)) showWarning(document.getElementById("email"), "Enter a valid email");
  if(!checkin || !checkout) showWarning(document.getElementById("check_in_date"), "Select check-in and check-out dates");
  if(checkin > checkout) showWarning(document.getElementById("check_out_date"), "Check-out must be after check-in");
  if(paymentInput && (isNaN(payment) || payment < 0)) showWarning(paymentInput, "Enter a valid payment in RM");

  return valid;
}

// Optional: prevent form submission with Enter key in inputs
document.querySelectorAll('form input').forEach(input => {
  input.addEventListener('keydown', e => {
    if(e.key === 'Enter') e.preventDefault();
  });
});
