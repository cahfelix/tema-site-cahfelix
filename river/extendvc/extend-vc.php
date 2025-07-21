<?php
// Removing shortcodes
vc_remove_element("vc_widget_sidebar");
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_button2");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_message");
vc_remove_element("vc_tour");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_section");
//From version 4.4.2
vc_remove_element("vc_basic_grid");
vc_remove_element("vc_media_grid");
vc_remove_element("vc_masonry_grid");
vc_remove_element("vc_masonry_media_grid");
vc_remove_element("vc_icon");
//From version 4.5.2
vc_remove_element("vc_cta");
//From version 4.6.2
vc_remove_element("vc_round_chart");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_tta_accordion");
vc_remove_element("vc_tta_tour");
vc_remove_element("vc_tta_tabs");

/*** Remove unused parameters ***/
if (function_exists('vc_remove_param')) {
	vc_remove_param('vc_single_image', 'css_animation');
	vc_remove_param('vc_column_text', 'css_animation');
	vc_remove_param('vc_row', 'video_bg');
	vc_remove_param('vc_row', 'video_bg_url');
	vc_remove_param('vc_row', 'video_bg_parallax');
	vc_remove_param('vc_row', 'full_height');
	vc_remove_param('vc_row', 'content_placement');
	vc_remove_param('vc_row', 'full_width');
	vc_remove_param('vc_row', 'bg_image');
	vc_remove_param('vc_row', 'bg_color');
	vc_remove_param('vc_row', 'font_color');
	vc_remove_param('vc_row', 'margin_bottom');
	vc_remove_param('vc_row', 'bg_image_repeat');
	vc_remove_param('vc_tabs', 'interval');
	vc_remove_param('vc_separator', 'style');
	vc_remove_param('vc_separator', 'align');
	vc_remove_param('vc_separator', 'border_width');
	vc_remove_param('vc_separator', 'color');
	vc_remove_param('vc_separator', 'accent_color');
	vc_remove_param('vc_separator', 'el_width');
	vc_remove_param('vc_text_separator', 'style');
	vc_remove_param('vc_text_separator', 'align');
	vc_remove_param('vc_text_separator', 'border_width');
	vc_remove_param('vc_text_separator', 'color');
	vc_remove_param('vc_text_separator', 'accent_color');
	vc_remove_param('vc_text_separator', 'el_width');
	vc_remove_param('vc_row', 'gap');
    vc_remove_param('vc_row', 'columns_placement');
    vc_remove_param('vc_row', 'equal_height');
    vc_remove_param('vc_row_inner', 'gap');
    vc_remove_param('vc_row_inner', 'content_placement');
    vc_remove_param('vc_row_inner', 'equal_height');
    vc_remove_param('vc_row', 'parallax_speed_video');
    vc_remove_param('vc_row', 'parallax_speed_bg');
    vc_remove_param('vc_row_inner', 'disable_element');
	vc_remove_param('vc_row', 'disable_element');
	vc_remove_param('vc_row', 'css_animation');
	
	//remove vc parallax functionality
	vc_remove_param('vc_row', 'parallax');
	vc_remove_param('vc_row', 'parallax_image');
	
	if(version_compare(river_qode_get_vc_version(), '4.7.4') >= 0) {
		add_action( 'init', 'river_qode_remove_vc_image_zoom',11);
		function river_qode_remove_vc_image_zoom() {
			//Remove zoom from click action on single image
			$param = WPBMap::getParam( 'vc_single_image', 'onclick' );
			unset($param['value']['Zoom']);
			vc_update_shortcode_param( 'vc_single_image', $param );
		}
		vc_remove_param('vc_text_separator', 'css');
		vc_remove_param('vc_separator', 'css');
	}
}

/*** Remove frontend editor ***/
if(function_exists('vc_disable_frontend')){
	vc_disable_frontend();
}

/*** Restore Tabs&Accordion from Deprecated category ***/

$vc_map_deprecated_settings = array (
	'deprecated' => false,
	'category' => esc_html__( 'Content', 'river' )
);
vc_map_update( 'vc_accordion', $vc_map_deprecated_settings );
vc_map_update( 'vc_tabs', $vc_map_deprecated_settings );
vc_map_update( 'vc_tab', array('deprecated' => false) );
vc_map_update( 'vc_accordion_tab', array('deprecated' => false) );

$fa_icons = river_qode_get_font_awesome_icon_array();
$icons = array();
$icons[""] = "";
foreach ($fa_icons as $key => $value) {
			$icons[$key] = $key;
		}

$animations = array(
	"" => "",
	esc_html__( "Elements Shows From Left Side", 'river' ) => "element_from_left",
	esc_html__( "Elements Shows From Right Side", 'river' ) => "element_from_right",
	esc_html__( "Elements Shows From Top Side", 'river' ) => "element_from_top",
	esc_html__( "Elements Shows From Bottom Side", 'river' ) => "element_from_bottom",
	esc_html__( "Elements Shows From Fade", 'river' ) => "element_from_fade"
);
// Accordion
vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Style", 'river' ),
	"param_name" => "style",
	"value" => array(
		esc_html__( "Accordion", 'river' ) => "accordion",
		esc_html__( "Toggle", 'river' ) => "toggle",
		esc_html__( "Accordion with icon", 'river' ) => "accordion_with_icon",
		esc_html__( "Toggle with icon", 'river' ) => "toggle_with_icon"
	),
	'save_always' => true
));
vc_add_param("vc_accordion", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Background Color", 'river' ),
	"param_name" => "background_color",
	"value" => ''
));

vc_add_param("vc_accordion_tab", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Icon", 'river' ),
	"param_name" => "icon",
	"value" => $icons,
	'save_always' => true,
	
));

vc_add_param("vc_accordion_tab", array(
	"type" => "dropdown",
    "class" => "",
    "heading" => esc_html__( "Title Tag", 'river' ),
    "param_name" => "title_tag",
    "value" => array(
        ""   => "",
        esc_html__( "h2", 'river' ) => "h2",
        esc_html__( "h3", 'river' ) => "h3",
        esc_html__( "h4", 'river' ) => "h4",
        esc_html__( "h5", 'river' ) => "h5",
        esc_html__( "h6", 'river' ) => "h6",
    ),
    
));

// Tabs
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Style", 'river' ),
	"param_name" => "style",
	"value" => array(
		esc_html__( "Horizontal Center", 'river' ) => "horizontal",
		esc_html__( "Boxed", 'river' ) => "boxed",
		esc_html__( "Vertical Left", 'river' ) => "vertical",
		esc_html__( "Vertical Right", 'river' ) => "vertical_right"
	),
	'save_always' => true,
	
));

// Gallery
vc_add_param("vc_gallery", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Column Number", 'river' ),
	"param_name" => "column_number",
	 "value" => array(2, 3, 4, 5, "Disable" => 0),
	'save_always' => true,
	 "dependency" => Array('element' => "type", 'value' => array('image_grid'))
));

