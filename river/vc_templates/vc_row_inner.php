<?php
$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $el_id = '';
extract(shortcode_atts(array(
	'el_class' => '',
	'row_type' => 'row',
	'type' => '',
	'anchor' => '',
	'video' => '',
	'video_overlay' => '',
	'video_webm' => '',
	'video_mp4' => '',
	'video_ogv' => '',
	'video_image' => '',
	'background_color' => '',
	'border_color' => '',
	'padding_top' => '',
	'padding_bottom' => '',
	'padding' => '',
	'text_align' => 'left',
	'more_button_label' => esc_html__( 'More Facts', 'river' ),
	'less_button_label'=> esc_html__( 'Less Facts', 'river' ),
	'button_position'=>'left',
	'color'=>'',
	'css_animation'=>'',
	'transition_delay'=>'',
	'css' => '',
	'bg_image',
	'margin_bottom',
	'bg_color',
	'bg_image_repeat',
	'bg_image',
	'font_color',
	'el_id' => ''
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_row wpb_row ' . ( $this->settings( 'base' ) === 'vc_row_inner' ? 'vc_inner ' : '' ) . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

if($type == "grid"){
	$css_class_type =  " grid_section";
} else {
	$css_class_type =  "";
}

if($css_animation != ""){
	$clsss_css_animation =  "  " . $css_animation;
} else {
	$clsss_css_animation =  "";
}
$delay = "";
if($transition_delay != ""){
	$delay = " style='transition-delay:" . $transition_delay . "s'";
}

$box_class="";
if($row_type == "box"){
	$box_class = " use_as_box";
}

$anchor_id = "";
if($anchor != ""){
	$anchor_id = ' data-id="#'.$anchor.'"';
}

$row_id = '';
if($el_id !== '') {
	$row_id = 'id="'.esc_attr($el_id).'"';
}

$style = $this->buildStyle( $bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom );
$output .= '<div '.$row_id.' '.$style.' '.$anchor_id.' class="' . $css_class . $clsss_css_animation . $box_class . '"';
$output .= ' style="text-align:' . $text_align . ';'. $delay .'">';
if($row_type == "row" && $css_animation != ""){
	$output .= '<div'. $delay .'>';
}
if($row_type == "section") {
	$output .= '<section class="section '.$css_class_type . '"';
	if($background_color != "" || $border_color != "" || $padding_top != "" || $padding_bottom != ""){
		$output .= " style='";
		if($background_color != ""){
			$output .="background-color:".$background_color.";";
		}
		if($border_color != ""){
			$output .=" border-color:".$border_color.";";
		}
		if($padding_top != ""){
			$output .=" padding-top:".$padding_top."px;";
		}
		if($padding_bottom != ""){
			$output .=" padding-bottom:".$padding_bottom."px;";
		}
		$output.="'";
	}
	$output .= '>';
	if($video == "show_video"){
		$v_image = wp_get_attachment_url($video_image);
		$output .= '<div class="mobile-video-image" style="background-image: url('.$v_image.')"></div><div class="video-overlay';
		if($video_overlay == "show_video_overlay"){
			$output .= ' active';
		}
		$output .= '"></div><div class="video-wrap">
								
								<video class="video" width="1920" height="800" poster="'.$v_image.'" controls="controls" preload="auto" loop="true" autoplay="true">';
		if(!empty($video_webm)) { $output .= '<source type="video/webm" src="'.$video_webm.'">'; }
		if(!empty($video_mp4)) { $output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
		if(!empty($video_ogv)) { $output .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
		$output .='<object width="320" height="240" type="application/x-shockwave-flash" data="'.get_template_directory_uri().'/js/flashmediaelement.swf">
												<param name="movie" value="'.get_template_directory_uri().'/js/flashmediaelement.swf" />
												<param name="flashvars" value="controls=true&amp;file='.$video_mp4.'" />
												<img alt="'.esc_attr__( 'Video thumb', 'river' ).'" src="'.$v_image.'" width="1920" height="800" title="' . esc_attr__( 'No video playback capabilities', 'river' ) . '"  />
										</object>
								</video>		
						</div>';
	}
	$output .= '<div class="section_inner clearfix"';
	if($padding != ""){
		$output .= " style='padding: 0% ".$padding."%'";
	}
	$output .= '>';
	if($type == "grid"){
		$output .= "<div class='section_inner_margin clearfix'>";
	}
} elseif($row_type == "box"){
	$output .= '<div class="box_holder"';
	if($background_color != "" || $border_color != ""){
		$output .= " style='";
		if($background_color != ""){
			$output .="background-color:".$background_color.";";
		}
		if($border_color != ""){
			$output .=" border-color:".$border_color.";";
		}
		$output.="'";
	}
	$output .= '><div class="box_holder_inner center clearfix">';
} elseif($row_type == "expandable"){
	$output .= '<div class="more_facts_holder"><div class="more_facts_outer"><div class="more_facts_inner">';
}
$output .= wpb_js_remove_wpautop($content);
if($row_type == "section") {
	if($type == "grid"){
		$output .= "</div>";
	}
	$output .= '</div></section>';
}elseif($row_type == "box"){
	$output .= '</div></div>';
}elseif($row_type == "expandable"){
	$output .= '</div></div><div class="more_facts_button_holder ' . $button_position . '">';
	$output .= '<span class="qbutton more_facts_button" data-morefacts="'. $more_button_label .'" data-lessfacts="'. $less_button_label . '"';
	if($background_color != "" || $color != "" || $border_color != ""){
		$output .= " style='";
		if($background_color != ""){
			$output .= "background-color: ".$background_color.";";
		}
		if($color != ""){
			$output .= " color: ".$color.";";
		}
		if($border_color != ""){
			$output .= " border-color: ".$border_color.";";
		}
		$output .= "'";
	}

	$output .='>'. $more_button_label .'</span>';
	$output .= '</div></div>';
}
if($row_type == "row" && $css_animation != "") {
	$output .= '</div>';
}
$output .= '</div>'.$this->endBlockComment('row');

echo river_qode_get_module_part($output);