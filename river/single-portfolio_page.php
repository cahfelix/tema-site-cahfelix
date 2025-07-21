<?php
$river_options = river_qode_return_global_options();
$qode_page_id  = get_the_ID();

$porftolio_template = 1;
if(get_post_meta($qode_page_id, "qode_choose-portfolio-single-view", true) != ""){
	if(get_post_meta($qode_page_id, "qode_choose-portfolio-single-view", true) == 1){
		$porftolio_template = 1;
	}elseif(get_post_meta($qode_page_id, "qode_choose-portfolio-single-view", true) == 2){
		$porftolio_template = 2;
	}elseif(get_post_meta($qode_page_id, "qode_choose-portfolio-single-view", true) == 3){
		$porftolio_template = 3;
	}elseif(get_post_meta($qode_page_id, "qode_choose-portfolio-single-view", true) == 4){
		$porftolio_template = 4;
	}elseif(get_post_meta($qode_page_id, "qode_choose-portfolio-single-view", true) == 5){
		$porftolio_template = 5;
	}elseif(get_post_meta($qode_page_id, "qode_choose-portfolio-single-view", true) == 6){
		$porftolio_template = 6;
	}
}elseif(isset($river_options['portfolio_style'])){
	if($river_options['portfolio_style'] == 1){
		$porftolio_template = 1;
	}elseif($river_options['portfolio_style'] == 2){
		$porftolio_template = 2;
	}elseif($river_options['portfolio_style'] == 3){
		$porftolio_template = 3;
	}elseif($river_options['portfolio_style'] == 4){
		$porftolio_template = 4;
	}elseif($river_options['portfolio_style'] == 5){
		$porftolio_template = 5;
	}elseif($river_options['portfolio_style'] == 6){
		$porftolio_template = 6;
	}
}
?>
<?php get_header(); ?>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'title' ); ?>
			<?php get_template_part( 'slider' ); ?>
			<div class="container">
				<div class="container_inner clearfix">
					<div class="portfolio_single">
						<?php switch ($porftolio_template) {
						case 1: ?>
						<div class="two_columns_66_33 clearfix portfolio_container">
							<div class="column1">
								<div class="column_inner">
									<div class="portfolio_images">
										<?php echo river_qode_return_portfolio_single_media( $porftolio_template ); ?>
									</div>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									<div class="portfolio_detail portfolio_single_follow clearfix">
									<?php
									$portfolios = get_post_meta($qode_page_id, "qode_portfolios", true);
									if ($portfolios){
										usort($portfolios, "river_qode_compare_portfolio_options");
										foreach($portfolios as $portfolio){	
										?>
											<div class="info">
											<?php if($portfolio['optionLabel'] != ""): ?>
											<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
											<?php endif; ?>
											<p>
												<?php if($portfolio['optionUrl'] != ""): ?>
													<a href="<?php echo esc_url($portfolio['optionUrl']); ?>" target="_blank">
													<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
													</a>
												<?php else:?>
													<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
												<?php endif; ?>
											</p>
											</div>
										<?php						
										}
									}
									?>
									<?php if(get_post_meta($qode_page_id, "qode_portfolio_date", true)) : ?>
										<div class="info">
											<h6><?php esc_html_e('Date','river'); ?></h6>
											<p><?php echo get_post_meta($qode_page_id, "qode_portfolio_date", true); ?></p>
										</div>
									<?php endif; ?>
									<div class="info">
										<h6><?php esc_html_e('CATEGORY ','river'); ?></h6>
									 <span class="category">
									 <?php
										$terms = wp_get_post_terms($qode_page_id,'portfolio_category');
										$counter = 0;
										$all = count($terms);
										foreach($terms as $term) {
											$counter++;
											if($counter < $all){ $after = ', ';}
											else{ $after = ''; }
											echo wp_kses_post($term->name.$after);
										}
										?>
										</span>
									 </div>
										<h6><?php esc_html_e('ABOUT','river'); ?></h6>
										<?php the_content(); ?>
										<?php if( river_qode_is_like_enabled( true ) ) { ?>
											<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
										<?php } ?>
										<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
									</div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="icon-chevron-left"></i>'); ?></div>
							<?php if(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true)); ?>"><i class="icon-th"></i></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link','<i class="icon-chevron-right"></i>'); ?></div>
						</div>
						
						<?php	break;
						case 2: ?>
						<div class="two_columns_66_33 clearfix portfolio_container">
							<div class="column1">
								<div class="column_inner">
									<div class="flexslider">
										<ul class="slides">
											<?php echo river_qode_return_portfolio_single_media( $porftolio_template ); ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									<div class="portfolio_detail">
										<?php
										$portfolios = get_post_meta($qode_page_id, "qode_portfolios", true);
										if ($portfolios){
											usort($portfolios, "river_qode_compare_portfolio_options");
											foreach($portfolios as $portfolio){	
											
											?>
												<div class="info">
												<?php if($portfolio['optionLabel'] != ""): ?>
												<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
												<?php endif; ?>
												<p>
													<?php if($portfolio['optionUrl'] != ""): ?>
														<a href="<?php echo esc_url($portfolio['optionUrl']); ?>" target="_blank">
														<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
														</a>
													<?php else:?>
														<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
													<?php endif; ?>
												</p>
												</div>
											<?php						
											}
										}
										?>
										<?php if(get_post_meta($qode_page_id, "qode_portfolio_date", true)) : ?>
										<div class="info">
											<h6><?php esc_html_e('Date','river'); ?></h6>
											<p><?php echo get_post_meta($qode_page_id, "qode_portfolio_date", true); ?></p>
										</div>
										<?php endif; ?>
										<div class="info">
											<h6><?php esc_html_e('CATEGORY ','river'); ?></h6>
										 <span class="category">
										 <?php
											$terms = wp_get_post_terms($qode_page_id,'portfolio_category');
											$counter = 0;
											$all = count($terms);
											foreach($terms as $term) {
												$counter++;
												if($counter < $all){ $after = ', ';}
												else{ $after = ''; }
												echo wp_kses_post($term->name.$after);
											}
											?>
											</span>
										 </div>
										<h6><?php esc_html_e('ABOUT','river'); ?></h6>
										<?php the_content(); ?>
										<?php if( river_qode_is_like_enabled( true ) ) { ?>
											<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
										<?php } ?>
										<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
									</div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="icon-chevron-left"></i>'); ?></div>
							<?php if(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true)); ?>"><i class="icon-th"></i></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link','<i class="icon-chevron-right"></i>'); ?></div>
						</div>
						
						<?php	break;
						case 3: ?>		
						<div class="flexslider">
							<ul class="slides">
								<?php echo river_qode_return_portfolio_single_media( $porftolio_template ); ?>
							</ul>
						</div>
						<div class="two_columns_75_25 clearfix portfolio_container">
							<div class="column1">
								<div class="column_inner">
									<div class="portfolio_single_text_holder">
										<h6><?php esc_html_e('ABOUT','river'); ?></h6>
										<?php the_content(); ?>
										<?php if( river_qode_is_like_enabled( true ) ) { ?>
											<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
										<?php } ?>
										<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
									</div>
								</div>
							</div>
							<div class="column2">
								<div class="column_inner">
									<div class="portfolio_detail">
										<?php
										$portfolios = get_post_meta($qode_page_id, "qode_portfolios", true);
										if ($portfolios){
											usort($portfolios, "river_qode_compare_portfolio_options");
											foreach($portfolios as $portfolio){	
											?>
												<div class="info">
												<?php if($portfolio['optionLabel'] != ""): ?>
												<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
												<?php endif; ?>
												<p>
													<?php if($portfolio['optionUrl'] != ""): ?>
														<a href="<?php echo esc_url($portfolio['optionUrl']); ?>" target="_blank">
														<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
														</a>
													<?php else:?>
														<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
													<?php endif; ?>
												</p>
												</div>
											<?php						
											}
										}
										?>
										<?php if(get_post_meta($qode_page_id, "qode_portfolio_date", true)) : ?>
										<div class="info">
											<h6><?php esc_html_e('Date','river'); ?></h6>
											<p><?php echo get_post_meta($qode_page_id, "qode_portfolio_date", true); ?></p>
										</div>
										<?php endif; ?>
										<div class="info">
											<h6><?php esc_html_e('CATEGORY ','river'); ?></h6>
										 <span class="category">
										 <?php
											$terms = wp_get_post_terms($qode_page_id,'portfolio_category');
											$counter = 0;
											$all = count($terms);
											foreach($terms as $term) {
												$counter++;
												if($counter < $all){ $after = ', ';}
												else{ $after = ''; }
												echo wp_kses_post($term->name.$after);
											}
											?>
											</span>
										 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="portfolio_navigation">
							<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="icon-chevron-left"></i>'); ?></div>
							<?php if(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true) != ""){ ?>
								<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true)); ?>"><i class="icon-th"></i></a></div>
							<?php } ?>
							<div class="portfolio_next"><?php next_post_link('%link','<i class="icon-chevron-right"></i>'); ?></div>
						</div>
						
						<?php	break;
						case 4: ?>		
							<?php the_content(); ?>
							<div class="info">
								<p><?php esc_html_e('CATEGORY ','river'); ?>
							 <span class="category">
							 <?php
								$terms = wp_get_post_terms($qode_page_id,'portfolio_category');
								$counter = 0;
								$all = count($terms);
								foreach($terms as $term) {
									$counter++;
									if($counter < $all){ $after = ', ';}
									else{ $after = ''; }
									echo wp_kses_post($term->name.$after);
								}
								?>
								</span>
								</p>
								<?php if( river_qode_is_like_enabled( true ) ) { ?>
									<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
								<?php } ?>
								<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
							 </div>
							<div class="portfolio_navigation">
								<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="icon-chevron-left"></i>'); ?></div>
								<?php if(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true) != ""){ ?>
									<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true)); ?>"><i class="icon-th"></i></a></div>
								<?php } ?>
								<div class="portfolio_next"><?php next_post_link('%link','<i class="icon-chevron-right"></i>'); ?></div>
							</div>
						<?php	break;
						case 5: ?>
							<div class="portfolio_images">
								<?php echo river_qode_return_portfolio_single_media( $porftolio_template ); ?>
								</div>
								<div class="two_columns_75_25 clearfix portfolio_container">
									<div class="column1">
										<div class="column_inner">
											<div class="portfolio_single_text_holder">
												<h6><?php esc_html_e('ABOUT','river'); ?></h6>
												<?php the_content(); ?>
												<?php if( river_qode_is_like_enabled( true ) ) { ?>
													<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
												<?php } ?>
												<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
											</div>
										</div>
									</div>
									<div class="column2">
										<div class="column_inner">
											<div class="portfolio_detail portfolio_single_follow">
												<?php
												$portfolios = get_post_meta($qode_page_id, "qode_portfolios", true);
												if ($portfolios){
													usort($portfolios, "river_qode_compare_portfolio_options");
													foreach($portfolios as $portfolio){	
													?>
														<div class="info">
														<?php if($portfolio['optionLabel'] != ""): ?>
														<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
														<?php endif; ?>
														<p>
															<?php if($portfolio['optionUrl'] != ""): ?>
																<a href="<?php echo esc_url($portfolio['optionUrl']); ?>">
																<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
																</a>
															<?php else:?>
																<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
															<?php endif; ?>
														</p>
														</div>
													<?php						
													}
												}
												?>
												<?php if(get_post_meta($qode_page_id, "qode_portfolio_date", true)) : ?>
												<div class="info">
													<h6><?php esc_html_e('Date','river'); ?></h6>
													<p><?php echo get_post_meta($qode_page_id, "qode_portfolio_date", true); ?></p>
												</div>
												<?php endif; ?>
												<div class="info">
													<h6><?php esc_html_e('CATEGORY ','river'); ?></h6>
												 <span class="category">
												 <?php
													$terms = wp_get_post_terms($qode_page_id,'portfolio_category');
													$counter = 0;
													$all = count($terms);
													foreach($terms as $term) {
														$counter++;
														if($counter < $all){ $after = ', ';}
														else{ $after = ''; }
														echo wp_kses_post($term->name.$after);
													}
													?>
													</span>
												 </div>
											</div>
										</div>
									</div>
								</div>
								<div class="portfolio_navigation">
									<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="icon-chevron-left"></i>'); ?></div>
									<?php if(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true) != ""){ ?>
										<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true)); ?>"><i class="icon-th"></i></a></div>
									<?php } ?>
									<div class="portfolio_next"><?php next_post_link('%link','<i class="icon-chevron-right"></i>'); ?></div>
								</div>
						<?php	break;
						case 6: ?>
							<div class="portfolio_gallery">
								<?php echo river_qode_return_portfolio_single_media( $porftolio_template ); ?>
							</div>
							<div class="two_columns_75_25 clearfix portfolio_container">
								<div class="column1">
									<div class="column_inner">
										<div class="portfolio_single_text_holder">
											<h6><?php esc_html_e('ABOUT','river'); ?></h6>
											<?php the_content(); ?>
											<?php if( river_qode_is_like_enabled( true ) ) { ?>
												<div class="portfolio_like"><?php if( function_exists('qode_like') ) qode_like(); ?></div>
											<?php } ?>
											<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
										</div>
									</div>
								</div>
								<div class="column2">
									<div class="column_inner">
										<div class="portfolio_detail">
											<?php
											$portfolios = get_post_meta($qode_page_id, "qode_portfolios", true);
											if ($portfolios){
												usort($portfolios, "river_qode_compare_portfolio_options");
												foreach($portfolios as $portfolio){	
												?>
													<div class="info">
													<?php if($portfolio['optionLabel'] != ""): ?>
													<h6><?php echo stripslashes($portfolio['optionLabel']); ?></h6>
													<?php endif; ?>
													<p>
														<?php if($portfolio['optionUrl'] != ""): ?>
															<a href="<?php echo esc_url($portfolio['optionUrl']); ?>">
															<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
															</a>
														<?php else:?>
															<?php echo do_shortcode(stripslashes($portfolio['optionValue'])); ?>
														<?php endif; ?>
													</p>
													</div>
												<?php						
												}
											}
											?>
											<?php if(get_post_meta($qode_page_id, "qode_portfolio_date", true)) : ?>
											<div class="info">
												<h6><?php esc_html_e('Date','river'); ?></h6>
												<p><?php echo get_post_meta($qode_page_id, "qode_portfolio_date", true); ?></p>
											</div>
											<?php endif; ?>
											<div class="info">
												<h6><?php esc_html_e('CATEGORY ','river'); ?></h6>
											 <span class="category">
											 <?php
												$terms = wp_get_post_terms($qode_page_id,'portfolio_category');
												$counter = 0;
												$all = count($terms);
												foreach($terms as $term) {
													$counter++;
													if($counter < $all){ $after = ', ';}
													else{ $after = ''; }
													echo wp_kses_post($term->name.$after);
												}
												?>
												</span>
											 </div>
										</div>
									</div>
								</div>
							</div>
							<div class="portfolio_navigation">
								<div class="portfolio_prev"><?php previous_post_link('%link', '<i class="icon-chevron-left"></i>'); ?></div>
								<?php if(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true) != ""){ ?>
									<div class="portfolio_button"><a href="<?php echo get_permalink(get_post_meta($qode_page_id, "qode_choose-portfolio-list-page", true)); ?>"><i class="icon-th"></i></a></div>
								<?php } ?>
								<div class="portfolio_next"><?php next_post_link('%link','<i class="icon-chevron-right"></i>'); ?></div>
							</div>
						<?php	break;
						}
						?>
				<?php endwhile; ?>
			<?php endif; ?>	
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>	