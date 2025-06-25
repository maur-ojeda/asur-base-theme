import * as bootstrap from 'bootstrap';
import { createIcons, icons } from 'lucide';
import AOS from 'aos';
import { CountUp } from 'countup.js';



document.addEventListener('DOMContentLoaded', () => {
  // Crear los íconos
  createIcons({ icons });

  // Inicializar AOS
  AOS.init({
    duration: 800,
    once: true,
  });

  // Manejar scroll para navbar
  const navbar = document.querySelector('.navbar');

  const onScroll = () => {
    if (window.scrollY > 50) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }
  };


  window.addEventListener('scroll', onScroll);
  onScroll();



   const counters = document.querySelectorAll('.counter');

  const startCount = (el) => {
    const target = parseInt(el.getAttribute('data-target'), 10);
    const countUp = new CountUp(el, target, {
      duration: 2, // segundos
      separator: '.', // para miles
    });
    if (!countUp.error) {
      countUp.start();
    } else {
      console.error(countUp.error);
    }
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startCount(entry.target);
        observer.unobserve(entry.target); 
      }
    });
  }, {
    threshold: 0.6
  });

  counters.forEach(counter => {
    observer.observe(counter);
  });
  
});

console.log('App JS loaded');
