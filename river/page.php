<?php $qode_sidebar = river_qode_get_sidebar_layout( false ); ?>
	<?php get_header(); ?>
		<?php get_template_part( 'title' ); ?>
		<?php get_template_part( 'slider' ); ?>
		<div class="container">
			<div class="container_inner clearfix">
				
				
				<?php if(($qode_sidebar == "default")||($qode_sidebar == "")) : ?>
					<?php if (have_posts()) : 
							while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
							<?php river_qode_wp_link_pages(); ?>
							<?php river_qode_get_comments_template(false, false); ?>
							<?php endwhile; ?>
						<?php endif; ?>
				<?php elseif($qode_sidebar == "1" || $qode_sidebar == "2"): ?>		
					
					<?php if($qode_sidebar == "1") : ?>	
						<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
							<div class="column1">
					<?php elseif($qode_sidebar == "2") : ?>	
						<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
							<div class="column1">
					<?php endif; ?>
							<?php if (have_posts()) : 
								while (have_posts()) : the_post(); ?>
								<div class="column_inner">
									
									<?php the_content(); ?>
									<?php river_qode_wp_link_pages(); ?>
									<?php river_qode_get_comments_template(false, false); ?>
								</div>
						<?php endwhile; ?>
						<?php endif; ?>
					
									
							</div>
							<div class="column2"><?php get_sidebar();?></div>
						</div>
					<?php elseif($qode_sidebar == "3" || $qode_sidebar == "4"): ?>
						<?php if($qode_sidebar == "3") : ?>	
							<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2">
						<?php elseif($qode_sidebar == "4") : ?>	
							<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2">
						<?php endif; ?>
								<?php if (have_posts()) : 
									while (have_posts()) : the_post(); ?>
									<div class="column_inner">
										<?php the_content(); ?>
										<?php river_qode_wp_link_pages(); ?>
										<?php river_qode_get_comments_template(false, false); ?>
									</div>
							<?php endwhile; ?>
							<?php endif; ?>
						
										
								</div>
								
							</div>
					<?php endif; ?>
			
		</div>
	</div>
	<?php get_footer(); ?>			