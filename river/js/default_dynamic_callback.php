<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
} elseif ( file_exists( $root.'/wp-config.php' ) ) {
    require_once( $root.'/wp-config.php' );
}
header('Content-type: application/x-javascript');
$river_options = river_qode_return_global_options();
?>

function ajaxSubmitCommentForm(){
	"use strict";

	var options = { 
		success: function(){
			$j("#commentform textarea").val("");
			$j("#commentform .success p").text("<?php esc_html_e('Comment has been sent!','river'); ?>");
		}
	}; 
	
	$j('#commentform').submit(function() {
		$j(this).find('input[type="submit"]').next('.success').remove();
		$j(this).find('input[type="submit"]').after('<div class="success"><p></p></div>');
		$j(this).ajaxSubmit(options); 
		return false; 
	}); 
}
var header_height = 82;
var min_header_height = 56;
<?php if(isset($river_options['header_height'])){ 
	if (!empty($river_options['header_height'])) { ?>
	
	header_height = <?php echo intval($river_options['header_height']); ?>;
	
	
<?php } } ?>
<?php if(isset($river_options['header_height_scroll'])){ 
	if (!empty($river_options['header_height_scroll'])) { ?>
	
	min_header_height = <?php echo intval($river_options['header_height_scroll']); ?>;
	
<?php } } ?>

	
var logo_height = header_height;
<?php if ( isset( $river_options['logo_image'] ) && ! empty( $river_options['logo_image'] ) ) {
	$image_dimension = river_qode_get_image_dimensions( $river_options['logo_image'] );
	
	if ( ! empty( $image_dimension ) ) { ?>
		logo_height  = <?php echo intval( $image_dimension['height'] ); ?>;
	<?php }
} ?>


<?php
if($river_options['enable_google_map'] != ""){
?>

var geocoder;
var map;

function initialize() {
	"use strict";
  // Create an array of styles.
<?php
$google_maps_color = "#324156";
if(isset($river_options['google_maps_color'])){
	if (!empty($river_options['google_maps_color']))
		$google_maps_color = $river_options['google_maps_color'];
}
?>
  var mapStyles = [
    {
      stylers: [
				{hue: "<?php echo esc_attr($google_maps_color); ?>" },
				{saturation: -60},
				{lightness: -20},
				{gamma: 1.51}
			]
    }
  ];
  var qodeMapType = new google.maps.StyledMapType(mapStyles,
    {name: "Qode Map"});

	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(-34.397, 150.644);
	var myOptions = {
<?php
$google_maps_scroll_wheel = false;
if(isset($river_options['google_maps_scroll_wheel'])){
	if ($river_options['google_maps_scroll_wheel'] == "yes")
		$google_maps_scroll_wheel = true;
}
$google_maps_zoom = 12;
if(isset($river_options['google_maps_zoom'])){
	if (intval($river_options['google_maps_zoom']) > 0)
		$google_maps_zoom = intval($river_options['google_maps_zoom']);
}
?>
		zoom: <?php echo esc_attr($google_maps_zoom); ?>,
		<?php if (!$google_maps_scroll_wheel) { ?>
		scrollwheel: false,
		<?php } ?>
		center: latlng,
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL,
			position: google.maps.ControlPosition.RIGHT_CENTER
		},
		scaleControl: false,
			scaleControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		streetViewControl: false,
			streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		panControl: false,
		panControlOptions: {
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		mapTypeControl: false,
		mapTypeControlOptions: {
			mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'qode_style'],
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.LEFT_CENTER
		},
<?php
$google_maps_style = true;
if(isset($river_options['google_maps_style'])){
	if ($river_options['google_maps_style'] == "no")
		$google_maps_style = false;
}
?>
		<?php if ($google_maps_style) { ?>
		mapTypeId: 'qode_style'
		<?php } else { ?>
		mapTypeId: google.maps.MapTypeId.ROADMAP
		<?php } ?>
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	<?php if ($google_maps_style) { ?>
  map.mapTypes.set('qode_style', qodeMapType);
	<?php } ?>
}

function codeAddress(data) {
	"use strict";
	
	if (data === '')
		return;

	var contentString = '<div id="content"><div id="siteNotice"></div><div id="bodyContent"><p>'+data+'</p></div></div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});
	geocoder.geocode( { 'address': data}, function(results, status) {
		if (status === google.maps.GeocoderStatus.OK) {
			map.setCenter(results[0].geometry.location);
			var marker = new google.maps.Marker({
				map: map, 
				position: results[0].geometry.location,
				<?php if(isset($river_options['google_maps_pin_image'])){ ?>
				icon:  '<?php echo esc_attr($river_options['google_maps_pin_image']); ?>',
				<?php } ?>
				title: data['store_title']
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
			});
			//infowindow.open(map,marker);
		}
	});
}

var $j = jQuery.noConflict();

$j(document).ready(function() {
	"use strict";

	showContactMap();
});
<?php
}
?>

