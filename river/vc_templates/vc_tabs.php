<?php
$output = $title = $interval = $el_class = $style = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'el_class' => '',
	'style' => 'horizontal'
), $atts));

wp_enqueue_script('jquery-ui-tabs');

$el_class = $this->getExtraClass($el_class);

$element = 'wpb_tabs';
if ( 'vc_tour' == $this->shortcode) $element = 'wpb_tour';

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();

/**
 * vc_tabs
 *
 */
if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
$tabs_nav = '';
$tabs_nav .= '<ul class="tabs-nav">';
foreach ( $tab_titles as $tab ) {
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
    if(isset($tab_matches[1][0])) {
        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'">' . $tab_matches[1][0] . '</a></li>';

    }
}
$tabs_nav .= '</ul>'."\n";

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.'tabs_holder clearfix '.$el_class), $this->settings['base']);
if($style == "boxed") {
	$style_class = "boxed";
}else if($style == "vertical"){
	$style_class = "vertical";
}else if($style == "vertical_right"){
	$style_class = "vertical right";
}else{
	$style_class = "horizontal";
}
$output .= "\n\t".'<div class="'.$css_class.'" data-interval="'.$interval.'">';
$output .= "\n\t\t".'<div class="tabs ' . $style_class . '">';
$output .= wpb_widget_title(array('title' => $title, 'extraclass' => $element.'_heading'));
$output .= "\n\t\t\t".$tabs_nav;
$output .= "<div class='tabs-container'>";
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
$output .= "</div>";
if ( 'vc_tour' == $this->shortcode) {
    $output .= "\n\t\t\t" . '<div class="wpb_tour_next_prev_nav clearfix"> <span class="wpb_prev_slide"><a href="#prev" title="'.esc_attr__('Previous slide', 'river').'">'.esc_html__('Previous slide', 'river').'</a></span> <span class="wpb_next_slide"><a href="#next" title="'.esc_attr__('Next slide', 'river').'">'.esc_html__('Next slide', 'river').'</a></span></div>';
}
$output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> '.$this->endBlockComment($element);

echo river_qode_get_module_part($output);