// Row
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"show_settings_on_create"=>true,
	"heading" => esc_html__( "Row Type", 'river' ),
	"param_name" => "row_type",
	"value" => array(
		esc_html__( "Row", 'river' ) => "row",
		esc_html__( "Section", 'river' ) => "section",
		esc_html__( "Box", 'river' ) => "box",
		esc_html__( "Expandable", 'river' ) => "expandable"
	),
	'save_always' => true,

));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Type", 'river' ),
	"param_name" => "type",
	"value" => array(
		esc_html__( "In Grid", 'river' ) => "grid",
		esc_html__( "Full Width", 'river' ) => "full_width"
	),
	'save_always' => true,
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Anchor ID", 'river' ),
	"param_name" => "anchor",
	"value" => ""
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Text Align", 'river' ),
	"param_name" => "text_align",
	"value" => array(
		esc_html__( "Left", 'river' ) => "left",
		esc_html__( "Center", 'river' ) => "center",
		esc_html__( "Right", 'river' ) => "right"
	),
	'save_always' => true,
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Video background", 'river' ),
	"param_name" => "video",
	"value" => array(
		esc_html__( "No", 'river' ) => "",
		esc_html__( "Yes", 'river' ) => "show_video"
	),
	'save_always' => true,
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Video overlay", 'river' ),
	"param_name" => "video_overlay",
	"value" => array(
		esc_html__( "No", 'river' ) => "",
		esc_html__( "Yes", 'river' ) => "show_video_overlay"
	),
	'save_always' => true,
	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Video background (webm) file url", 'river' ),
	"value" => "",
	"param_name" => "video_webm",
	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Video background (mp4) file url", 'river' ),
	"value" => "",
	"param_name" => "video_mp4",

	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Video background (ogv) file url", 'river' ),
	"value" => "",
	"param_name" => "video_ogv",

	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => esc_html__( "Video preview image", 'river' ),
	"value" => "",
	"param_name" => "video_image",

	"dependency" => Array('element' => "video", 'value' => array('show_video'))
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Background color", 'river' ),
	"param_name" => "background_color",
	"value" => "",

	"dependency" => Array('element' => "row_type", 'value' => array('section','expandable','box'))
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Border color", 'river' ),
	"param_name" => "border_color",
	"value" => "",

	"dependency" => Array('element' => "row_type", 'value' => array('section','expandable','box'))
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Padding", 'river' ),
	"value" => "",
	"param_name" => "padding",
	"description" => esc_html__( "Padding (left/right in % - full width only)", 'river' ),
	"dependency" => Array('element' => "type", 'value' => array('full_width'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Padding Top", 'river' ),
	"value" => "",
	"param_name" => "padding_top",

	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Padding Bottom", 'river' ),
	"value" => "",
	"param_name" => "padding_bottom",
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "More Button Label", 'river' ),
	"param_name" => "more_button_label",
	"value" =>  "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Less Button Label", 'river' ),
	"param_name" => "less_button_label",
	"value" =>  "",
	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Button Position", 'river' ),
	"param_name" => "button_position",
	"value" => array(
		"" => "",
		esc_html__( "Left", 'river' ) => "left",
		esc_html__( "Right", 'river' ) => "right",
		esc_html__( "Center", 'river' ) => "center"
	),

	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Color", 'river' ),
	"param_name" => "color",
	"value" => "",

	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row",  array(
  "type" => "dropdown",
  "heading" => esc_html__( "CSS Animation", 'river' ),
  "param_name" => "css_animation",
  "admin_label" => true,
  "value" => $animations,
	'save_always' => true,
  "description" => esc_html__( "", 'river' ),
  "dependency" => Array('element' => "row_type", 'value' => array('row'))

));
vc_add_param("vc_row",  array(
  "type" => "textfield",
  "heading" => esc_html__( "Transition delay", 'river' ),
  "param_name" => "transition_delay",
  "admin_label" => true,
  "value" => "",
  "description" => esc_html__( "", 'river' ),
  "dependency" => Array('element' => "row_type", 'value' => array('row'))

));
// Row Inner
vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"show_settings_on_create"=>true,
	"heading" => esc_html__( "Row Type", 'river' ),
	"param_name" => "row_type",
	"value" => array(
		esc_html__( "Row", 'river' ) => "row",
		esc_html__( "Section", 'river' ) => "section",
		esc_html__( "Box", 'river' ) => "box",
		esc_html__( "Expandable", 'river' ) => "expandable"
	),
	'save_always' => true,

));
vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Type", 'river' ),
	"param_name" => "type",
	"value" => array(
		esc_html__( "In Grid", 'river' ) => "grid",
		esc_html__( "Full Width", 'river' ) => "full_width"
	),
	'save_always' => true,
	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Anchor ID", 'river' ),
	"param_name" => "anchor",
	"value" => ""
));
vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Text Align", 'river' ),
	"param_name" => "text_align",
	"value" => array(
		esc_html__( "Left", 'river' ) => "left",
		esc_html__( "Center", 'river' ) => "center",
		esc_html__( "Right", 'river' ) => "right"
	),
	'save_always' => true

));
vc_add_param("vc_row_inner", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Background color", 'river' ),
	"param_name" => "background_color",
	"value" => "",

	"dependency" => Array('element' => "row_type", 'value' => array('section','expandable','box'))
));
vc_add_param("vc_row_inner", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Border color", 'river' ),
	"param_name" => "border_color",
	"value" => "",

	"dependency" => Array('element' => "row_type", 'value' => array('section','expandable','box'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Padding", 'river' ),
	"value" => "",
	"param_name" => "padding",
	"description" => esc_html__( "Padding (left/right in % - full width only)", 'river' ),
	"dependency" => Array('element' => "type", 'value' => array('full_width'))
));

vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Padding Top", 'river' ),
	"value" => "",
	"param_name" => "padding_top",

	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Padding Bottom", 'river' ),
	"value" => "",
	"param_name" => "padding_bottom",

	"dependency" => Array('element' => "row_type", 'value' => array('section'))
));
vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "More Button Label", 'river' ),
	"param_name" => "more_button_label",
	"value" =>  "",

	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row_inner", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Less Button Label", 'river' ),
	"param_name" => "less_button_label",
	"value" =>  "",

	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row_inner", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Button Position", 'river' ),
	"param_name" => "button_position",
	"value" => array(
		"" => "",
		esc_html__( "Left", 'river' ) => "left",
		esc_html__( "Right", 'river' ) => "right",
		esc_html__( "Center", 'river' ) => "center"
	),

	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row_inner", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Color", 'river' ),
	"param_name" => "color",
	"value" => "",

	"dependency" => Array('element' => "row_type", 'value' => array('expandable'))
));
vc_add_param("vc_row_inner",  array(
	"type" => "dropdown",
	"heading" => esc_html__( "CSS Animation", 'river' ),
	"param_name" => "css_animation",
	"admin_label" => true,
	"value" => $animations,
	'save_always' => true,
	"description" => esc_html__( "", 'river' ),
	"dependency" => Array('element' => "row_type", 'value' => array('row'))

));
vc_add_param("vc_row_inner",  array(
  "type" => "textfield",
  "heading" => esc_html__( "Transition delay", 'river' ),
  "param_name" => "transition_delay",
  "admin_label" => true,
  "value" => "",
  "description" => esc_html__( "", 'river' ),
  "dependency" => Array('element' => "row_type", 'value' => array('row'))

));
// Separator
vc_add_param("vc_separator", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Type", 'river' ),
	"param_name" => "type",
	"value" => array(
		esc_html__( "Normal", 'river' ) => "normal",
		esc_html__( "Transparent", 'river' ) => "transparent",
		esc_html__( "Full width", 'river' ) => "full_width",
                esc_html__( "Small", 'river' ) => "small"
	),
	'save_always' => true,
	
));

