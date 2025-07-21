<?php
$output = $title = $icon = $el_id = '';

extract(shortcode_atts(array(
	'title' => esc_html__("Section", "river"),
	'icon' => "",
    'title_tag' => 'h5',
	'el_id' => ''
), $atts));


if($title_tag == ""){
	$title_tag = 'h5';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_accordion_section group', $this->settings['base']);
    $output .= "\n\t\t\t\t" . '<'.$title_tag.' class="clearfix">';
	if($icon != "") {
	$output .= '<div class="icon-wrapper"><i class="' . $icon . '"></i></div>';
	}
	$output .= '<span class="tab-title">'.$title.'</span>';
	if($icon != "") {
		$output .= '<i class="icon-caret-right"></i><i class="icon-caret-down"></i>';
	}
	$output .= '</'.$title_tag.'>';
    $output .= "\n\t\t\t\t" . '<div ' . ( isset( $el_id ) && ! empty( $el_id ) ? "id='" . esc_attr( $el_id ) . "'" : "" ) . ' class="accordion_content">';
		$output .= "\n\t\t\t" . '<div class="accordion_content_inner">';
			$output .= ($content=='' || $content==' ') ? esc_html__("Empty section. Edit page to add content here.", "river") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
			$output .= "\n\t\t\t" . '</div>';
		 $output .= "\n\t\t\t\t" . '</div>' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo river_qode_get_module_part($output);