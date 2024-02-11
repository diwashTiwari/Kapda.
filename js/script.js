const navToggler = document.querySelector(".nav-toggler");
const navMenu = document.querySelector(".navbar-content ul");
const navLinks = document.querySelectorAll(".navbar-content a");

const allEventListners = () =>
  navToggler.addEventListener("click", togglerClick);

const togglerClick = () => {
  navToggler.classList.toggle("toggler-open");
  navMenu.classList.toggle("open");
};

allEventListners();