vc_add_param("vc_separator", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Position", 'river' ),
	"param_name" => "position",
	"value" => array(
		esc_html__( "Center", 'river' ) => "center",
		esc_html__( "Left", 'river' ) => "left",
		esc_html__( "Right", 'river' ) => "right"
	),
	'save_always' => true,
    "dependency" => array("element" => "type", "value" => array("small")),
	
));

vc_add_param("vc_separator", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Color", 'river' ),
	"param_name" => "color",
	"value" => "",
	
));

vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Thickness", 'river' ),
	"param_name" => "thickness",
	"value" => "",
	
));
vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Top Margin", 'river' ),
	"param_name" => "up",
	"value" => "",
	
));
vc_add_param("vc_separator", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__( "Bottom Margin", 'river' ),
	"param_name" => "down",
	"value" => "",
	
));


// Separator With Text
vc_add_param("vc_text_separator", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Border", 'river' ),
	"param_name" => "border",
	"value" => array(
		esc_html__( "No", 'river' ) => "no",
		esc_html__( "Yes", 'river' ) => "yes"
	),
	'save_always' => true,
));
vc_add_param("vc_text_separator", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Border Color", 'river' ),
	"param_name" => "border_color",
	"dependency" => Array('element' => "border", 'value' => array('yes'))

));
vc_add_param("vc_text_separator", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Background Color", 'river' ),
	"param_name" => "background_color",

));
vc_add_param("vc_text_separator", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Text Color", 'river' ),
	"param_name" => "text_color",

));
vc_add_param("vc_text_separator", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__( "Icon Color", 'river' ),
	"param_name" => "icon_color",

));
vc_add_param("vc_text_separator", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__( "Icon", 'river' ),
	"param_name" => "icon",
	"value" => $icons,
	'save_always' => true,
	
));
vc_add_param("vc_text_separator", array(
	"type" => "attach_image",
	"class" => "",
	"heading" => esc_html__( "Image", 'river' ),
	"param_name" => "image"

));


class WPBakeryShortCode_Vc_Parallax  extends WPBakeryShortCodesContainer {}
vc_map( array(
	'name' => esc_html__( 'Parallax', 'river' ),
	'base' => 'vc_parallax',
	'as_parent' => array('only' => 'vc_parallax_section'),
	'content_element' => true,
	'category' => esc_html__( 'by QODE', 'river' ),
	"show_settings_on_create" => false,
	"icon" => "icon-wpb-parallax",
	"js_view" => 'VcColumnView',
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => esc_html__( 'Title', 'river' ),
			'param_name' => 'title',
			'value' => '',
			'description' => esc_html__( 'What text use as a title. Leave blank if no title is needed.', 'river' )
		)
	)
) );


class WPBakeryShortCode_Vc_Parallax_Section  extends WPBakeryShortCodesContainer {}
vc_map( array(
	'name' => esc_html__( 'Parallax Section', 'river' ),
	'base' => 'vc_parallax_section',
	'as_parent' => array('except' => 'vc_parallax, vc_accordion, vc_tabs'),
	'as_child' => array('only' => 'vc_parallax'),
	'content_element' => true,
	"icon" => "icon-wpb-parallax",
	"js_view" => 'VcColumnView',
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => esc_html__( 'Title', 'river' ),
			'param_name' => 'title',
			'value' => '',
			'description' => esc_html__( 'Parallax section title.', 'river' )
		),
		array(
			'type' => 'attach_image',
			'holder' => 'div',
			'class' => '',
			'heading' => esc_html__( 'Background Image', 'river' ),
			'param_name' => 'background_image',
			'value' => '',
			'description' => esc_html__( 'Parallax section background image.', 'river' )
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => esc_html__( 'Section Height', 'river' ),
			'param_name' => 'height',
			'value' => '',
			'description' => esc_html__( 'Section height.', 'river' )
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'class' => '',
			'heading' => esc_html__( 'Content position', 'river' ),
			'param_name' => 'position',
			'value' => array(
				esc_html__( "center", 'river' ) => "center",
				esc_html__( "left", 'river' ) => "left",
				esc_html__( "right", 'river' ) => "right"
			),
			'save_always' => true,
			'description' => esc_html__( '', 'river' )
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'class' => '',
			'heading' => esc_html__( 'Anchor', 'river' ),
			'param_name' => 'anchor',
			'value' => '',
			'description' => esc_html__( '', 'river' )
		)
	)
) );


