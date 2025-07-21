<?php

if ( ! function_exists( 'river_qode_add_theme_version_class' ) ) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function river_qode_add_theme_version_class( $classes ) {
		$current_theme = wp_get_theme();
		$theme_prefix  = 'river';
		
		//is child theme activated?
		if ( $current_theme->parent() ) {
			//add child theme version
			$classes[] = $theme_prefix . '-child-theme-ver-' . $current_theme->get( 'Version' );
			
			//get parent theme
			$current_theme = $current_theme->parent();
		}
		
		if ( $current_theme->exists() && $current_theme->get( 'Version' ) != "" ) {
			$classes[] = $theme_prefix . '-theme-ver-' . $current_theme->get( 'Version' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'river_qode_add_theme_version_class' );
}

/* Add class on body for ajax */

if ( ! function_exists( 'river_qode_add_ajax_classes' ) ) {
	function river_qode_add_ajax_classes( $classes ) {
		$global_options = river_qode_return_global_options();
		
		$qode_animation = "";
		if ( isset( $_SESSION['qode_animation'] ) ) {
			$qode_animation = $_SESSION['qode_animation'];
		}
		if ( ( $global_options['page_transitions'] === "0" ) && ( $qode_animation == "no" ) ) :
			$classes[] = '';
		elseif ( $global_options['page_transitions'] === "1" && ( empty( $qode_animation ) || ( $qode_animation != "no" ) ) ) :
			$classes[] = 'ajax_updown';
			$classes[] = 'page_not_loaded';
		elseif ( $global_options['page_transitions'] === "2" && ( empty( $qode_animation ) || ( $qode_animation != "no" ) ) ) :
			$classes[] = 'ajax_fade';
			$classes[] = 'page_not_loaded';
		elseif ( $global_options['page_transitions'] === "3" && ( empty( $qode_animation ) || ( $qode_animation != "no" ) ) ) :
			$classes[] = 'ajax_updown_fade';
			$classes[] = 'page_not_loaded';
		elseif ( $global_options['page_transitions'] === "4" && ( empty( $qode_animation ) || ( $qode_animation != "no" ) ) ) :
			$classes[] = 'ajax_leftright';
			$classes[] = 'page_not_loaded';
		elseif ( ! empty( $qode_animation ) && $qode_animation != "no" ) :
			$classes[] = 'page_not_loaded';
		else:
			$classes[] = "";
		endif;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'river_qode_add_ajax_classes' );
}

/* Add class on body boxed layout */

if ( ! function_exists( 'river_qode_add_boxed_class' ) ) {
	function river_qode_add_boxed_class( $classes ) {
		$global_options = river_qode_return_global_options();
		
		if ( isset( $global_options['boxed'] ) && $global_options['boxed'] == "yes" ) :
			$classes[] = 'boxed';
		endif;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'river_qode_add_boxed_class' );
}

if ( ! function_exists( 'river_qode_smooth_class' ) ) {
	function river_qode_smooth_class( $classes ) {
		$river_options = river_qode_return_global_options();
		
		$mac_os   = strpos( getenv( "HTTP_USER_AGENT" ), 'Mac' );
		$isMobile = (bool) preg_match( '#\b(ip(hone|od|ad)|android|opera m(ob|in)i|windows (phone|ce)|blackberry|tablet' .
		                               '|s(ymbian|eries60|amsung)|p(laybook|alm|rofile/midp|laystation portable)|nokia|fennec|htc[\-_]' .
		                               '|mobile|up\.browser|[1-4][0-9]{2}x[1-4][0-9]{2})\b#i', getenv( "HTTP_USER_AGENT" ) );
		
		$smooth_scroll = false;
		if ( ! $isMobile ) {
			if ( isset( $river_options['smooth_scroll'] ) && $river_options['smooth_scroll'] == "yes" ) {
				$smooth_scroll = true;
			} else if ( isset( $river_options['smooth_scroll'] ) && $river_options['smooth_scroll'] == "yes_not_ios" ) {
				if ( ! $mac_os ) {
					$smooth_scroll = true;
				}
			}
		}
		if ( isset( $_SESSION['qode_smooth'] ) ) {
			if ( $_SESSION['qode_smooth'] == "yes" ) {
				$smooth_scroll = true;
			} else {
				$smooth_scroll = false;
			}
		}
		
		if ( $smooth_scroll ) :
			$classes[] = 'smooth_scroll';
		endif;
		
		if ( $mac_os ):
			$classes[] = 'mac';
		endif;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'river_qode_smooth_class' );
}

/* Add class on body for ajax loading */

if ( ! function_exists( 'river_qode_ajax_loading_class' ) ) {
	function river_qode_ajax_loading_class( $classes ) {
		$global_options = river_qode_return_global_options();
		
		if ( isset( $global_options['loading_animation'] ) && $global_options['loading_animation'] == "yes" ) :
			$classes[] = 'show_loading_animation';
		endif;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'river_qode_ajax_loading_class' );
}