<?php
$river_qode_toolbar = river_qode_return_toolbar_variable();

if ( isset( $river_qode_toolbar ) ) { ?>
	<div id="panel" style="margin-left: -318px;">
		<div id="panel-admin">
			<h6><?php esc_html_e( 'THEME OPTIONS', 'river' ); ?></h6>
			<div class="panel-admin-box">
				<div class="accordion_toolbar">
					<p class="accordion_toolbar_header"><?php esc_html_e( 'Header Top Menu ', 'river' ); ?><i class="icon icon-angle-down"></i></p>
					<div class="accordion_toolbar_content">
						<ul id="tootlbar_header_top">
							<li data-value="yes"><?php esc_html_e( 'Yes', 'river' ); ?></li>
							<li data-value="no"><?php esc_html_e( 'No', 'river' ); ?></li>
						</ul>
					</div>
					<p class="accordion_toolbar_header"><?php esc_html_e( 'Smooth Scroll ', 'river' ); ?><i class="icon icon-angle-down"></i></p>
					<div class="accordion_toolbar_content">
						<ul id="tootlbar_smooth_scroll">
							<li data-value="yes"><?php esc_html_e( 'Yes', 'river' ); ?></li>
							<li data-value="no"><?php esc_html_e( 'No', 'river' ); ?></li>
						</ul>
					</div>
					<p class="accordion_toolbar_header"><?php esc_html_e( 'Boxed Layout ', 'river' ); ?><i class="icon icon-angle-down"></i></p>
					<div class="accordion_toolbar_content">
						<ul id="tootlbar_boxed">
							<li data-value="boxed"><?php esc_html_e( 'Yes', 'river' ); ?></li>
							<li data-value=""><?php esc_html_e( 'No', 'river' ); ?></li>
						</ul>
					</div>
					<p class="accordion_toolbar_header"><?php esc_html_e( 'Choose Background ', 'river' ); ?><i class="icon icon-angle-down"></i></p>
					<div class="accordion_toolbar_content">
						<ul id="tootlbar_background">
							<li data-value="background1"><?php esc_html_e( 'Background 1', 'river' ); ?></li>
							<li data-value="background2"><?php esc_html_e( 'Background 2', 'river' ); ?></li>
							<li data-value="background3"><?php esc_html_e( 'Background 3', 'river' ); ?></li>
						</ul>
					</div>
					<p class="accordion_toolbar_header"><?php esc_html_e( 'Choose Pattern ', 'river' ); ?><i class="icon icon-angle-down"></i></p>
					<div class="accordion_toolbar_content">
						<ul id="tootlbar_pattern">
							<li data-value="pattern11"><?php esc_html_e( 'Retina Wood', 'river' ); ?></li>
							<li data-value="pattern12"><?php esc_html_e( 'Retina Wood Grey', 'river' ); ?></li>
							<li data-value="pattern1"><?php esc_html_e( 'Transparent', 'river' ); ?></li>
							<li data-value="pattern3"><?php esc_html_e( 'Cubes', 'river' ); ?></li>
							<li data-value="pattern4"><?php esc_html_e( 'Diamond', 'river' ); ?></li>
							<li data-value="pattern5"><?php esc_html_e( 'Escheresque', 'river' ); ?></li>
							<li data-value="pattern10"><?php esc_html_e( 'Whitediamond', 'river' ); ?></li>
						</ul>
					</div>
					<p class="accordion_toolbar_header"><?php esc_html_e( 'Colors ', 'river' ); ?><i class="icon icon-angle-down"></i></p>
					<div class="accordion_toolbar_content">
						<div id="tootlbar_colors">
							<ul>
								<li><div class="color active color1" data-color="#f54325" style="background-color:#f54325;"><span><?php esc_html_e( 'Red', 'river' ); ?></span></div></li>
								<li><div class="color color2" data-color="#7e2948" style="background-color:#7e2948;"><span><?php esc_html_e( 'Purple', 'river' ); ?></span></div></li>
								<li><div class="color color3" data-color="#f6c500" style="background-color:#f6c500;"><span><?php esc_html_e( 'Yellow', 'river' ); ?></span></div></li>
								<li><div class="color color4" data-color="#d1d946" style="background-color:#d1d946;"><span><?php esc_html_e( 'Green', 'river' ); ?></span></div></li>
								<li><div class="color color5" data-color="#01c0ec" style="background-color:#01c0ec;"><span><?php esc_html_e( 'Blue', 'river' ); ?></span></div></li>
								<li><div class="color color6" data-color="#e2e1cc" style="background-color:#e2e1cc;"><span><?php esc_html_e( 'Gray', 'river' ); ?></span></div></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a class="open" href="#"><span><i class="icon-angle-right"></i><i class="icon-angle-left"></i></span></a>
	
	</div>
<?php } ?>