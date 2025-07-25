<?php

if(get_post_meta(get_the_ID(), "qode_show-sidebar", true) != ""){
	$sidebar = get_post_meta(get_the_ID(), "qode_show-sidebar", true);
}else{
	$sidebar = $qode_options_river['blog_single_sidebar'];
}

$blog_hide_comments = "";
if (isset($qode_options_river['blog_hide_comments'])) 
	$blog_hide_comments = $qode_options_river['blog_hide_comments'];
	
if(get_post_meta(get_the_ID(), "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta(get_the_ID(), "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_river['responsive_title_image'];
}

if(get_post_meta(get_the_ID(), "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta(get_the_ID(), "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_river['fixed_title_image'];
}

if(get_post_meta(get_the_ID(), "qode_title-image", true) != ""){
 $title_image = get_post_meta(get_the_ID(), "qode_title-image", true);
}else{
	$title_image = $qode_options_river['title_image'];
}

if(get_post_meta(get_the_ID(), "qode_title-height", true) != ""){
 $title_height = get_post_meta(get_the_ID(), "qode_title-height", true);
}else{
	$title_height = $qode_options_river['title_height'];
}

$title_background_color = '';
if(get_post_meta(get_the_ID(), "qode_page-title-background-color", true) != ""){
 $title_background_color = get_post_meta(get_the_ID(), "qode_page-title-background-color", true);
}else{
	$title_background_color = $qode_options_river['title_background_color'];
}

$show_title_image = true;
if(get_post_meta(get_the_ID(), "qode_show-page-title-image", true)) {
	$show_title_image = false;
}

if(isset($qode_options_river['twitter_via']) && !empty($qode_options_river['twitter_via'])) {
	$twitter_via = " via " . $qode_options_river['twitter_via'];
} else {
	$twitter_via = 	"";
}

$qode_page_title_style = "1";
if(get_post_meta(get_the_ID(), "qode_page_title_style", true) != ""){
	$qode_page_title_style = get_post_meta(get_the_ID(), "qode_page_title_style", true);
}	else{
	if(isset($qode_options_river['title_style'])) {
		$qode_page_title_style = $qode_options_river['title_style'];
	} else {
		$qode_page_title_style = "1";
	}
}
$height_class = "";
if($qode_page_title_style == "2") {
	$height_class = " with_breadcrumbs";
}else{
	$height_class = " standard";
}
$id = get_the_ID();
?>
<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
				<?php if(!get_post_meta(get_the_ID(), "qode_show-page-title", true)) { ?>
					<div class="title<?php echo $height_class; ?> <?php if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "yes" && $show_title_image == true){ echo 'has_fixed_background '; } if($responsive_title_image == 'no' && $title_image != "" && $fixed_title_image == "no" && $show_title_image == true){ echo 'has_background'; } if($responsive_title_image == 'yes' && $show_title_image == true){ echo 'with_image'; } ?>" style="<?php if($responsive_title_image == 'no' && $title_image != "" && $show_title_image == true){ echo 'background-image:url('.$title_image.');';  } if($title_height != ''){ echo 'height:'.$title_height.'px;'; } if($title_background_color != ''){ echo 'background-color:'.$title_background_color.';'; } ?>">
						<?php if($responsive_title_image == 'yes' && $title_image != "" && $show_title_image == true){ echo '<img src="'.$title_image.'" alt="title" />'; } ?>
						<?php if(!get_post_meta($id, "qode_show-page-title-text", true)) { ?>
							<div class="title_holder">
								<div class="container">
									<div class="container_inner clearfix">
										<?php if($qode_page_title_style == "2") {  ?>
											<?php if (function_exists('qode_custom_breadcrumbs')) { ?> <div class="breadcrumb"<?php if(get_post_meta($id, "qode_page_breadcrumb_color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page_breadcrumb_color", true) ?>" <?php } ?>> <?php qode_custom_breadcrumbs(); ?></div><?php } ?>
											<?php if(get_post_meta($id, "qode_page_subtitle", true)) { ?><span class="subtitle" <?php if(get_post_meta($id, "qode_page_subtitle_color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page_subtitle_color", true) ?>" <?php } ?>> <?php echo get_post_meta($id, "qode_page_subtitle", true) ?></span><?php } ?>
										<?php } else { ?>
                      <?php if(get_post_meta($id, "qode_page_subtitle", true)) { ?><h6 <?php if(get_post_meta($id, "qode_page_subtitle_color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page_subtitle_color", true) ?>" <?php } ?>> <?php echo get_post_meta($id, "qode_page_subtitle", true) ?></h6><?php } ?>
                      
                      <?php  $post_type = get_post_type( get_the_ID() ); ?>
                      <?php if ( $post_type != 'post' ) { ?>
											<h1<?php if(get_post_meta($id, "qode_page-title-color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page-title-color", true) ?>" <?php } ?>>
												<?php if(get_post_meta(get_the_ID(), "qode_page-title-text", true)){ ?>
													<?php the_title(); ?>
												<?php } else { ?>
                          <?php the_title(); ?>
												<?php } ?>
                      </h1>	
                      <?php } else { ?>
                        
                        
                        <h1 class='post_title_blog'><?php the_title(); ?></h1>
                        <span class="date"><?php the_time('j F, Y'); ?></span>
                        <?php _e(' | ','qode'); ?> 
                        <a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">Por <?php the_author_meta('display_name'); ?></a>
                        
                      <?php  } ?>
											<span class="separator small"></span>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
				
				<?php if($qode_options_river['show_back_button'] == "yes") { ?>
					<a id='back_to_top' href='#'>
						<span class="icon-stack">
							<i class="icon-chevron-up " style=""></i>
						</span>
					</a>
				<?php } ?>
				
				<?php
				$revslider = get_post_meta($id, "qode_revolution-slider", true);
				if (!empty($revslider)){ ?>
				<h2>SINGLE</h2>	
					<div class="slider"><div class="slider_inner">
					<?php echo do_shortcode($revslider); ?>
					</div></div>
				<?php
				}
				?>
				<div class="container">
					<div class="container_inner">
				
					<?php if(($sidebar == "default")||($sidebar == "")) : ?>
						<div class="blog_holder blog_single">
						<?php 
							get_template_part('blog_single', 'loop');
						?>
						<?php
							if($blog_hide_comments != "yes"){
								comments_template('', true); 
							}else{
								echo "<br/><br/>";
							}
						?> 
						
					<?php elseif($sidebar == "1" || $sidebar == "2"): ?>
						<?php if($sidebar == "1") : ?>	
							<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
							<div class="column1">
						<?php elseif($sidebar == "2") : ?>	
							<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
								<div class="column1">
						<?php endif; ?>
					
									<div class="column_inner">
										<div class="blog_holder blog_single">	
											<?php 
												get_template_part('blog_single', 'loop');
											?>
										</div>
										
										<?php
											if($blog_hide_comments != "yes"){
												comments_template('', true); 
											}else{
												echo "<br/><br/>";
											}
										?> 
									</div>
								</div>	
								<div class="column2"> 
									<?php get_sidebar(); ?>
								</div>
							</div>
						<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
							<?php if($sidebar == "3") : ?>	
								<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
								<div class="column1"> 
									<?php get_sidebar(); ?>
								</div>
								<div class="column2">
							<?php elseif($sidebar == "4") : ?>	
								<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
									<div class="column1"> 
										<?php get_sidebar(); ?>
									</div>
									<div class="column2">
							<?php endif; ?>
							
										<div class="column_inner">
											<div class="blog_holder blog_single">	
												<?php 
													get_template_part('blog_single', 'loop');
												?>
											</div>
											<?php
												if($blog_hide_comments != "yes"){
													comments_template('', true); 
												}else{
													echo "<br/><br/>";
												}
											?> 
										</div>
									</div>	
									
								</div>
						<?php endif; ?>
					</div>
				</div>
			</div>						
<?php endwhile; ?>
<?php endif; ?>	


<?php get_footer(); ?>	