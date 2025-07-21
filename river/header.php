<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	
	<?php
	/**
	 * river_qode_action_header_meta hook
	 *
	 * @see river_core_header_meta() - hooked with 10
	 * @see river_qode_user_scalable_meta() - hooked with 10
	 */
	do_action( 'river_qode_action_header_meta' );
	?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11"/>
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php get_template_part( 'includes/modules/preloader' ); ?>
	<?php get_template_part( 'includes/modules/sidearea' ); ?>
	<div class="wrapper">
	<div class="wrapper_inner">
		<?php do_action( 'river_qode_after_wrapper_inner_begin' ); ?>
		
		<?php get_template_part( 'includes/modules/header' ); ?>
		<?php get_template_part( 'includes/modules/back-to-top' ); ?>
		<div class="content">
			<?php do_action( 'river_qode_after_content_begin' ); ?>
				<div class="<?php echo esc_attr( apply_filters( 'river_qode_content_classes', 'content_inner' ) ); ?>">