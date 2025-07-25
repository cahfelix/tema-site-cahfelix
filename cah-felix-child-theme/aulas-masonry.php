<?php 
/*
    Template Name: Aulas Masonry
*/ 
?>
<?php get_header(); ?>
<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$category = get_post_meta($id, "qode_choose-blog-category", true);
$post_number = get_post_meta($id, "qode_show-posts-per-page", true);
if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
$sidebar = get_post_meta($id, "qode_show-sidebar", true);
query_posts('post_type=aulas&paged='. $paged . '&cat=' . $category .'&posts_per_page=' . $post_number . '&order=ASC' );
if(get_post_meta($id, "qode_responsive-title-image", true) != ""){
 $responsive_title_image = get_post_meta($id, "qode_responsive-title-image", true);
}else{
	$responsive_title_image = $qode_options_river['responsive_title_image'];
}

$blog_hide_comments = "";
if (isset($qode_options_river['blog_hide_comments'])) {
	$blog_hide_comments = $qode_options_river['blog_hide_comments'];
}
if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
 $fixed_title_image = get_post_meta($id, "qode_fixed-title-image", true);
}else{
	$fixed_title_image = $qode_options_river['fixed_title_image'];
}

if(get_post_meta($id, "qode_title-image", true) != ""){
 $title_image = get_post_meta($id, "qode_title-image", true);
}else{
	$title_image = $qode_options_river['title_image'];
}

if(get_post_meta($id, "qode_title-height", true) != ""){
 $title_height = get_post_meta($id, "qode_title-height", true);
}else{
	$title_height = $qode_options_river['title_height'];
}

$title_background_color = '';
if(get_post_meta($id, "qode_page-title-background-color", true) != ""){
 $title_background_color = get_post_meta($id, "qode_page-title-background-color", true);
}else{
	$title_background_color = $qode_options_river['title_background_color'];
}

$show_title_image = true;
if(get_post_meta($id, "qode_show-page-title-image", true)) {
	$show_title_image = false;
}

if(isset($qode_options_river['blog_page_range']) && $qode_options_river['blog_page_range'] != ""){
	$blog_page_range = $qode_options_river['blog_page_range'];
} else{
	$blog_page_range = $wp_query->max_num_pages;
}

$qode_page_title_style = "1";
if(get_post_meta($id, "qode_page_title_style", true) != ""){
	$qode_page_title_style = get_post_meta($id, "qode_page_title_style", true);
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

?>
			
	<?php if(!get_post_meta($id, "qode_show-page-title", true)) { ?>
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
								<h1<?php if(get_post_meta($id, "qode_page-title-color", true)) { ?> style="color:<?php echo get_post_meta($id, "qode_page-title-color", true) ?>" <?php } ?>><?php the_title(); ?></h1>	
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
			<div class="slider"><div class="slider_inner">
			<?php echo do_shortcode($revslider); ?>
			</div></div>
		<?php
		}
		?>
	<div class="container">
		<div class="container_inner clearfix">
            <p>Este é um trabalho voluntário e destina-se ao publico iniciante ;) </p>
            <br>
					<div class="blog_holder masonry">

						<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
							<?php // get_template_part('blog_masonry', 'loop'); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <?php if ( has_post_thumbnail() ) { ?>
                                    <div class="post_image">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                            <?php the_post_thumbnail('full'); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="post_text">
                                    <h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                    <?php // the_excerpt(); ?>
                                    <span class="post_social">
                                        <?php if( $qode_like == "on" ) { ?>
                                            <span class="blog_like">
                                                <?php if(function_exists('qode_like')) { qode_like(); } ?>
                                            </span>
                                        <?php } ?>
                                        <?php echo do_shortcode('[social_share]'); ?>
                                    </span>
                                </div>
                            </article>

						<?php endwhile; ?>
						<?php else: //If no posts are present ?>
							<div class="entry">                        
									<p><?php _e('No posts were found.', 'qode'); ?></p>    
							</div>
						<?php endif; ?>
					</div>
					<?php if($qode_options_river['pagination'] != "0") : ?>
						<?php pagination($wp_query->max_num_pages, $blog_page_range, $paged); ?>
					<?php endif; ?>
					
		</div>
	</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>