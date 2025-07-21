<?php
$river_options = river_qode_return_global_options();

$loading_animation = true;
if ( isset( $river_options['loading_animation'] ) && $river_options['loading_animation'] == "off" ) {
	$loading_animation = false;
}

if ( isset( $river_options['loading_image'] ) && $river_options['loading_image'] != "" ) {
	$loading_image = $river_options['loading_image'];
} else {
	$loading_image = "";
}
?>
<?php if ( $loading_animation ) { ?>
	<div class="ajax_loader">
		<div class="ajax_loader_1">
			<?php if ( $loading_image != "" ) { ?>
				<div class="ajax_loader_2"><img src="<?php echo esc_url( $loading_image ); ?>" alt="<?php esc_attr_e( 'Preloader image', 'river' ); ?>"/></div>
			<?php } else { ?>
				<div class="ajax_loader_html"></div>
			<?php } ?>
		</div>
	</div>
<?php } ?>