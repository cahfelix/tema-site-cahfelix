<?php
$_post_format = get_post_format();
?>
<?php
	switch ($_post_format) {
		case "video":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<?php $_video_type = get_post_meta(get_the_ID(), "video_format_choose", true);?>
				<?php if(get_post_meta(get_the_ID(), "video_height", true) != "") { 
					$video_height = get_post_meta(get_the_ID(), "video_height", true);
				} else {
					$video_height = 540;
				} ?>
				<?php if($_video_type == "youtube") { ?>
					<iframe height="<?php echo esc_attr($video_height); ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
				<?php } elseif ($_video_type == "vimeo"){ ?>
					<iframe height="<?php echo esc_attr($video_height); ?>" src="https://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php } ?>
			</div>
			<div class="post_text">
				<div class="post_description">
					<span class="post_infos">
						<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('F'); ?></span><?php esc_html_e(' | ','river'); ?>
						<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
						<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
					</span>
				</div>	
				<h2 class="post_title_label"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
<?php
		break;
		case "audio":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<audio src="<?php echo get_post_meta(get_the_ID(), "audio_link", true) ?>" controls="controls">
					<?php esc_html_e("Your browser don't support audio player",'river'); ?>
				</audio>
			</div>
			<div class="post_text">
				<div class="post_description">
					<span class="post_infos">
						<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('F'); ?></span><?php esc_html_e(' | ','river'); ?>
						<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
						<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
					</span>
				</div>	
				<h2 class="post_title_label"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
	
<?php
		break;
		case "link":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_text">
				<div class="post_text_holder">
					<i class="link_mark icon-link pull-left"></i>
					<div class="post_description">
						<span class="post_infos">
							<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('F'); ?></span><?php esc_html_e(' | ','river'); ?>
							<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
							<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
						</span>
					</div>
					<div class="post_title">
						<p><a href="<?php echo get_post_meta(get_the_ID(), "title_link", true); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
					</div>
				</div>
				
			</div>
		<?php the_content(); ?>
<?php
		break;
		case "gallery":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_image">
				<div class="flexslider">
					<ul class="slides">
						<?php
						$post_content = get_the_content();
						preg_match( '/\[gallery.*ids=.(.*).\]/', $post_content, $ids );
						
						if ( ! empty( $ids ) ) {
							$array_id         = explode( ",", $ids[1] );
							$content          = str_replace( $ids[0], "", $post_content );
							$filtered_content = apply_filters( 'the_content', $content );
							
							foreach ( $array_id as $img_id ) { ?>
								<li>
									<a href="<?php the_permalink(); ?>"><?php echo wp_get_attachment_image( $img_id, 'full' ); ?></a>
								</li>
							<?php }
						}
						?>
					</ul>
				</div>
			</div>
			<div class="post_text">
				<div class="post_description">
					<span class="post_infos">
						<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('F'); ?></span><?php esc_html_e(' | ','river'); ?>
						<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
						<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
					</span>
				</div>	
				<h2 class="post_title_label"><?php the_title(); ?></a></h2>
				<?php
					echo do_shortcode($filtered_content);
				?>
			</div>
		
<?php
		break;
		case "quote":
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_text">
					<div class="post_text_holder">
						<i class="qoute_mark icon-quote-right pull-left"></i>
						<div class="post_description">
							<span class="post_infos">
								<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('F'); ?></span><?php esc_html_e(' | ','river'); ?>
								<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
								<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
							</span>
						</div>
						<div class="post_title">
							<p><?php echo get_post_meta(get_the_ID(), "quote_format", true); ?></p>
							<span class="quote_author">&mdash; <?php the_title(); ?></span>
						</div>
					</div>
					
				</div>
			<?php the_content(); ?>
<?php
		break;
		default:
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") { ?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="post_image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('full'); ?>
						</a>
					</div>
				<?php } ?>
			<?php } ?>
			<div class="post_text">
				<div class="post_description">
					<span class="post_infos">
						<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('F'); ?></span><?php esc_html_e(' | ','river'); ?>
						<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
						<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
					</span>
				</div>	
				<h2 class="post_title_label"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		
<?php
}
?>
<?php if( has_tag()) { ?>
	<div class="single_tags">
		<h4><?php esc_html_e('TAGS ','river') ?></h4>
		<?php the_tags('', '', ''); ?>
	</div>	
<?php } ?>				
<?php river_qode_wp_link_pages(); ?>
<?php if(river_qode_is_author_info_enabled() && get_the_author_meta('description') != "") { ?>
	<div class="author_description">
		<div class="author_description_inner">
			<div class="image">
				<?php echo get_avatar(get_the_author_meta( 'ID' ), 80); ?>
			</div>
			<div class="author_text_holder">
				<h4 class="author_name"><?php esc_html_e('AUTHOR','river') ?> -
				<?php  
				if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
					echo get_the_author_meta('first_name') . " " . get_the_author_meta('last_name');
				} else {
					echo get_the_author_meta('display_name');
				}
				?>
				</h4>
				<div class="author_text">
					<p><?php echo get_the_author_meta('description') ?></p>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
</article>
<div class="blog_social_and_comments">
	<?php if(river_qode_is_comments_enabled()){ ?>
		<div class="comment_number_holder">
			<p><?php comments_number( esc_html__('No Comment','river'), '1 '.esc_html__('Comment','river'), '% '.esc_html__('Comments','river') ); ?></p>
		</div>
	<?php } ?>
	<div class="blog_single_social">
		<?php if( river_qode_is_like_enabled() ) { ?>
			<span class="blog_like">
				 <?php if(function_exists('qode_like')) { qode_like(); } ?>
			</span>
		<?php } ?>
		<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
	</div>
</div>