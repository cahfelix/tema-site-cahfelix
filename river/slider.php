<?php
$river_revslider = get_post_meta( river_qode_get_page_id(), "qode_revolution-slider", true );

if ( ! empty( $river_revslider ) ) { ?>
	<div class="slider">
		<div class="slider_inner">
			<?php echo do_shortcode( $river_revslider ); ?>
		</div>
	</div>
	<?php
}
?>