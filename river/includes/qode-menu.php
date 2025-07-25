<?php

if ( ! function_exists( 'river_qode_add_custom_nav_fields' ) ) {
	function river_qode_add_custom_nav_fields( $menu_item ) {
		$menu_item->anchor    = get_post_meta( $menu_item->ID, '_menu_item_anchor', true );
		$menu_item->nolink    = get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
		$menu_item->hide      = get_post_meta( $menu_item->ID, '_menu_item_hide', true );
		$menu_item->type_menu = get_post_meta( $menu_item->ID, '_menu_item_type_menu', true );
		$menu_item->icon      = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		$menu_item->sidebar   = get_post_meta( $menu_item->ID, '_menu_item_sidebar', true );
		
		return $menu_item;
	}
	
	// add custom menu fields to menu
	add_filter( 'wp_setup_nav_menu_item', 'river_qode_add_custom_nav_fields' );
}

if ( ! function_exists( 'river_qode_update_custom_nav_fields' ) ) {
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	 */
	function river_qode_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
		$check = array( 'anchor', 'nolink', 'hide', 'type_menu', 'icon', 'sidebar' );
		
		foreach ( $check as $key ) {
			if ( ! isset( $_POST[ 'menu-item-' . $key ][ $menu_item_db_id ] ) ) {
				$_POST[ 'menu-item-' . $key ][ $menu_item_db_id ] = "";
			}
			
			$value = $_POST[ 'menu-item-' . $key ][ $menu_item_db_id ];
			update_post_meta( $menu_item_db_id, '_menu_item_' . $key, $value );
		}
		
	}
	
	// save menu custom fields
	add_action( 'wp_update_nav_menu_item', 'river_qode_update_custom_nav_fields', 10, 3 );
}

if ( ! function_exists( 'river_qode_edit_walker' ) ) {
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	 */
	function river_qode_edit_walker( $walker, $menu_id ) {
		return 'Walker_Nav_Menu_Edit_Custom';
	}
	
	// edit menu walker
	add_filter( 'wp_edit_nav_menu_walker', 'river_qode_edit_walker', 10, 2 );
}

include_once QODE_INCLUDES_ROOT_DIR . '/qode-edit-custom-walker.php';

/* Custom WP_NAV_MENU function for top navigation */

if ( ! class_exists( 'river_qode_type1_walker_nav_menu' ) ) {
	class river_qode_type1_walker_nav_menu extends Walker_Nav_Menu {
		
		// add classes to ul sub-menus
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}
			
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
		
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			
			if ( $depth == 0 ) {
				$out_div = '<div class="second"><div class="inner">';
			} else {
				$out_div = '';
			}
			
			// build html
			$output .= "\n" . $indent . $out_div . '<ul>' . "\n";
		}
		
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			
			if ( $depth == 0 ) {
				$out_div_close = '</div></div>';
			} else {
				$out_div_close = '';
			}
			
			$output .= "$indent</ul>" . $out_div_close . "\n";
		}

		// add main/sub classes to li's and links
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $qode_options_river;
			$sub = "";
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
			if($depth==0 && $args->has_children) : 
				$sub = ' has_sub';
			endif;
			if($depth==1 && $args->has_children) : 
				$sub = 'sub';
			endif;
			
			
			$active = "";
			
			// depth dependent classes
			if ((($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0)) && ($qode_options_river['page_transitions'] == "0")):
				
					$active = 'active';
				
			endif;
		
			
			// passed classes
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
			
			//menu type class
			$menu_type = "";
			if($depth==0){
				if($item->type_menu == "wide"){
					$menu_type = " wide";
				}elseif($item->type_menu == "wide_icons"){
					$menu_type = " wide icons";
				}else{
					$menu_type = " narrow";
				}
			}
			
			$anchor = '';
			if($item->anchor != ""){
				$anchor = '#'.esc_attr($item->anchor);
			}
			
			// build html
			$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub . $menu_type .'">';
			
			$current_a = "";
			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ' href="'   . esc_attr( $item->url        ) .$anchor.'"';
			if (($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0) ):
			$current_a .= ' current ';
			endif;
			$no_link_class = '';
			if($item->nolink != '') {
				$no_link_class = ' no_link';
			}
			
			$attributes .= ' class="'. $current_a .$no_link_class.'"';
			$item_output = $args->before;
			if($item->hide == ""){
				if($item->nolink == ""){
					$item_output .= '<a'. $attributes .'>';
				} else{
					$item_output .= '<a'. $attributes .' style="cursor: default;" onclick="JavaScript: return false;">';
				}
				if($item->icon != ""){$icon = $item->icon; } else{ $icon = "blank"; }
				$item_output .= '<i class="menu_icon '.$icon.'"></i>';
				$item_output .= '<span>'.apply_filters( 'the_title', $item->title, $item->ID ).'</span>';
				$item_output .= '</a>';
			}
			
			if($item->sidebar != "" && $depth > 0){
				ob_start();
				dynamic_sidebar($item->sidebar);
				$sidebar_content = ob_get_contents();
				ob_end_clean();
				$item_output .= $sidebar_content;
			}
			
			
			$item_output .= $args->after;
			
		
			
			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

/* Custom WP_NAV_MENU function for mobile navigation */

if ( ! class_exists( 'river_qode_type2_walker_nav_menu' ) ) {
	class river_qode_type2_walker_nav_menu extends Walker_Nav_Menu {
		
		// add classes to ul sub-menus
		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}
			
			return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}
		
		function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			
			// build html
			$output .= "\n" . $indent . '<ul class="sub_menu">' . "\n";
		}
		
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat( "\t", $depth );
			
			$output .= "$indent</ul>" . "\n";
		}

		// add main/sub classes to li's and links
		 function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			global $qode_options_river;
			$sub = "";
			$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
			if($depth >=0 && $args->has_children) : 
				$sub = ' has_sub';
			endif;
			
			$active = "";
			
			// depth dependent classes
			if ((($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0)) && ($qode_options_river['page_transitions'] == "0")):
				
					$active = 'active';
				
			endif;
		
			
			// passed classes
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
			
			$anchor = '';
			if($item->anchor != ""){
				$anchor = '#'.esc_attr($item->anchor);
			}
			
			// build html
			$output .= $indent . '<li id="mobile-menu-item-'. $item->ID . '" class="' . $class_names . ' ' . $active . $sub .'">';
			
			$current_a = "";
			// link attributes
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ' href="'   . esc_attr( $item->url        ) .$anchor.'"';
			if (($item->current && $depth == 0) ||  ($item->current_item_ancestor && $depth == 0) ):
			$current_a .= ' current ';
			endif;
			
			$attributes .= ' class="'. $current_a . '"';
			$item_output = $args->before;
			if($item->hide == ""){
				if($item->nolink == ""){
					$item_output .= '<a'. $attributes .'>';
				}else{
					$item_output .= '<h3>';
				}
				$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= $args->link_after;
				if($item->nolink == ""){
					$item_output .= '<span class="mobile_arrow"><i class="icon-angle-right"></i><i class="icon-angle-down"></i></span></a>';
				}else{
					$item_output .= '<span class="mobile_arrow"><i class="icon-angle-right"></i><i class="icon-angle-down"></i></span></h3>';
				}
			}
			$item_output .= $args->after;
			
			// build html
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
		
	}
}
