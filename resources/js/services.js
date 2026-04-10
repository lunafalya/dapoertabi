// Dropdown toggle
document.getElementById("profile-icon").addEventListener("click", () => {
  document.getElementById("dropdown-menu").classList.toggle("show");
});

window.addEventListener("click", (e) => {
  if (!e.target.matches('#profile-icon')) {
    const dropdown = document.getElementById("dropdown-menu");
    if (dropdown.classList.contains('show')) {
      dropdown.classList.remove('show');
    }
  }
});

// Reveal animation
function reveal() {
  const reveals = document.querySelectorAll(".reveal");
  for (let i = 0; i < reveals.length; i++) {
    const windowHeight = window.innerHeight;
    const elementTop = reveals[i].getBoundingClientRect().top;
    const revealPoint = 100;

    if (elementTop < windowHeight - revealPoint) {
      reveals[i].classList.add("active");
    }
  }
}

window.addEventListener("scroll", reveal);
window.addEventListener("load", reveal);
