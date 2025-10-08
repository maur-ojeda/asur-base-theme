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

 

    <main id="main-content">
        <?php get_template_part('template-parts/section', 'hero'); ?>
        
        
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 0]); ?>
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 1]); ?>
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 2]); ?>
        
            <?php get_template_part('template-parts/section', 'category-showcase', ['index' => 0]); ?>
        
            <?php get_template_part('template-parts/section', 'call-to-action'); ?>
        
            <?php get_template_part('template-parts/section', 'category-showcase', ['index' => 1]); ?>
        
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 3]); ?>
            <?php get_template_part('template-parts/section', 'info-block', ['index' => 4]); ?>        
        
        
            <?php get_template_part('template-parts/section', 'innovation-projects-carousel',  ['index' => 0]); ?>
            <?php get_template_part('template-parts/section', 'technological-solutions-carousel'); ?>
        
        
        <?php get_template_part('template-parts/section', 'partners'); ?>
        <?php get_template_part('template-parts/section', 'form-home'); ?>    
    </main>

<?php get_footer(); ?>
