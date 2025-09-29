<?php get_header(); ?>



 <style>
        .custom-orange {
            color: #ff6347;
        }
        .bg-dark-gray {
            background-color: #2c3e50;
        }
        .card-download-links a {
            font-size: 0.875rem;
            color: #6c757d;
            text-decoration: none;
        }
        .card-download-links i {
            font-size: 1.25rem;
            color: #6c757d;
        }
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: invert(1);
        }
    </style>

   <style>
        .custom-bg-dark {
            background-color: #0b1f3f;
        }
        .custom-orange {
            color: #ff6347;
        }
        .form-container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 0.5rem;
        }
    </style>

    <main id="main-content">
        <?php get_template_part('template-parts/section', 'hero'); ?>
        
        <div class="container-krom">
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 0]); ?>
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 1]); ?>
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 2]); ?>
        </div>        
            <?php get_template_part('template-parts/section', 'category-showcase', ['index' => 0]); ?>
        <div class="container-krom">    
            <?php get_template_part('template-parts/section', 'call-to-action'); ?>
        </div>        
            <?php get_template_part('template-parts/section', 'category-showcase', ['index' => 1]); ?>
        <div class="container-krom">            
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 3]); ?>
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 4]); ?>        
        </div>
        <div class="container-krom">
            <?php get_template_part('template-parts/section', 'innovation-projects-carousel',  ['index' => 0]); ?>
            <?php get_template_part('template-parts/section', 'technological-solutions-carousel'); ?>
        </div>
        
        <?php get_template_part('template-parts/section', 'partners'); ?>
        <?php get_template_part('template-parts/section', 'form-home'); ?>    
    </main>

<?php get_footer(); ?>
