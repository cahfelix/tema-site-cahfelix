<?php
$river_options     = river_qode_return_global_options();
$enable_side_area = "yes";

if ( isset( $river_options['enable_side_area'] ) && $river_options['enable_side_area'] == "no" ) {
	$enable_side_area = "no";
}
?>

<div class="side_menu_button_wrapper right">
	<div class="side_menu_button">
		<?php if ( $enable_side_area != "no" && is_active_sidebar( 'sidearea' ) ) { ?>
			<a href="javascript:void(0)"><i class="icon-reorder"></i></a>
		<?php } ?>
	</div>
</div>