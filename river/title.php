<?php
$river_options = river_qode_return_global_options();
$qode_page_id  = river_qode_get_page_id();

if ( get_post_meta( $qode_page_id, "qode_responsive-title-image", true ) != "" ) {
	$responsive_title_image = get_post_meta( $qode_page_id, "qode_responsive-title-image", true );
} else {
	$responsive_title_image = $river_options['responsive_title_image'];
}

if ( get_post_meta( $qode_page_id, "qode_fixed-title-image", true ) != "" ) {
	$fixed_title_image = get_post_meta( $qode_page_id, "qode_fixed-title-image", true );
} else {
	$fixed_title_image = $river_options['fixed_title_image'];
}

if ( get_post_meta( $qode_page_id, "qode_title-image", true ) != "" ) {
	$title_image = get_post_meta( $qode_page_id, "qode_title-image", true );
} else {
	$title_image = $river_options['title_image'];
}

if ( get_post_meta( $qode_page_id, "qode_title-height", true ) != "" ) {
	$title_height = get_post_meta( $qode_page_id, "qode_title-height", true );
} else {
	$title_height = $river_options['title_height'];
}

$title_background_color = '';
if ( get_post_meta( $qode_page_id, "qode_page-title-background-color", true ) != "" ) {
	$title_background_color = get_post_meta( $qode_page_id, "qode_page-title-background-color", true );
} else {
	$title_background_color = $river_options['title_background_color'];
}

$show_title_image = true;
if ( get_post_meta( $qode_page_id, "qode_show-page-title-image", true ) ) {
	$show_title_image = false;
}

$qode_page_title_style = "1";
if ( get_post_meta( $qode_page_id, "qode_page_title_style", true ) != "" ) {
	$qode_page_title_style = get_post_meta( $qode_page_id, "qode_page_title_style", true );
} else {
	if ( isset( $river_options['title_style'] ) ) {
		$qode_page_title_style = $river_options['title_style'];
	} else {
		$qode_page_title_style = "1";
	}
}

$title_classes = array();

if ( $qode_page_title_style == "2" ) {
	$title_classes[] = "with_breadcrumbs";
} else {
	$title_classes[] = "standard";
}

if ( $responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes" && $show_title_image == true ) {
	$title_classes[] = 'has_fixed_background';
}

if ( $responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true ) {
	$title_classes[] = 'has_background';
}

if ( $responsive_title_image == 'yes' && $show_title_image == true ) {
	$title_classes[] = 'with_image';
}

$title             = get_the_title( $qode_page_id );
$enable_page_title = get_post_meta( $qode_page_id, "qode_page-title-text", true );
if ( is_home() && is_front_page() ) {
	$title = get_option( 'blogname' );
} elseif ( is_tag() ) {
	$title = single_term_title( '', false ) . esc_html__( ' Tag', 'river' );
} elseif ( is_date() ) {
	$title = get_the_time( 'F Y' );
} elseif ( is_author() ) {
	$title = esc_html__( 'Author: ', 'river' ) . get_the_author();
} elseif ( is_category() ) {
	$title = single_cat_title( '', false );
} elseif ( is_archive() ) {
	$title = esc_html__( 'Archive', 'river' );
} elseif ( is_search() ) {
	$title = esc_html__( 'Search: ', 'river' ) . get_search_query();
} elseif ( is_404() ) {
	$title = $river_options['404_title'] !== '' ? $river_options['404_title'] : esc_html__( '404', 'river' );
} elseif ( is_singular( 'post' ) && empty( $enable_page_title ) ) {
	$title = esc_html__( 'Blog', 'river' );
}

$title_styles = array();
if ( $responsive_title_image == 'no' && ! empty( $title_image ) && $show_title_image == true ) {
	if (isset($title_image_width) && $title_image_width != '' ) {
		$title_styles[] = 'background-size:' . intval( $title_image_width ) . 'px auto;';
	}
	
	$title_styles[] = 'background-image:url(' . esc_url( $title_image ) . ');';
}

if ( $title_height != '' ) {
	$title_styles[] = 'height:' . intval( $title_height ) . 'px;';
}

if ( $title_background_color != '' ) {
	$title_styles[] = 'background-color:' . $title_background_color . ';';
}

$title_label_styles = array();
if ( get_post_meta( $qode_page_id, "qode_page-title-color", true ) != "" ) {
	$title_label_styles[] = 'color: ' . get_post_meta( $qode_page_id, "qode_page-title-color", true );
}

$subtitle_text = get_post_meta( $qode_page_id, "qode_page_subtitle", true );
if ( is_404() ) {
	if ( isset( $river_options['404_subtitle'] ) && $river_options['404_subtitle'] != "" ) {
		$subtitle_text = $river_options['404_subtitle'];
	} else {
		$subtitle_text = esc_html__( 'Page not found', 'river' );
	}
}

$subtitle_styles = array();
if ( get_post_meta( $qode_page_id, "qode_page_subtitle_color", true ) != "" ) {
	$subtitle_styles[] = 'color: ' . get_post_meta( $qode_page_id, "qode_page_subtitle_color", true );
}

if ( ! get_post_meta( $qode_page_id, "qode_show-page-title", true ) ) { ?>
	<div class="title <?php echo esc_attr( implode( ' ', $title_classes ) ); ?>" <?php river_qode_inline_style( $title_styles ); ?>>
		<?php if ( $responsive_title_image == 'yes' && ! empty( $title_image ) && $show_title_image == true ) { ?>
			<img src="<?php echo esc_url( $title_image ); ?>" alt="<?php esc_attr_e( 'Title Image', 'river' ); ?>" />
		<?php } ?>
		<?php if(!get_post_meta($qode_page_id, "qode_show-page-title-text", true)) { ?>
			<div class="title_holder">
				<div class="container">
					<div class="container_inner clearfix">
						<?php if ( $qode_page_title_style == "2" ) { ?>
							<?php river_qode_custom_breadcrumbs(); ?>
							<?php if ( ! empty( $subtitle_text ) ) { ?>
								<span class="subtitle" <?php river_qode_inline_style( $subtitle_styles ); ?>><?php echo wp_kses_post( $subtitle_text ); ?></span>
							<?php } ?>
						<?php } else { ?>
							<?php if ( ! empty( $subtitle_text ) ) { ?>
								<h6 class="subtitle" <?php river_qode_inline_style( $subtitle_styles ); ?>><?php echo wp_kses_post( $subtitle_text ); ?></h6>
							<?php } ?>
							<h1 <?php river_qode_inline_style( $title_label_styles ); ?>><?php echo wp_kses_post( $title ); ?></h1>
							<span class="separator small"></span>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>