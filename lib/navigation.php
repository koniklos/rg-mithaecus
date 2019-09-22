<?php

function _themename_register_menus() {
	register_nav_menus(array(
		'main-menu' 	=> esc_html__( 'Main Menu', '_themename' ),
		'footer-menu' => esc_html__( 'Footer Menu', '_themename' )
	));
}

add_action( 'init', '_themename_register_menus' );


class _themename_primary_navigation extends Walker_Nav_Menu {

	function _themename_dropdown_icon( $args, $depth ) {
		if ( $args->walker->has_children ) {
			$direction = $depth == 0 ? 'down' : 'right';
	
			return '<button class="btn menu-button" aria-label="Open"><span class="btn__content" tabindex="-1"><svg class="icon icon--xsmall menu-button__icon"><use xlink:href="#icon-angle-' . $direction . '" /></svg></span></button></a>';
		}
	
		return '</a>';
		// ( $args->walker->has_children ) ? '<button class="menu-button"><i class="fa fa-arrow-down"></i></button></a>' : '</a>'
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat( "\t", $depth );
		$submenu = ( $depth > 0 ) ? ' sub-menu' : '';
		$output .= "\n" . $indent . '<ul class="sub-menu' . $submenu . ' sub-menu__depth-' . $depth . '">' . "\n";

	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$li_attributes = '';
		$li_class_names = $values = '';
		$link_classes = array( 'menu-link' );
		
		$li_classes[] = empty( $item->classes ) ? array() : (array) $item->classes;
		$li_classes[] = ( $depth ) ? 'menu-item__sub-menu-item menu-item__sub-menu-item__depth-' . $depth : 'menu-item__top-level';
		$li_classes[] = ( $item->current ||  $item->current_item_ancestor ) ? 'active' : '';
		$li_classes[] = 'menu-item-' . $item->ID;

		if ( $args->walker->has_children ) {
			
			if ( $depth ) {
				$li_classes[] = 'menu-item__sub-menu-dropdown';
			} else {
				$li_classes[] = !in_array('mega', $item->classes) ? 'menu-item__dropdown-simple' : 'menu-item__dropdown-mega';
			}

			$li_classes[] = 'menu-item__dropdown';
			$link_classes[] = 'menu-link__dropdown';
			
			$li_attributes .= 'aria-haspopup="true"';
			$li_attributes .= 'aria-expanded="false"';
		}

		$li_class_names = apply_filters( 'nav_menu_css_class', array_filter( $li_classes ), $item, $args );
		$li_class_names = join( ' ', _themename_array_flatten($li_class_names) );
		$li_class_names = 'class="' . esc_attr( $li_class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = 'id="' . esc_attr( $id ) . '"';

		$output .= $indent . '<li ' . $id . $values . $li_class_names . $li_attributes . '>';

		$link_classes[] = ( $depth ) ? 'menu-link__sub-menu' : 'menu-link__top-level';


		$attributes  = !empty( $item->attr_title ) ? 'title="' . $item->attr_title . '"' : '';
		$attributes .= !empty( $item->target ) ? 'target="' . $item->target . '"' : '';
		$attributes .= !empty( $item->xfn ) ? 'rel="' . $item->xfn . '"' : '';
		$attributes .= !empty( $item->url ) ? 'href="' . $item->url . '"' : '';
		$attributes .= 'class="' . join(' ', $link_classes) . '"';

		$menu_items  = $args->before;
		$menu_items .= '<a ' . $attributes . '>';
		$menu_items .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID );

		$menu_items .= $args->link_after . $this->_themename_dropdown_icon($args, $depth);
		$menu_items .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $menu_items, $item, $depth, $args );
	}
	
	// function end_el(&$output, $item, $depth = 0, $args = array()) {}
	
	// function end_lvl(&$output, $depth = 0, $args = array()) {}
}