//Testimonials
vc_map( array(
		"name" => esc_html__( "Testimonials", 'river' ),
		"base" => "testimonials",
		"category" => esc_html__( 'by QODE', 'river' ),
		"icon" => "icon-wpb-testimonials",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Transparent", 'river' ) => "transparent"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Category", 'river' ),
				"param_name" => "category",
				"value" => "",
				"description" => esc_html__( "Category Slug (leave empty for all)", 'river' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number", 'river' ),
				"param_name" => "number",
				"value" => "",
				"description" => esc_html__( "Number of Testimonials", 'river' )
			),
            array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text Color", 'river' ),
				"param_name" => "text_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				"description" => esc_html__( "Only for normal type", 'river' ),
                "dependency" => Array('element' => "type", 'value' => array('normal'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Color", 'river' ),
				"param_name" => "border_color",
				"description" => esc_html__( "Only for normal type", 'river' ),
                "dependency" => Array('element' => "type", 'value' => array('normal'))
			)
		)
) );
//Portfolio
vc_map( array(
		"name" => esc_html__( "Portfolio", 'river' ),
		"base" => "portfolio_list",
		"category" => esc_html__( 'by QODE', 'river' ),
		"icon" => "icon-wpb-portfolio",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "Standard", 'river' ) => "standard",
					esc_html__( "Circle", 'river' ) => "circle",
					esc_html__( "Hover Text", 'river' ) => "hover_text"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Columns", 'river' ),
				"param_name" => "columns",
				"value" => array(
					"" => "",
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Order By", 'river' ),
				"param_name" => "order_by",
				"value" => array(
					"" => "",
					esc_html__( "Menu Order", 'river' ) => "menu_order",
					esc_html__( "Title", 'river' ) => "title",
					esc_html__( "Date", 'river' ) => "date"
				),
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Order", 'river' ),
				"param_name" => "order",
				"value" => array(
					"" => "",
					esc_html__( "ASC", 'river' ) => "ASC",
					esc_html__( "DESC", 'river' ) => "DESC",
				),
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Filter", 'river' ),
				"param_name" => "filter",
				"value" => array(
					"" => "",
					esc_html__( "Yes", 'river' ) => "yes",
					esc_html__( "No", 'river' ) => "no"
				),
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Lightbox", 'river' ),
				"param_name" => "lightbox",
				"value" => array(
					"" => "",
					esc_html__( "Yes", 'river' ) => "yes",
					esc_html__( "No", 'river' ) => "no"
				),
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Show Load More", 'river' ),
				"param_name" => "show_load_more",
				"value" => array(
					"" => "",
					esc_html__( "Yes", 'river' ) => "yes",
					esc_html__( "No", 'river' ) => "no"
				),
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number", 'river' ),
				"param_name" => "number",
				"value" => "-1",
				"description" => esc_html__( "Number of portolios on page (-1 is all)", 'river' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Category", 'river' ),
				"param_name" => "category",
				"value" => "",
				"description" => esc_html__( "Category Slug (leave empty for all)", 'river' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Selected Projects", 'river' ),
				"param_name" => "selected_projects",
				"value" => "",
				"description" => esc_html__( "Selected Projects (leave empty for all, delimit by comma)", 'river' )
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            )
		)
) );

//Counter
vc_map( array(
		"name" => esc_html__( "Counter", 'river' ),
		"base" => "counter",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-counter",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "Zero Counter", 'river' ) => "zero",
					esc_html__( "Random Counter", 'river' ) => "random"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Position", 'river' ),
				"param_name" => "position",
				"value" => array(
					esc_html__( "Left", 'river' ) => "left",
					esc_html__( "Right", 'river' ) => "right",
					esc_html__( "Center", 'river' ) => "center"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Digit", 'river' ),
				"param_name" => "digit",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font size (px)", 'river' ),
				"param_name" => "font_size",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font Color", 'river' ),
				"param_name" => "font_color",
				
			)
		)
) );

//Icon List Item
vc_map( array(
		"name" => esc_html__( "Icon List Item", 'river' ),
		"base" => "icon_list_item",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-icon_list_item",
		"category" => esc_html__( 'by QODE', 'river' ),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Icon", 'river' ),
				"param_name" => "icon",
				"value" => $icons,
				'save_always' => true,
				
				),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Color", 'river' ),
				"param_name" => "icon_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Background Color", 'river' ),
				"param_name" => "icon_background_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Border Color", 'river' ),
				"param_name" => "icon_border_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
			),
		)
) );
// Call to action
vc_map( array(
		"name" => esc_html__( "Qode call to action", 'river' ),
		"base" => "action",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-action",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "With border", 'river' ) => "with_border",
					esc_html__( "Without border", 'river' ) => "without_border"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Color", 'river' ),
				"param_name" => "border_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link", 'river' ),
				"param_name" => "link",
				"description" => esc_html__( "Link (only with elegant type)", 'river' )
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link Target", 'river' ),
				"param_name" => "target",
				"value" => array(
					"" => "",
					esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Blank", 'river' ) => "_blank",
					esc_html__( "Parent", 'river' ) => "_parent"
				),
				
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<p>" . esc_html__( "I am test text for Call to action.", 'river' ) . "</p>",
				
			)
		)
) );
// Blockquote
vc_map( array(
		"name" => esc_html__( "Blockquote", 'river' ),
		"base" => "blockquote",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-blockquote",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'river' ),
				"param_name" => "text",
				"value" => esc_html__( "Blockquote text", 'river' ),
				'save_always' => true
			),
                        array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text Color", 'river' ),
				"param_name" => "text_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Width", 'river' ),
				"param_name" => "width",
				"description" => esc_html__( "Width (%)", 'river' )
			),
                        array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Color", 'river' ),
				"param_name" => "border_color",
				
			),
		)
) );
// Button
vc_map( array(
		"name" => esc_html__( "Button", 'river' ),
		"base" => "button",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-button",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Size", 'river' ),
				"param_name" => "size",
				"value" => array(
					esc_html__( "Default", 'river' ) => "",
					esc_html__( "Tiny", 'river' ) => "tiny",
					esc_html__( "Small", 'river' ) => "small",
					esc_html__( "Medium", 'river' ) => "medium",
					esc_html__( "Large", 'river' ) => "large",
					esc_html__( "Full Width", 'river' ) => "full_width"
				),
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Transparent", 'river' ) => "no_fill"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'river' ),
				"param_name" => "text",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link", 'river' ),
				"param_name" => "link",
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link Target", 'river' ),
				"param_name" => "target",
				"value" => array(
					esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Blank", 'river' ) => "_blank",
					esc_html__( "Parent", 'river' ) => "_parent",
					esc_html__( "Top", 'river' ) => "_top"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Color", 'river' ),
				"param_name" => "border_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Color", 'river' ),
				"param_name" => "color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font Style", 'river' ),
				"param_name" => "font_style",
				"value" => array(
					"" => "",
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Italic", 'river' ) => "italic"
				),
				
			)
		)
) );
// Image with text
vc_map( array(
		"name" => esc_html__( "Image with text", 'river' ),
		"base" => "image_with_text",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-image_with_text",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Image", 'river' ),
				"param_name" => "image"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            ),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<p>" . esc_html__( "I am test text for Image with text shortcode.", 'river' ) . "</p>",
				
			)
		)
) );

