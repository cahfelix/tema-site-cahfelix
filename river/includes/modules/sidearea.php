<?php
$river_options    = river_qode_return_global_options();
$enable_side_area = "yes";

if ( isset( $river_options['enable_side_area'] ) && $river_options['enable_side_area'] == "no" ) {
	$enable_side_area = "no";
}

if ( $enable_side_area != "no" && is_active_sidebar( 'sidearea' ) ) { ?>
	<section class="side_menu right">
		<div class="side_menu_title">
			<?php if ( isset( $river_options['side_area_title'] ) && $river_options['side_area_title'] != "" ) {
				echo '<h3>' . wp_kses_post( $river_options['side_area_title'] ) . '</h3>';
			} ?>
		</div>
		<?php dynamic_sidebar( 'sidearea' ); ?>
	</section>
<?php } ?>