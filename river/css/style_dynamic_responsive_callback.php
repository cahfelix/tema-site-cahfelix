<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header("Content-type: text/css; charset=utf-8");
$river_options = river_qode_return_global_options();
?>
@media only screen and (max-width: 1000px){
	<?php if (!empty($river_options['header_background_color'])) { ?>
	.header_bottom {
		background-color: <?php echo esc_attr($river_options['header_background_color']);  ?>;
	}
	<?php } ?>
}
@media only screen and (min-width: 480px) and (max-width: 768px){
	
	<?php if (isset($river_options['parallax_minheight']) && !empty($river_options['parallax_minheight'])) { ?>
	.parallax section{
		height: auto !important;
		min-height: <?php echo intval($river_options['parallax_minheight']); ?>px;
	}
	<?php } ?>
	
	<?php if (isset($river_options['header_background_color_mobile']) &&  !empty($river_options['header_background_color_mobile'])) { ?>
	header
	{
		 background-color: <?php echo esc_attr($river_options['header_background_color_mobile']);  ?> !important;
		 background-image:none;
	}
	<?php } ?>
}

@media only screen and (max-width: 480px){
	
	<?php if (isset($river_options['parallax_minheight']) && !empty($river_options['parallax_minheight'])) { ?>
	.parallax section{
		height: auto !important;
		min-height: <?php echo intval($river_options['parallax_minheight']); ?>px;
	}
	<?php } ?>
	
	
	<?php if (isset($river_options['header_background_color_mobile']) &&  !empty($river_options['header_background_color_mobile'])) { ?>
	header
	{
		 background-color: <?php echo esc_attr($river_options['header_background_color_mobile']);  ?> !important;
		 background-image:none;
	}
	<?php } ?>
}