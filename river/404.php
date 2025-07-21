<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>

<div class="container">
	<div class="container_inner">
		<div class="page_not_found">
			<h2><?php if ( $qode_options_river['404_text'] != "" ): echo wp_kses_post( $qode_options_river['404_text'] ); else: ?><?php esc_html_e( 'The page you requested does not exist', 'river' ); ?><?php endif; ?></h2>
			<p>
				<a class="qbutton with-shadow" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php if ( $qode_options_river['404_backlabel'] != "" ): echo wp_kses_post( $qode_options_river['404_backlabel'] ); else: ?><?php esc_html_e( 'Back to homepage', 'river' ); ?><?php endif; ?></a>
			</p>
		</div>
	</div>
</div>

<?php get_footer(); ?>	