//Message
vc_map( array(
		"name" => esc_html__( "Qode Message", 'river' ),
		"base" => "message",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-message",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "With Icon", 'river' ) => "with_icon"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Icon", 'river' ),
				"param_name" => "icon",
				"value" => $icons,
				'save_always' => true,
			
				"dependency" => Array('element' => "type", 'value' => array('with_icon'))
				),
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => esc_html__( "Icon Color", 'river' ),
				"param_name" => "icon_color",
			
				"dependency" => Array('element' => "type", 'value' => array('with_icon'))
				),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Custom Icon", 'river' ),
				"param_name" => "custom_icon",
				"dependency" => Array('element' => "type", 'value' => array('with_icon'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Color", 'river' ),
				"param_name" => "border_color",
				
			),
                        array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Close Button Style", 'river' ),
				"param_name" => "close_button_style",
				"value" => array(
					esc_html__( "Dark", 'river' ) => "dark",
					esc_html__( "Light", 'river' ) => "light"
				),
							'save_always' => true,
				
                        ),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<p>" . esc_html__( "I am test text for Message shortcode", 'river' ) . "</p>"
				
			)
		)
) );
// Pie Chart
vc_map( array(
		"name" => esc_html__( "Qode Pie Chart", 'river' ),
		"base" => "pie_chart",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-pie_chart",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Percentage", 'river' ),
				"param_name" => "percent",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Percentage Color", 'river' ),
				"param_name" => "percentage_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Bar Active Color", 'river' ),
				"param_name" => "active_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Bar Noactive Color", 'river' ),
				"param_name" => "noactive_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Pie Chart Line Width (px)", 'river' ),
				"param_name" => "line_width",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'river' ),
				"param_name" => "text",
				
			)
		)
) );
// Pie Chart 2 (Pie)
vc_map( array(
		"name" => esc_html__( "Qode Pie Chart 2", 'river' ),
		"base" => "pie_chart2",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-pie_chart2",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Width", 'river' ),
				"param_name" => "width",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Height", 'river' ),
				"param_name" => "height",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Legend Text Color", 'river' ),
				"param_name" => "color",
				
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "15,#f54325,Legend One; 35,#fea899,Legend Two; 50,#ffd7d0,Legend Three",
				
			)

		)
) );
// Pie Chart 3 (Doughnut)
vc_map( array(
		"name" => esc_html__( "Qode Pie Chart 3", 'river' ),
		"base" => "pie_chart3",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-pie_chart3",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Width", 'river' ),
				"param_name" => "width",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Height", 'river' ),
				"param_name" => "height",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Legend Text Color", 'river' ),
				"param_name" => "color",
				
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "15,#f54325,Legend One; 35,#fea899,Legend Two; 50,#ffd7d0,Legend Three",
				
			)

		)
) );
// Horizontal progress bar shortcode
vc_map( array(
		"name" => esc_html__( "Qode Horizontal progress bar shortcode", 'river' ),
		"base" => "progress_bar",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-progress_bar",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Percentage", 'river' ),
				"param_name" => "percent",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Percentage Color", 'river' ),
				"param_name" => "percent_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Active Background Color", 'river' ),
				"param_name" => "active_background_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "No active Background Color", 'river' ),
				"param_name" => "noactive_background_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Progress Bar Height (px)", 'river' ),
				"param_name" => "height",
				
			)

		)
) );

// Vertical progress bar shortcode
vc_map( array(
		"name" => esc_html__( "Qode Vertical progress bar shortcode", 'river' ),
		"base" => "progress_bar_vertical",
		"icon" => "icon-wpb-progress_bar",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				
			),
            array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            ),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Size", 'river' ),
				"param_name" => "title_size",
				
			),
			array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Percent", 'river' ),
				"param_name" => "percent",
				
			),
            array (
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Percentage Text Size", 'river' ),
				"param_name" => "percentage_text_size",
				
			),
            array (
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Percentage Color", 'river' ),
				"param_name" => "percent_color",
				
			),
            array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'river' ),
				"param_name" => "text",
				"value" => esc_html__( "Put some content here", 'river' )
			)
		)
) );

// Icon Progress Bar
vc_map( array(
		"name" => esc_html__( "Icon Progress Bar", 'river' ),
		"base" => "progress_bar_icon",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-progress_bar_icon",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number of Icons", 'river' ),
				"param_name" => "icons_number",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number of Active Icons", 'river' ),
				"param_name" => "active_number",
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Circle", 'river' ) => "circle",
					esc_html__( "Square", 'river' ) => "square"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Icon", 'river' ),
				"param_name" => "icon",
				"value" => $icons,
				'save_always' => true,
				
				),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Size", 'river' ),
				"param_name" => "size",
				"value" => array(
					esc_html__( "Tiny", 'river' ) => "tiny",
					esc_html__( "Small", 'river' ) => "small",
					esc_html__( "Medium", 'river' ) => "medium",
					esc_html__( "Large", 'river' ) => "large"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Custom Size (px)", 'river' ),
				"param_name" => "custom_size",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Color", 'river' ),
				"param_name" => "icon_color",
				
			),

			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Active Color", 'river' ),
				"param_name" => "icon_active_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Active Color", 'river' ),
				"param_name" => "background_active_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Color", 'river' ),
				"param_name" => "border_color",
				"description" => esc_html__( "Only for Square type", 'river' ),
				"dependency" => Array('element' => "type", 'value' => array('square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Active Color", 'river' ),
				"param_name" => "border_active_color",
				"description" => esc_html__( "Only for Square type", 'river' ),
				"dependency" => Array('element' => "type", 'value' => array('square'))
			)

		)
) );


// Line Graph shortcode
vc_map( array(
		"name" => esc_html__( "Line Graph", 'river' ),
		"base" => "line_graph",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-line_graph",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					"" => "",
					esc_html__( "Rounded edges", 'river' ) => "rounded",
					esc_html__( "Sharp edges", 'river' ) => "sharp"
				),
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Width", 'river' ),
				"param_name" => "width",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Height", 'river' ),
				"param_name" => "height",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Custom Color", 'river' ),
				"param_name" => "custom_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Scale steps", 'river' ),
				"param_name" => "scale_steps",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Scale step width", 'river' ),
				"param_name" => "scale_step_width",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Labels", 'river' ),
				"param_name" => "labels",
				"value" => esc_html__( "Label 1, Label 2, Label 3", 'river' )
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "#f54325,Legend One,1,5,10;#fea899,Legend Two,3,7,20;#ffd7d0,Legend Three,10,2,34",
				
			)
		)
) );

// Pricing table shortcode
vc_map( array(
		"name" => esc_html__( "Pricing table shortcode", 'river' ),
		"base" => "pricing_column",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-pricing_column",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				"value" => esc_html__( "Basic plan", 'river' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Price", 'river' ),
				"param_name" => "price",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Currency", 'river' ),
				"param_name" => "currency",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Price Period", 'river' ),
				"param_name" => "price_period",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link", 'river' ),
				"param_name" => "link",
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Target", 'river' ),
				"param_name" => "target",
				"value" => array(
					"" => "",
					esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Blank", 'river' ) => "_blank",
					esc_html__( "Parent", 'river' ) => "_parent"
				),
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Button Text", 'river' ),
				"param_name" => "button_text",
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Active", 'river' ),
				"param_name" => "active",
				"value" => array(
					esc_html__( "No", 'river' ) => "no",
					esc_html__( "Yes", 'river' ) => "yes"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<li>content content content</li><li>content content content</li><li>content content content</li>",
				
			)
		)
) );

// Social Share
vc_map( array(
		"name" => esc_html__( "Social share", 'river' ),
		"base" => "social_share",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-social_share",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"show_settings_on_create" => false
) );

