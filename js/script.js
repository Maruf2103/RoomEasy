document.addEventListener("DOMContentLoaded", function(){
  var btn = document.getElementById("menuToggle");
  if(btn) btn.addEventListener("click", function(){
    var nav = document.querySelector(".nav");
    if(nav.style.display === "flex") nav.style.display = "none";
    else nav.style.display = "flex";
  });
});
function confirmDelete(){ return confirm("Are you sure you want to delete this booking?"); }
function showMessage(msg){ alert(msg); }
function validateBookingForm(){
  var name = document.getElementById("guest_name").value.trim();
  var email = document.getElementById("email").value.trim();
  var checkin = document.getElementById("check_in_date").value;
  var checkout = document.getElementById("check_out_date").value;
  if(name.length < 2){ alert("Enter a valid name"); return false; }
  if(!/^\S+@\S+\.\S+$/.test(email)){ alert("Enter a valid email"); return false; }
  if(!checkin || !checkout){ alert("Select check-in and check-out dates"); return false; }
  if(checkin > checkout){ alert("Check-out must be after check-in"); return false; }
  return true;
}