function showContactMap() {
	"use strict";
	
	if($j("#map_canvas").length > 0 && typeof google === 'object'){
		initialize();
		codeAddress('<?php if(isset($river_options['google_maps_address5'])) { echo esc_attr($river_options['google_maps_address5']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address4'])) { echo esc_attr($river_options['google_maps_address4']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address3'])) { echo esc_attr($river_options['google_maps_address3']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address2'])) { echo esc_attr($river_options['google_maps_address2']); } ?>');
		codeAddress('<?php if(isset($river_options['google_maps_address'])) { echo esc_attr($river_options['google_maps_address']); } ?>');
	}
}

var no_ajax_pages = [];
var root = '<?php echo esc_url( home_url( '/' ) ); ?>';
var theme_root = '<?php echo QODE_ROOT; ?>/';
<?php if($river_options['parallax_speed'] != ''){ ?>
var parallax_speed = <?php echo esc_attr($river_options['parallax_speed']); ?>;
<?php }else{ ?>
var parallax_speed = 1;
<?php } ?>

<?php
	if(class_exists('Woocommerce')){
		$shop_id = get_option('woocommerce_shop_page_id'); 
		$cart_id = get_option('woocommerce_cart_page_id'); 
		$checkout_id = get_option('woocommerce_checkout_page_id');
		$pay_id = get_option(' woocommerce_pay_page_id '); 
		$thanks_id = get_option(' woocommerce_thanks_page_id '); 
		$myacount_id = get_option(' woocommerce_myaccount_page_id '); 
		$edit_address_id = get_option(' woocommerce_edit_address_page_id '); 
		$view_order_id = get_option(' woocommerce_view_order_page_id '); 
		$terms_id = get_option(' woocommerce_terms_page_id ');
		
		$woo_pages = get_posts(array('post_type' => 'product','post_status' => 'publish', 'posts_per_page' => '-1') );
	        
	    foreach($woo_pages as $page){		
			$woo_page_id = $page->ID;
?>
			no_ajax_pages.push('<?php echo get_permalink($woo_page_id) ?>');	
<?php			
		}
?>
			no_ajax_pages.push('<?php echo get_permalink($shop_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($cart_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($checkout_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($pay_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($thanks_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($myacount_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($edit_address_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($view_order_id) ?>');
			no_ajax_pages.push('<?php echo get_permalink($terms_id) ?>');
<?php
	}
?>

<?php 
$pages = get_pages(); 
foreach ($pages as $page) {
	if(get_post_meta($page->ID, "qode_show-animation", true) == "no_animation") :
?>
		no_ajax_pages.push('<?php echo get_permalink($page->ID) ?>');
<?php
	endif;
}

if(function_exists('icl_get_languages')) { 
	$language_pages = icl_get_languages('skip_missing=0');
		foreach($language_pages as $language_page) {
?>
			no_ajax_pages.push('<?php echo esc_attr($language_page["url"]); ?>');
				
<?php } }

if (isset($river_options['internal_no_ajax_links'])) {
	foreach (explode(',', $river_options['internal_no_ajax_links']) as $no_ajax_link) {
?>
		no_ajax_pages.push('<?php echo trim($no_ajax_link); ?>');
<?php
	}
}
?>