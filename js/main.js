// js/main.js
document.addEventListener('DOMContentLoaded', () => {
  // Mobile Menu Toggle Logic (Accordion)
  const mobileMenuBtn = document.getElementById('mobile-menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileLinks = document.querySelectorAll('.mobile-link');

  if (mobileMenuBtn && mobileMenu) {
    mobileMenuBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    mobileLinks.forEach(link => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  }

  // Navbar Scroll Effect
  const navbar = document.getElementById('navbar');
  if (navbar) {
    window.addEventListener('scroll', () => {
      if (window.scrollY > 50) {
        navbar.classList.add('bg-gray-900/90', 'shadow-lg');
        navbar.classList.remove('bg-gray-900/40');
      } else {
        navbar.classList.add('bg-gray-900/40');
        navbar.classList.remove('bg-gray-900/90', 'shadow-lg');
      }
    });
  }

  // Scroll Animation Observer
  const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.15
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target); // Optional: if we only want it to animate once
      }
    });
  }, observerOptions);

  const animatedElements = document.querySelectorAll('.animate-slide-up');
  animatedElements.forEach(el => observer.observe(el));
});