// Custom Font
vc_map( array(
		"name" => esc_html__( "Custom Font", 'river' ),
		"base" => "custom_font",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-custom_font",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font family", 'river' ),
				"param_name" => "font_family",
				"value" => "Oswald"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font size", 'river' ),
				"param_name" => "font_size",
				"value" => "15",
				'save_always' => true
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Line height", 'river' ),
				"param_name" => "line_height",
				"value" => "26",
				'save_always' => true
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font Style", 'river' ),
				"param_name" => "font_style",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Italic", 'river' ) => "italic"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text Align", 'river' ),
				"param_name" => "text_align",
				"value" => array(
					esc_html__( "Left", 'river' ) => "left",
					esc_html__( "Center", 'river' ) => "center",
					esc_html__( "Right", 'river' ) => "right"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font weight", 'river' ),
				"param_name" => "font_weight",
				"value" => "300",
				'save_always' => true
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Color", 'river' ),
				"param_name" => "color",
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text decoration", 'river' ),
				"param_name" => "text_decoration",
				"value" => array(
					esc_html__( "None", 'river' ) => "none",
					esc_html__( "Underline", 'river' ) => "underline",
					esc_html__( "Overline", 'river' ) => "overline",
					esc_html__( "Line Through", 'river' ) => "line-through"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Padding (px)", 'river' ),
				"param_name" => "padding",
				"value" => "0"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Margin (px)", 'river' ),
				"param_name" => "margin",
				"value" => "0"
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<p>" . esc_html__( "Put some content here", 'river' ) . "</p>",
				
			)

		)
) );

// Ordered List
vc_map( array(
		"name" => esc_html__( "Ordered List", 'river' ),
		"base" => "ordered_list",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-ordered_list",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>",
				
			)

		)
) );

// Unordered List

vc_map( array(
		"name" => esc_html__( "Unordered List", 'river' ),
		"base" => "unordered_list",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-unordered_list",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Style", 'river' ),
				"param_name" => "style",
				"value" => array(
					esc_html__( "Circle", 'river' ) => "circle",
					esc_html__( "Number", 'river' ) => "number"
				),
				'save_always' => true,
				
			),
            array(
                    "type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number Type", 'river' ),
				"param_name" => "number_type",
				"value" => array(
					esc_html__( "Circle", 'river' ) => "circle_number",
					esc_html__( "Transparent", 'river' ) => "transparent_number"
				),
				'save_always' => true,
			
                                "dependency" => array('element' => "style", 'value' => array('number'))
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Animate List", 'river' ),
				"param_name" => "animate",
				"value" => array(
					esc_html__( "No", 'river' ) => "no",
					esc_html__( "Yes", 'river' ) => "yes"
				),
				'save_always' => true,
				
			),
            array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Font Weight", 'river' ),
				"param_name" => "font_weight",
				"value" => array(
                    esc_html__( "Default", 'river' ) => "",
					esc_html__( "Light", 'river' ) => "light",
					esc_html__( "Normal", 'river' ) => "normal",
                    esc_html__( "Bold", 'river' ) => "bold"
				),
				
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<ul><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ul>",
				
			)
		)
) );

// Icon
vc_map( array(
		"name" => esc_html__( "Icon", 'river' ),
		"base" => "icons",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-icons",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Size", 'river' ),
				"param_name" => "size",
				"value" => array(
					esc_html__( "Tiny", 'river' ) => "icon-large",
					esc_html__( "Small", 'river' ) => "icon-2x",
					esc_html__( "Medium", 'river' ) => "icon-3x",
					esc_html__( "Large", 'river' ) => "icon-4x"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Custom Size (px)", 'river' ),
				"param_name" => "custom_size",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Icon", 'river' ),
				"param_name" => "icon",
				"value" => $icons,
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Circle", 'river' ) => "circle",
					esc_html__( "Square", 'river' ) => "square"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Position", 'river' ),
				"param_name" => "position",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "",
					esc_html__( "Left", 'river' ) => "left",
					esc_html__( "Right", 'river' ) => "right"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border", 'river' ),
				"param_name" => "border",
				"value" => array(
					esc_html__( "Yes", 'river' ) => "yes",
					esc_html__( "No", 'river' ) => "no"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Border Color", 'river' ),
				"param_name" => "border_color",
				"description" => esc_html__( "Only for Square type", 'river' ),
				"dependency" => Array('element' => "type", 'value' => array('square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Color", 'river' ),
				"param_name" => "icon_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Margin", 'river' ),
				"param_name" => "margin",
				"description" => esc_html__( "Margin (top right bottom left)", 'river' )
			)

		)
) );

// Social Icon
vc_map( array(
		"name" => esc_html__( "Social Icon", 'river' ),
		"base" => "social_icons",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-social_icons",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Icon", 'river' ),
				"param_name" => "icon",
				"value" => array(
					esc_html__( "ADN", 'river' ) => "icon-adn",
					esc_html__( "Android", 'river' ) => "icon-android",
					esc_html__( "Apple", 'river' ) => "icon-apple",
					esc_html__( "Bitbucket", 'river' ) => "icon-bitbucket",
					esc_html__( "Bitbucket-Sign", 'river' ) => "icon-bitbucket-sign",
					esc_html__( "Bitcoin", 'river' ) => "icon-bitcoin",
					esc_html__( "BTC", 'river' ) => "icon-btc",
					esc_html__( "CSS3", 'river' ) => "icon-css3",
					esc_html__( "Dribbble", 'river' ) => "icon-dribbble",
					esc_html__( "Dropbox", 'river' ) => "icon-dropbox",
					esc_html__( "Facebook", 'river' ) => "icon-facebook",
					esc_html__( "Facebook-Sign", 'river' ) => "icon-facebook-sign",
					esc_html__( "Flickr", 'river' ) => "icon-flickr",
					esc_html__( "Foursquare", 'river' ) => "icon-foursquare",
					esc_html__( "GitHub", 'river' ) => "icon-github",
					esc_html__( "GitHub-Alt", 'river' ) => "icon-github-alt",
					esc_html__( "GitHub-Sign", 'river' ) => "icon-github-sign",
					esc_html__( "Gittip", 'river' ) => "icon-gittip",
					esc_html__( "Google Plus", 'river' ) => "icon-google-plus",
					esc_html__( "Google Plus-Sign", 'river' ) => "icon-google-plus-sign",
					esc_html__( "HTML5", 'river' ) => "icon-html5",
					esc_html__( "Instagram", 'river' ) => "icon-instagram",
					esc_html__( "LinkedIn", 'river' ) => "icon-linkedin",
					esc_html__( "LinkedIn-Sign", 'river' ) => "icon-linkedin-sign",
					esc_html__( "Linux", 'river' ) => "icon-linux",
					esc_html__( "MaxCDN", 'river' ) => "icon-maxcdn",
					esc_html__( "Pinterest", 'river' ) => "icon-pinterest",
					esc_html__( "Pinterest-Sign", 'river' ) => "icon-pinterest-sign",
					esc_html__( "Renren", 'river' ) => "icon-renren",
					esc_html__( "Skype", 'river' ) => "icon-skype",
					esc_html__( "StackExchange", 'river' ) => "icon-stackexchange",
					esc_html__( "Trello", 'river' ) => "icon-trello",
					esc_html__( "Tumblr", 'river' ) => "icon-tumblr",
					esc_html__( "Tumblr-Sign", 'river' ) => "icon-tumblr-sign",
					esc_html__( "Twitter", 'river' ) => "icon-twitter",
					esc_html__( "Twitter-Sign", 'river' ) => "icon-twitter-sign",
					esc_html__( "VK", 'river' ) => "icon-vk",
					esc_html__( "Weibo", 'river' ) => "icon-weibo",
					esc_html__( "Windows", 'river' ) => "icon-windows",
					esc_html__( "Xing", 'river' ) => "icon-xing",
					esc_html__( "Xing-Sign", 'river' ) => "icon-xing-sign",
					esc_html__( "YouTube", 'river' ) => "icon-youtube",
					esc_html__( "YouTube Play", 'river' ) => "icon-youtube-play",
					esc_html__( "YouTube-Sign", 'river' ) => "icon-youtube-sign",
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Size", 'river' ),
				"param_name" => "size",
				"value" => array(
					esc_html__( "Small", 'river' ) => "icon-large",
					esc_html__( "Normal", 'river' ) => "icon-2x",
					esc_html__( "Large", 'river' ) => "icon-3x"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link", 'river' ),
				"param_name" => "link",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Target", 'river' ),
				"param_name" => "target",
				"value" => array(
					esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Blank", 'river' ) => "_blank",
					esc_html__( "Parent", 'river' ) => "_parent"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Color", 'river' ),
				"param_name" => "icon_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				
			)
		)
) );

