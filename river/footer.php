<?php
$river_options = river_qode_return_global_options();
$qode_page_id  = river_qode_get_page_id();

$content_bottom_area = "yes";
if(get_post_meta($qode_page_id, "qode_enable_content_bottom_area", true) != ""){
	$content_bottom_area = get_post_meta($qode_page_id, "qode_enable_content_bottom_area", true);
} else{
	if (isset($river_options['enable_content_bottom_area'])) { 
		$content_bottom_area = $river_options['enable_content_bottom_area'];
	}
}
$content_bottom_area_sidebar = "";
if(get_post_meta($qode_page_id, 'qode_choose_content_bottom_sidebar', true) != ""){
	$content_bottom_area_sidebar = get_post_meta($qode_page_id, 'qode_choose_content_bottom_sidebar', true);
} else {
	if(isset($river_options['content_bottom_sidebar_custom_display'])) {
		$content_bottom_area_sidebar = $river_options['content_bottom_sidebar_custom_display'];
	}
}
$content_bottom_area_in_grid = true;
if(get_post_meta($qode_page_id, 'qode_content_bottom_sidebar_in_grid', true) != ""){
	if(get_post_meta($qode_page_id, 'qode_content_bottom_sidebar_in_grid', true) == "yes") {
		$content_bottom_area_in_grid = true;
	} else {
		$content_bottom_area_in_grid = false;
	} 
}
else {
	if(isset($river_options['content_bottom_in_grid'])){if ($river_options['content_bottom_in_grid'] == "no") $content_bottom_area_in_grid = false;}
}
$content_bottom_background_color = '';
if(get_post_meta($qode_page_id, "qode_content_bottom_background_color", true) != ""){
	$content_bottom_background_color = get_post_meta($qode_page_id, "qode_content_bottom_background_color", true);
}
?>
	<?php if($content_bottom_area == "yes") { ?>
	<?php if($content_bottom_area_in_grid){ ?>
		<div class="container">
			<div class="container_inner clearfix">
	<?php } ?>
		<div class="content_bottom" <?php if($content_bottom_background_color != ''){ echo 'style="background-color:'.$content_bottom_background_color.';"'; } ?>>
			<?php dynamic_sidebar($content_bottom_area_sidebar); ?>
		</div>
		<?php if($content_bottom_area_in_grid){ ?>
					</div>
				</div>
			<?php } ?>
	<?php } ?>
	</div>
</div>
<?php
$display_footer_top = true;
if ( isset( $river_options['show_footer_top'] ) && $river_options['show_footer_top'] == "no" ) {
	$display_footer_top = false;
}

$footer_top_flag = false;

//check footer columns.If they are empty, disable footer top
for ( $i = 1; $i <= 4; $i ++ ) {
	$footer_columns_id = 'footer_column_' . $i;
	if ( is_active_sidebar( $footer_columns_id ) ) {
		$footer_top_flag = true;
		break;
	}
}

$display_footer_text = isset($river_options['footer_text']) && $river_options['footer_text'] == "yes";
?>
<?php if ( ($display_footer_top && $footer_top_flag ) || ( $display_footer_text && is_active_sidebar( 'footer_text' ) ) ) { ?>
	<footer>
		<?php if ( $display_footer_top && $footer_top_flag ) { ?>
		<div class="footer_top_holder">
			<div class="footer_top">
				<div class="container">
					<div class="container_inner">
						<div class="four_columns clearfix">
							<div class="column1">
								<div class="column_inner">
									<?php dynamic_sidebar( 'footer_column_1' ); ?>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									<?php dynamic_sidebar( 'footer_column_2' ); ?>
								</div>
							</div>
							<div class="column3">
								<div class="column_inner">
									<?php dynamic_sidebar( 'footer_column_3' ); ?>
								</div>
							</div>
							<div class="column4">
								<div class="column_inner">
									<?php dynamic_sidebar( 'footer_column_4' ); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php if ( $display_footer_text && is_active_sidebar( 'footer_text' ) ): ?>
		<div class="footer_bottom_holder">
			<div class="footer_bottom">
				<?php dynamic_sidebar( 'footer_text' ); ?>
			</div>
		</div>
		<?php endif; ?>
	</footer>
<?php } ?>
</div>
</div>
<?php include_once QODE_INCLUDES_ROOT_DIR . '/modules/toolbar.php'; ?>
<?php wp_footer(); ?>
</body>
</html>