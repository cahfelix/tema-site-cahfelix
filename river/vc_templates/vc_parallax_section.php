<?php
$output = $title = $anchor = $height = $background_image = $position ='';

extract(shortcode_atts(array(
	'title' => esc_html__("Section", "river"),
	'anchor' => '',
	'height' => '',
	'background_image' => '',
	'position' => 'center'
), $atts));
$_image ="";
if($background_image != '' || $background_image != ' ') { 
	$_image = wp_get_attachment_image_src( $background_image, 'full');
}
$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'parallax_content', $this->settings['base']);
$anchor_id = "";
if($anchor != ""){
	$anchor_id = 'data-q_id="#'.$anchor.'"';
}
$output .='<section '.$anchor_id.' style = "';
$image = isset($_image[0]) ? $_image[0] : '';
$output .= ($background_image !== '' || $background_image !== ' ') ? " background-image:url('" . $image . "');" : '';
$output .= '"';
$output .= ($height !='' || $height!=' ') ? ' data-height="' . $height . '"' : '';
$output .= '>';
$output .='<div class="' . $css_class . " " . $position . '">';

    $output .= wpb_js_remove_wpautop($content);
$output .= '</div></section>' . $this->endBlockComment('.wpb_parallax_section') . "\n";

echo river_qode_get_module_part($output);