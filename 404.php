<?php
/**
 * The template for displaying 404 pages (not found)
 * This template redirects to the homepage.
 */

// Redirigir a la página de inicio
wp_redirect(home_url(), 301); 
exit; 

?>