// Icon with Text
vc_map( array(
		"name" => esc_html__( "Icon With Text", 'river' ),
		"base" => "icon_text",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-icon_text",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Box type", 'river' ),
				"param_name" => "box_type",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Icon in a box", 'river' ) => "icon_in_a_box"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Box Border", 'river' ),
				"param_name" => "box_border",
				"value" => array(
					esc_html__( "Yes", 'river' ) => "yes",
					esc_html__( "No", 'river' ) => "no"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Box Border Color", 'river' ),
				"param_name" => "box_border_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Box Background Color", 'river' ),
				"param_name" => "box_background_color",
			
				"dependency" => Array('element' => "box_type", 'value' => array('icon_in_a_box'))
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Icon", 'river' ),
				"param_name" => "icon",
				"value" => $icons,
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Type", 'river' ),
				"param_name" => "icon_type",
				"value" => array(
					esc_html__( "Normal", 'river' ) => "normal",
					esc_html__( "Circle", 'river' ) => "circle",
					esc_html__( "Square", 'river' ) => "square"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Size", 'river' ),
				"param_name" => "icon_size",
				"value" => array(
					esc_html__( "Tiny", 'river' ) => "icon-large",
					esc_html__( "Small", 'river' ) => "icon-2x",
					esc_html__( "Medium", 'river' ) => "icon-3x",
					esc_html__( "Large", 'river' ) => "icon-4x"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Custom Icon Size (px)", 'river' ),
				"param_name" => "custom_icon_size",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Animation", 'river' ),
				"param_name" => "icon_animation",
				"value" => array(
					esc_html__( "No", 'river' ) => "",
					esc_html__( "Yes", 'river' ) => "q_icon_animation"
				),
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Animation Delay (ms)", 'river' ),
				"param_name" => "icon_animation_delay",
				"value" => "",
                "description" => esc_html__( "", 'river' )
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Image", 'river' ),
				"param_name" => "image"
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Position", 'river' ),
				"param_name" => "icon_position",
				"value" => array(
					esc_html__( "Top", 'river' ) => "top",
					esc_html__( "Left", 'river' ) => "left"
				),
				'save_always' => true,
				"description" => esc_html__( "Icon Position (only for normal box type)", 'river' ),
				"dependency" => Array('element' => "box_type", 'value' => array('normal'))
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Margin", 'river' ),
				"param_name" => "icon_margin",
				"value" => "",
                "description" => esc_html__( "Margin should be set in a top right bottom left format", 'river' )
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Border Color", 'river' ),
				"param_name" => "border_color",
				"description" => esc_html__( "Only for Square type", 'river' ),
				"dependency" => Array('element' => "icon_type", 'value' => array('square'))
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Color", 'river' ),
				"param_name" => "icon_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Icon Background Color", 'river' ),
				"param_name" => "icon_background_color",
				"description" => esc_html__( "Icon Background Color (only for square and circle icon type)", 'river' ),
				"dependency" => Array('element' => "icon_type", 'value' => array('square','circle'))
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				"value" => ""
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text", 'river' ),
				"param_name" => "text",
				"value" => ""
			),
                        array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
			),
                        array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text Color", 'river' ),
				"param_name" => "text_color",
			)
		)
) );

// Latest Posts

