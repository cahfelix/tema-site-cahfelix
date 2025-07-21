<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'river_qode_child_theme_enqueue_scripts' ) ) {
	function river_qode_child_theme_enqueue_scripts() {
		$parent_style = 'river-default-style';
		
		wp_enqueue_style( 'river-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'river_qode_child_theme_enqueue_scripts' );
}
