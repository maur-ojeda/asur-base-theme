<?php
class Bootstrap_5_Walker_Nav_Menu extends Walker_Nav_menu {
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

    function start_lvl(&$output, $depth = 0, $args = null) {
        $dropdown_menu_class = ['dropdown-menu'];

        foreach ($this->current_item->classes as $class) {
            if (in_array($class, $this->dropdown_menu_alignment_values)) {
                $dropdown_menu_class[] = $class;
            }
        }

        $indent = str_repeat("\t", $depth);
        $classes = implode(' ', $dropdown_menu_class);
        $output .= "\n$indent<ul class=\"$classes\" aria-labelledby=\"dropdownMenu{$this->current_item->ID}\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $this->current_item = $item;

        $classes = empty($item->classes) ? [] : (array)$item->classes;
        $classes[] = 'nav-item';

        $is_dropdown = in_array('menu-item-has-children', $classes);
        if ($is_dropdown) {
            $classes[] = 'dropdown';
        }

        $class_names = join(' ', array_filter($classes));
        $class_names = ' class="' . esc_attr($class_names) . '"';

        $output .= "<li$class_names>";

        $atts = [
            'title'  => !empty($item->attr_title) ? $item->attr_title : '',
            'target' => !empty($item->target)     ? $item->target     : '',
            'rel'    => !empty($item->xfn)        ? $item->xfn        : '',
            'href'   => !empty($item->url)        ? $item->url        : '',
        ];

        $atts['class'] = $is_dropdown ? 'nav-link dropdown-toggle' : 'nav-link';
        if ($is_dropdown) {
            $atts['data-bs-toggle'] = 'dropdown';
            $atts['aria-expanded'] = 'false';
            $atts['id'] = 'dropdownMenu' . $item->ID;
            $atts['role'] = 'button';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = esc_attr($value);
                $attributes .= " $attr=\"$value\"";
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $item_output = $args->before;
        $item_output .= "<a$attributes>";
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= $item_output;
    }
}
