import * as bootstrap from 'bootstrap';
import { createIcons, icons } from 'lucide';
import AOS from 'aos';



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
});

console.log('App JS loaded');
