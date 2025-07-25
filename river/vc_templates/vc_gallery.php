<?php

// Code in else part is because of compatibility for older versions of VC.

if(version_compare(river_qode_get_vc_version(), '4.7.4') >= 0) {
	/**
	 * Shortcode attributes
	 * @var $atts
	 * @var $title
	 * @var $source
	 * @var $type
	 * @var $onclick
	 * @var $custom_links
	 * @var $custom_links_target
	 * @var $img_size
	 * @var $external_img_size
	 * @var $images
	 * @var $custom_srcs
	 * @var $el_class
	 * @var $interval
	 * @var $css
	 * Shortcode class
	 * @var $this WPBakeryShortCode_VC_gallery
	 */
	$title = $source = $type = $onclick = $custom_links = $custom_links_target = $img_size = $external_img_size = $images = $custom_srcs = $el_class = $interval = $css = '';
	$large_img_src = '';
	
	$attributes = vc_map_get_attributes( $this->getShortcode(), $atts );
	extract( $attributes );
	
	$default_src = vc_asset_url( 'vc/no_image.png' );
	
	$gal_images = '';
	$link_start = '';
	$link_end = '';
	$el_start = '';
	$el_end = '';
	$slides_wrap_start = '';
	$slides_wrap_end = '';
	
	$el_class = $this->getExtraClass( $el_class );
	if ( 'nivo' === $type ) {
		$type = ' wpb_slider_nivo theme-default';
		wp_enqueue_script( 'nivo-slider' );
		wp_enqueue_style( 'nivo-slider-css' );
		wp_enqueue_style( 'nivo-slider-theme' );
	
		$slides_wrap_start = '<div class="nivoSlider">';
		$slides_wrap_end = '</div>';
	} else if ( 'flexslider' === $type || 'flexslider_fade' === $type || 'flexslider_slide' === $type || 'fading' === $type ) {
		$el_start = '<li>';
		$el_end = '</li>';
		$slides_wrap_start = '<ul class="slides">';
		$slides_wrap_end = '</ul>';
		wp_enqueue_style( 'flexslider' );
		wp_enqueue_script( 'flexslider' );
	} else if ( 'image_grid' === $type ) {
	    //wp_enqueue_script( 'isotope' );
	
	    $el_start = '<li>';
	    $el_end = '</li>';
	    $slides_wrap_start = '<div class="gallery_holder"><ul class="gallery_inner v'. $column_number .'">';
	    $slides_wrap_end = '</ul></div>';
	}
	
	if ( 'link_image' === $onclick ) {
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
	}
	
	$flex_fx = '';
	if ( 'flexslider' === $type || 'flexslider_fade' === $type || 'fading' === $type ) {
		$type = ' wpb_flexslider flexslider_fade flexslider';
		$flex_fx = ' data-flex_fx="fade"';
	} else if ( 'flexslider_slide' === $type ) {
		$type = ' wpb_flexslider flexslider_slide flexslider';
		$flex_fx = ' data-flex_fx="slide"';
	} else if ( 'image_grid' === $type ) {
		$type = ' wpb_image_grid';
	}
	
	if ( '' === $images ) {
		$images = '-1,-2,-3';
	}
	
	$pretty_rel_random = ' rel="prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']"';
	
	if ( 'custom_link' === $onclick ) {
		$custom_links = vc_value_from_safe( $custom_links );
		$custom_links = explode( ',', $custom_links );
	}
	
	switch ( $source ) {
		case 'media_library':
			$images = explode( ',', $images );
			break;
	
		case 'external_link':
		    $images = vc_value_from_safe( $custom_srcs );
			$images = explode( ',', $custom_srcs );
			break;
	}
	foreach ( $images as $i => $image ) {
		switch ( $source ) {
			case 'media_library':
				if ( $image > 0 ) {
					$img = wpb_getImageBySize( array( 'attach_id' => $image, 'thumb_size' => $img_size ) );
					$thumbnail = $img['thumbnail'];
					$large_img_src = $img['p_img_large'][0];
				} else {
					$large_img_src = $default_src;
					$thumbnail = '<img src="' . $default_src . '" />';
				}
				break;
	
			case 'external_link':
				$image = esc_attr( $image );
				$dimensions = vcExtractDimensions( $external_img_size );
				$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';
				$thumbnail = '<img ' . $hwstring . ' src="' . $image . '" />';
				$large_img_src = $image;
				break;
		}

		$hover_image = '';
		if($type == ' wpb_image_grid') {
			$hover_image = '<span class="gallery_hover"><i class="icon-search"></i></span>';
		}
	
		$link_start = $link_end = '';
	
		switch ( $onclick ) {
			case 'img_link_large':
				$link_start = '<a href="' . $large_img_src . '" target="' . $custom_links_target . '">' . $hover_image;
				$link_end = '</a>';
				break;
	
			case 'link_image':
				$link_start = '<a class="prettyphoto" href="' . $large_img_src . '"' . $pretty_rel_random . '>' . $hover_image;
				$link_end = '</a>';
				break;
	
			case 'custom_link':
				if ( ! empty( $custom_links[ $i ] ) ) {
					$link_start = '<a href="' . $custom_links[ $i ] . '"' . ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) . '>' . $hover_image;
					$link_end = '</a>';
				}
				break;
		}
	
		$gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
	}
	
	$class_to_filter = 'wpb_gallery wpb_content_element vc_clearfix';
	$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
	
	$output = '';
	$output .= '<div class="' . $css_class . '">';
	$output .= '<div class="wpb_wrapper">';
	$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => 'wpb_gallery_heading' ) );
	$output .= '<div class="wpb_gallery_slides' . $type . '" data-interval="' . $interval . '"' . $flex_fx . '>' . $slides_wrap_start . $gal_images . $slides_wrap_end . '</div>';
	$output .= '</div>';
	$output .= '</div>';
	
	echo river_qode_get_module_part($output);

} else {

	$output = $title = $type = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $interval = $column_number =  '';
	extract(shortcode_atts(array(
	    'title' => '',
	    'type' => 'flexslider',
	    'onclick' => 'link_image',
	    'custom_links' => '',
	    'custom_links_target' => '',
	    'img_size' => 'full',
	    'images' => '',
	    'el_class' => '',
	    'interval' => '5',
		'column_number' => '3'
	), $atts));
	$gal_images = '';
	$link_start = '';
	$link_end = '';
	$el_start = '';
	$el_end = '';
	$slides_wrap_start = '';
	$slides_wrap_end = '';
	
	$el_class = $this->getExtraClass($el_class);
	
	if ( $type == 'nivo' ) {
	    $type = ' wpb_slider_nivo theme-default';
	    wp_enqueue_script( 'nivo-slider' );
	    wp_enqueue_style( 'nivo-slider-css' );
	    wp_enqueue_style( 'nivo-slider-theme' );
	
	    $slides_wrap_start = '<div class="nivoSlider">';
	    $slides_wrap_end = '</div>';
	} else if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'flexslider_slide' || $type == 'fading' ) {
	    $el_start = '<li>';
	    $el_end = '</li>';
	    $slides_wrap_start = '<ul class="slides">';
	    $slides_wrap_end = '</ul>';
	    //wp_enqueue_style('flexslider');
	   // wp_enqueue_script('flexslider');
	} else if ( $type == 'image_grid' ) {
	    wp_enqueue_script( 'isotope' );
	
	    $el_start = '<li>';
	    $el_end = '</li>';
	    $slides_wrap_start = '<div class="gallery_holder"><ul class="gallery_inner v'. $column_number .'">';
	    $slides_wrap_end = '</ul></div>';
	}
	
	if ( $onclick == 'link_image' ) {
	    wp_enqueue_script( 'prettyphoto' );
	    wp_enqueue_style( 'prettyphoto' );
	}
	
	$flex_fx = '';
	if ( $type == 'flexslider' || $type == 'flexslider_fade' || $type == 'fading' ) {
	    $type = ' wpb_flexslider flexslider_fade flexslider';
	    $flex_fx = ' data-flex_fx="fade"';
	} else if ( $type == 'flexslider_slide' ) {
	    $type = ' wpb_flexslider flexslider_slide flexslider';
	    $flex_fx = ' data-flex_fx="slide"';
	} else if ( $type == 'image_grid' ) {
	    $type = ' wpb_image_grid';
	}
	
	
	/*
	 else if ( $type == 'fading' ) {
	    $type = ' wpb_slider_fading';
	    $el_start = '<li>';
	    $el_end = '</li>';
	    $slides_wrap_start = '<ul class="slides">';
	    $slides_wrap_end = '</ul>';
	    wp_enqueue_script( 'cycle' );
	}*/
	
	//if ( $images == '' ) return null;
	if ( $images == '' ) $images = '-1,-2,-3';
	
	$pretty_rel_random = ' rel="prettyPhoto[rel-'.rand().']"'; //rel-'.rand();
	
	if ( $onclick == 'custom_link' ) { $custom_links = explode( ',', $custom_links); }
	$images = explode( ',', $images);
	$i = -1;
	
	foreach ( $images as $attach_id ) {
	    $i++;
	    if ($attach_id > 0) {
	        $post_thumbnail = wpb_getImageBySize(array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ));
	    }
	    else {
	        $different_kitten = 400 + $i;
	        $post_thumbnail = array();
	        $post_thumbnail['thumbnail'] = '<img src="http://placekitten.com/g/'.$different_kitten.'/300" />';
	        $post_thumbnail['p_img_large'][0] = 'http://placekitten.com/g/1024/768';
	    }
	
	    $thumbnail = $post_thumbnail['thumbnail'];
	    $p_img_large = $post_thumbnail['p_img_large'];
	    $link_start = $link_end = '';
		$hover_image = '';
		if($type == ' wpb_image_grid') {
			$hover_image = '<span class="gallery_hover"><i class="icon-search"></i></span>';
		}
	    if ( $onclick == 'link_image' ) {
	        $link_start = '<a class="prettyphoto" href="'.$p_img_large[0].'"'.$pretty_rel_random.'>' . $hover_image;
	        $link_end = '</a>';
	    }
	    else if ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ) {
	        $link_start = '<a href="'.$custom_links[$i].'"' . (!empty($custom_links_target) ? ' target="'.$custom_links_target.'"' : '') . '>' . $hover_image;
	        $link_end = '</a>';
	    }
	    $gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
	}
	$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_gallery wpb_content_element'.$el_class.' clearfix', $this->settings['base']);
	$output .= "\n\t".'<div class="'.$css_class.'">';
	$output .= "\n\t\t".'<div class="wpb_wrapper">';
	$output .= wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_gallery_heading'));
	$output .= '<div class="wpb_gallery_slides'.$type.'" data-interval="'.$interval.'"'.$flex_fx.'>'.$slides_wrap_start.$gal_images.$slides_wrap_end.'</div>';
	$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
	$output .= "\n\t".'</div> '.$this->endBlockComment('.wpb_gallery');
	
	echo river_qode_get_module_part($output);


}