vc_map( array(
		"name" => esc_html__( "Latest Posts", 'river' ),
		"base" => "latest_post",
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-latest_post",
		"category" => esc_html__( 'by QODE', 'river' ),
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number of Posts per Row", 'river' ),
				"param_name" => "post_number_per_row",
				"value" => array(
					"2" => "2",
					"3" => "3",
					"4" => "4"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number of Rows", 'river' ),
				"param_name" => "rows",
				"value" => array(
					"1" => "1",
					"2" => "2",
					"3" => "3"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number of Rows", 'river' ),
				"param_name" => "rows",
				"value" => array(
					"1" => "1",
					"2" => "2",
					"3" => "3"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Order By", 'river' ),
				"param_name" => "order_by",
				"value" => array(
					esc_html__( "Menu Order", 'river' ) => "menu_order",
					esc_html__( "Title", 'river' ) => "title",
					esc_html__( "Date", 'river' ) => "date"
				),
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Order", 'river' ),
				"param_name" => "order",
				"value" => array(
					esc_html__( "ASC", 'river' ) => "ASC",
					esc_html__( "DESC", 'river' ) => "DESC"
				),
				'save_always' => true,
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Category Slug", 'river' ),
				"param_name" => "category",
				"description" => esc_html__( "Leave empty for all or use comma for list", 'river' )
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Text length", 'river' ),
				"param_name" => "text_length",
				"description" => esc_html__( "Number of caracters", 'river' )
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            )
		)
) );


// Steps
vc_map( array(
		"name" => esc_html__( "Steps", 'river' ),
		"base" => "steps",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-steps",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Number Of Steps", 'river' ),
				"param_name" => "number_of_steps",
				"value" => array(
                    esc_html__( "Deafult", 'river' ) => "",
					"2" => "2",
					"3" => "3",
					"4" => "4"
				),
				"description" => esc_html__( "Number of steps in the process", 'river' )
            ),
            array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Background Color", 'river' ),
				"param_name" => "background_color",
				"description" => esc_html__( "Background color of the step holder", 'river' )
            ),
            array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Number Color", 'river' ),
				"param_name" => "number_color",
				
            ),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
            ),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "Default",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				'save_always' => true,
				
            ),

            //first step config
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title 1", 'river' ),
				"param_name" => "title_1",
				
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Number 1", 'river' ),
				"param_name" => "step_number_1",
				
			),
            array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Description 1", 'river' ),
				"param_name" => "step_description_1",
				
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Link 1", 'river' ),
				"param_name" => "step_link_1",
				
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Step Link Target 1", 'river' ),
				"param_name" => "step_link_target_1",
				"value" => array(
					esc_html__( "Blank", 'river' ) => "_blank",
                    esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Parent", 'river' ) => "_parent",
					esc_html__( "Top", 'river' ) => "_top"
				),
				'save_always' => true,
				
            ),

            //second step config
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title 2", 'river' ),
				"param_name" => "title_2",
				
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Number 2", 'river' ),
				"param_name" => "step_number_2",
				
			),
            array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Description 2", 'river' ),
				"param_name" => "step_description_2",
				
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Link 2", 'river' ),
				"param_name" => "step_link_2",
				
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Step Link Target 2", 'river' ),
				"param_name" => "step_link_target_2",
				"value" => array(
					esc_html__( "Blank", 'river' ) => "_blank",
                    esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Parent", 'river' ) => "_parent",
					esc_html__( "Top", 'river' ) => "_top"
				),
				'save_always' => true,
				
            ),


            //third step config
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title 3", 'river' ),
				"param_name" => "title_3",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' ,'3', '4'))
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Number 3", 'river' ),
				"param_name" => "step_number_3",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' ,'3', '4'))
			),
            array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Description 3", 'river' ),
				"param_name" => "step_description_3",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' ,'3', '4'))
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Link 3", 'river' ),
				"param_name" => "step_link_3",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' ,'3', '4'))
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Step Link Target 3", 'river' ),
				"param_name" => "step_link_target_3",
				"value" => array(
					esc_html__( "Blank", 'river' ) => "_blank",
                    esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Parent", 'river' ) => "_parent",
					esc_html__( "Top", 'river' ) => "_top"
				),
				'save_always' => true,
				
            ),

            //fourth step config
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title 4", 'river' ),
				"param_name" => "title_4",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' , '4'))
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Number 4", 'river' ),
				"param_name" => "step_number_4",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' , '4'))
			),
            array(
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Description 4", 'river' ),
				"param_name" => "step_description_4",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' , '4'))
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Step Link 4", 'river' ),
				"param_name" => "step_link_4",
			
                "dependency" => array('element' => "number_of_steps", 'value' => array('' , '4'))
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Step Link Target 4", 'river' ),
				"param_name" => "step_link_target_4",
				"value" => array(
					esc_html__( "Blank", 'river' ) => "_blank",
                    esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Parent", 'river' ) => "_parent",
					esc_html__( "Top", 'river' ) => "_top"
				),
				'save_always' => true,
				
            )
		)
) );

// Image with text over
vc_map( array(
		"name" => esc_html__( "Image with text over", 'river' ),
		"base" => "image_with_text_over",
		"category" => esc_html__( 'by QODE', 'river' ),
		'admin_enqueue_css' => array(get_template_directory_uri().'/css/admin/vc-extend.css'),
		"icon" => "icon-wpb-image_with_text_over",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Image", 'river' ),
				"param_name" => "image"
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "title_color",
				
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Size", 'river' ),
				"param_name" => "title_size",
				
			),
            array(
				"type" => "dropdown",
				"class" => "",
				"heading" => esc_html__( "Title Tag", 'river' ),
				"param_name" => "title_tag",
				"value" => array(
                    ""   => "",
					esc_html__( "h2", 'river' ) => "h2",
					esc_html__( "h3", 'river' ) => "h3",
					esc_html__( "h4", 'river' ) => "h4",
					esc_html__( "h5", 'river' ) => "h5",
					esc_html__( "h6", 'river' ) => "h6",
				),
				
            ),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Subtitle", 'river' ),
				"param_name" => "subtitle",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Subtitle Color", 'river' ),
				"param_name" => "subtitle_color",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Line Color", 'river' ),
				"param_name" => "line_color",
				
			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<p>" . esc_html__( "I am test text for shortcode", 'river' ) . "</p>",
				
			)
		)
) );

/**
 * Service shortcode
 */
vc_map( array(
		"name" => esc_html__( "Service", 'river' ),
		"base" => "service",
		"category" => esc_html__( 'by QODE', 'river' ),
		"icon" => "icon-wpb-service",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Type", 'river' ),
				"param_name" => "type",
                                "value" => array(
					"" => "",
					esc_html__( "Top", 'river' ) => "top",
					esc_html__( "Left", 'river' ) => "left"
				)
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title", 'river' ),
				"param_name" => "title",
				
			),
			array(
				"type" => "colorpicker",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Title Color", 'river' ),
				"param_name" => "color",
				
			),
			array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link", 'river' ),
				"param_name" => "link",
				
			),
			array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Target", 'river' ),
				"param_name" => "target",
			
                                "value" => array(
					"" => "",
					esc_html__( "Self", 'river' ) => "_self",
					esc_html__( "Blank", 'river' ) => "_blank"
				)

			),
            array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Animate", 'river' ),
				"param_name" => "animate",
			
                "value" => array(
					"" => "",
					esc_html__( "Yes", 'river' ) => "yes",
					esc_html__( "No", 'river' ) => "no"
				)

			),
			array(
				"type" => "textarea_html",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Content", 'river' ),
				"param_name" => "content",
				"value" => "<p>" . esc_html__( "I am test text for shortcode", 'river' ) . "</p>",
				
			)
		)
) );

// Image hover
vc_map( array(
		"name" => esc_html__( "Image hover", 'river' ),
		"base" => "image_hover",
		"category" => esc_html__( 'by QODE', 'river' ),
		"icon" => "icon-wpb-image_hover",
		"allowed_container_element" => 'vc_row',
		"params" => array(
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Image", 'river' ),
				"param_name" => "image"
			),
			array(
				"type" => "attach_image",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Hover Image", 'river' ),
				"param_name" => "hover_image"
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Link", 'river' ),
				"param_name" => "link",
				
			),
            array(
				"type" => "dropdown",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Animation", 'river' ),
				"param_name" => "animation",
			
                "value" => array(
                    "" => "",
                    esc_html__( "Yes", 'river' ) => "yes",
                    esc_html__( "No", 'river' ) => "no"
                )
			),
            array(
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => esc_html__( "Transition delay", 'river' ),
				"param_name" => "transition_delay",
			
                "dependency" => array('element' => "animation", 'value' => array("yes"))
			)
		)
) );