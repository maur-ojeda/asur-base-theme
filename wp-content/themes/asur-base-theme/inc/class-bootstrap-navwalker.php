<?php
if (! class_exists('Bootstrap_5_Walker_Nav_Menu')) {
    class Bootstrap_5_Walker_Nav_Menu extends Walker_Nav_Menu
    {
        private $current_item;
        private $dropdown_menu_alignment_values = [
            'dropdown-menu-start',
            'dropdown-menu-end',
            'dropdown-menu-sm-start',
            'dropdown-menu-sm-end',
            'dropdown-menu-md-start',
            'dropdown-menu-md-end',
            'dropdown-menu-lg-start',
            'dropdown-menu-lg-end',
            'dropdown-menu-xl-start',
            'dropdown-menu-xl-end',
            'dropdown-menu-xxl-start',
            'dropdown-menu-xxl-end'
        ];

        function start_lvl(&$output, $depth = 0, $args = null)
        {
            $indent = str_repeat("\t", $depth);
            $dropdown_menu_class = ['dropdown-menu'];

            foreach ($this->current_item->classes as $class) {
                if (in_array($class, $this->dropdown_menu_alignment_values)) {
                    $dropdown_menu_class[] = $class;
                }
            }

            // No añadimos "show" para mantener los dropdowns cerrados
            if ($depth > 0) {
                $dropdown_menu_class[] = 'dropdown-submenu';
            }

            $classes = implode(' ', $dropdown_menu_class);
            $output .= "\n$indent<ul class=\"$classes\">\n";
        }

        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
        {
            $this->current_item = $item;

            $classes = empty($item->classes) ? [] : (array) $item->classes;
            $is_dropdown = in_array('menu-item-has-children', $classes);

            // Detectar si el item es actual o ancestro
            $is_current_item = (bool) array_intersect($classes, [
                'current-menu-item',
                'current_page_item'
            ]);
            $is_current_ancestor = (bool) array_intersect($classes, [
                'current-menu-ancestor',
                'current-menu-parent',
                'current_page_parent',
                'current_page_ancestor'
            ]);
            $is_current = $is_current_item || $is_current_ancestor;

            // Clases del <li>
            $li_classes = ['nav-item'];
            if ($is_dropdown) {
                $li_classes[] = 'dropdown';
            }
            $output .= '<li class="' . esc_attr(implode(' ', $li_classes)) . '">';

            // Atributos del <a>
            $atts = [
                'href'  => ! empty($item->url) ? $item->url : '',
                'class' => 'nav-link'
            ];

            // Ajustes según nivel
            if ($depth > 0 && ! $is_dropdown) {
                $atts['class'] = 'dropdown-item';
            } elseif ($depth === 0 && $is_dropdown) {
                $atts['class'] .= ' dropdown-toggle no-caret';
                $atts['data-bs-toggle'] = 'dropdown';
                $atts['data-bs-auto-close'] = 'outside';
                $atts['aria-expanded'] = 'false'; // 👈 nunca se abre automáticamente
            } elseif ($depth > 0 && $is_dropdown) {
                $atts['class'] = 'dropdown-item dropdown-toggle';
            }

            // 🔹 Solo marcamos el enlace activo, sin abrir dropdown
            if ($is_current) {
                $atts['class'] .= ' active';
            }

            if ($is_current_item) {
                $atts['aria-current'] = 'page';
            }

            $title = apply_filters('the_title', $item->title, $item->ID);

            // Íconos de Lucide (o SVGs)
            if ($depth === 0 && $is_dropdown) {
                $title .= ' <i data-lucide="chevron-down" class="fs-xs"></i>';
            } elseif ($depth > 0) {
                $title = '<i data-lucide="chevron-right" class="fs-xs"></i> ' . $title;
            }

            $item_output  = $args->before;
            $item_output .= '<a' . self::build_atts_string($atts) . '>';
            $item_output .= $args->link_before . $title . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }

        private static function build_atts_string($atts)
        {
            $str = '';
            foreach ($atts as $key => $value) {
                if ($value !== null && $value !== '') {
                    $str .= ' ' . $key . '="' . esc_attr($value) . '"';
                }
            }
            return $str;
        }
    }
}
