<?php
$river_options = river_qode_return_global_options();

$header_in_grid = true;
if ( isset( $river_options['header_in_grid'] ) && $river_options['header_in_grid'] == "no" ) {
	$header_in_grid = false;
}

$menu_in_center = false;
if ( isset( $river_options['menu_in_center'] ) && $river_options['menu_in_center'] == "yes" ) {
	$menu_in_center = true;
}

$centered_logo = false;
if ( isset( $river_options['center_logo_image'] ) && $river_options['center_logo_image'] == "yes" ) {
	$centered_logo = true;
};

$display_header_top = "yes";
if ( isset( $river_options['header_top_area'] ) ) {
	$display_header_top = $river_options['header_top_area'];
}
if ( ! empty( $_SESSION['qode_header_top'] ) ) {
	$display_header_top = $_SESSION['qode_header_top'];
}

$header_top_area_scroll = "no";
if ( isset( $river_options['header_top_area_scroll'] ) ) {
	$header_top_area_scroll = $river_options['header_top_area_scroll'];
}

if ( ! empty( $_SESSION['qode_header_top'] ) ) {
	if ( $_SESSION['qode_header_top'] == "no" ) {
		$header_top_area_scroll = "no";
	}
	if ( $_SESSION['qode_header_top'] == "yes" ) {
		$header_top_area_scroll = "yes";
	}
}

$header_classes = array();

if ( $display_header_top == "yes" ) {
	$header_classes[] = 'has_top';
}

if ( $header_top_area_scroll == "yes" ) {
	$header_classes[] = "scroll_top";
}

if ( $centered_logo ) {
	$header_classes[] = "centered_logo";
}
?>
<header class="page_header <?php echo esc_attr( implode( ' ', $header_classes ) ); ?>">
	<div class="header_inner clearfix">
		
		<?php if($display_header_top == "yes"){ ?>
			<div class="header_top clearfix">
				<?php if($header_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
						<?php } ?>
						<div class="left">
							<div class="inner">
								<?php
								dynamic_sidebar('header_left');
								?>
							</div>
						</div>
						<div class="right">
							<div class="inner">
								<?php
								dynamic_sidebar('header_right');
								?>
							</div>
						</div>
						<?php if($header_in_grid){ ?>
					</div>
				</div>
			<?php } ?>
			</div>
		<?php } ?>
		<div class="header_bottom clearfix">
			<?php if($header_in_grid){ ?>
			<div class="container">
				<div class="container_inner clearfix">
					<?php } ?>
					<div class="header_inner_left">
						<?php if ( has_nav_menu( 'top-navigation' ) ) { ?>
							<div class="mobile_menu_button"><span><i class="icon-reorder"></i></span></div>
						<?php } ?>
						<div class="logo_wrapper">
							<div class="logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
									<img src="<?php echo esc_url( $river_options['logo_image'] ); ?>" alt="<?php esc_attr_e( 'Logo', 'river' ); ?>"/>
								</a>
							</div>
						</div>
					</div>
					<?php if(!$centered_logo) { ?>
						<div class="header_inner_right">
							<?php get_template_part( 'includes/modules/sidearea-opener' ); ?>
						</div>
					<?php } ?>
					<nav class="main_menu drop_down <?php if ( ! $menu_in_center ) { echo 'right'; } ?>">
						<?php
						wp_nav_menu( array(
							'theme_location'  => 'top-navigation',
							'container'       => '',
							'container_class' => '',
							'menu_class'      => '',
							'menu_id'         => '',
							'fallback_cb'     => 'river_qode_top_navigation_fallback',
							'link_before'     => '<span>',
							'link_after'      => '</span>',
							'walker'          => new river_qode_type1_walker_nav_menu()
						) );
						?>
					</nav>
					<?php if($centered_logo) { ?>
						<div class="header_inner_right">
							<?php get_template_part( 'includes/modules/sidearea-opener' ); ?>
						</div>
					<?php } ?>
					<nav class="mobile_menu">
						<?php
						wp_nav_menu( array( 'theme_location' => 'top-navigation' ,
						                    'container'  => '',
						                    'container_class' => '',
						                    'menu_class' => '',
						                    'menu_id' => '',
						                    'fallback_cb' => 'river_qode_top_navigation_fallback',
						                    'link_before' => '<span>',
						                    'link_after' => '</span>',
						                    'walker' => new river_qode_type2_walker_nav_menu()
						));
						?>
					</nav>
					<?php if($header_in_grid){ ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</header>