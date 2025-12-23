<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('theme_options', 'Sección Proyectos')
    ->set_page_parent('cpt') 
    ->add_fields([
        Field::make('checkbox', 'projects_section_is_visible', 'Mostrar esta sección')
            ->set_option_value('yes')
            ->set_width(50)
            ->set_help_text('Marca esta casilla para que la sección sea visible en la página.'),
        Field::make('text', 'projects_section_tag', 'Etiqueta')
            ->set_default_value('Proyectos'),
        Field::make('text', 'projects_section_title', 'Título principal')
            ->set_default_value('Nuestros Proyectos'),
        Field::make('textarea', 'projects_section_description', 'Descripción')
            ->set_default_value('Valle de Colchagua, ideal para invertir, construir o simplemente perfeccionar...'),
    ]);
