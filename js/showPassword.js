const input = document.getElementById("password");
const openIcon = document.querySelector(".eye-open");
const closeIcon = document.querySelector(".eye-close");

closeIcon.addEventListener("click", function () {
  input.type = "text";

  this.style.display = "none";
  openIcon.style.display = "block";
});

openIcon.addEventListener("click", function () {
  input.type = "password";

  this.style.display = "none";
  closeIcon.style.display = "block";
});
