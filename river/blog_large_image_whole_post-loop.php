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
				<?php $video_height = 540; ?>
				<?php if($_video_type == "youtube") { ?>
					<iframe height="<?php echo esc_attr($video_height); ?>" src="https://www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
				<?php } elseif ($_video_type == "vimeo"){ ?>
					<iframe height="<?php echo esc_attr($video_height); ?>" src="https://player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
				<?php } ?>
			</div>
			<div class="post_text">
				<div class="post_icons_holder">
					<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
					<?php if(river_qode_is_comments_enabled()){ ?><a  class="post_comments" href="<?php comments_link(); ?>"><i class="icon-large icon-comments"></i> <?php comments_number( '0', '1', '%'); ?></a><?php } ?>
					<span class="post_social">
						<?php if( river_qode_is_like_enabled() ) { ?>
							<span class="blog_like">
								 <?php if(function_exists('qode_like')) { qode_like(); } ?>
							</span>
						<?php } ?>
					</span>
				</div>	
				<h2 class="post_title_label"><span class="date"><?php the_time('d M'); ?></span> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<span class="post_infos">
					<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
					<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
				</span>
				<?php the_content(); ?>
				<span class="qbutton_holder"><a href="<?php the_permalink(); ?>" class="qbutton"><?php esc_html_e('READ MORE','river'); ?></a></span>
			</div>
		</article>
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
				<div class="post_icons_holder">
						<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
						<?php if(river_qode_is_comments_enabled()){ ?><a  class="post_comments" href="<?php comments_link(); ?>"><i class="icon-large icon-comments"></i> <?php comments_number( '0', '1', '%'); ?></a><?php } ?>
						<span class="post_social">
							<?php if( river_qode_is_like_enabled() ) { ?>
								<span class="blog_like">
									 <?php if(function_exists('qode_like')) { qode_like(); } ?>
								</span>
							<?php } ?>
						</span>	
				</div>	
				<h2 class="post_title_label"><span class="date"><?php the_time('d M'); ?></span> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<span class="post_infos">
						<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
						<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
				</span>
				<?php the_content(); ?>
				<span class="qbutton_holder"><a href="<?php the_permalink(); ?>" class="qbutton"><?php esc_html_e('READ MORE','river'); ?></a></span>
			</div>
		</article>
<?php
		break;
		case "link":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_text">
				<div class="post_text_holder">
					<i class="link_mark icon-link pull-left"></i>
					<div class="post_description">
						<div class="post_icons_holder">
							<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
							<?php if(river_qode_is_comments_enabled()){ ?><a  class="post_comments" href="<?php comments_link(); ?>"><i class="icon-large icon-comments"></i> <?php comments_number( '0', '1', '%'); ?></a><?php } ?>
							<span class="post_social">
								<?php if( river_qode_is_like_enabled() ) { ?>
									<span class="blog_like">
										 <?php if(function_exists('qode_like')) { qode_like(); } ?>
									</span>
								<?php } ?>
							</span>	
						</div>
						<span class="post_infos">
							<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('M'); ?></span> 
							<?php esc_html_e(' | ','river'); ?> <?php the_category(', '); ?>
							<?php esc_html_e(' | ','river'); ?><a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
						</span>
					</div>
					<div class="post_title">
						<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></p>
					</div>
				</div>	
			</div>
		</article>
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
				<div class="post_icons_holder">
						<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
						<?php if(river_qode_is_comments_enabled()){ ?><a  class="post_comments" href="<?php comments_link(); ?>"><i class="icon-large icon-comments"></i> <?php comments_number( '0', '1', '%'); ?></a><?php } ?>
						<span class="post_social">
							<?php if( river_qode_is_like_enabled() ) { ?>
								<span class="blog_like">
									 <?php if(function_exists('qode_like')) { qode_like(); } ?>
								</span>
							<?php } ?>
						</span>	
				</div>	
				<h2 class="post_title_label"><span class="date"><?php the_time('d M'); ?></span> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<span class="post_infos">
						<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
						<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
				</span>
				<?php
					echo do_shortcode($filtered_content)
				?>
				<span class="qbutton_holder"><a href="<?php the_permalink(); ?>" class="qbutton"><?php esc_html_e('READ MORE','river'); ?></a></span>
			</div>
		</article>
<?php
		break;
		case "quote":
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_text">
					<div class="post_text_holder">
						<i class="qoute_mark icon-quote-right pull-left"></i>
						<div class="post_description">
							<div class="post_icons_holder">
								<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
								<?php if(river_qode_is_comments_enabled()){ ?><a  class="post_comments" href="<?php comments_link(); ?>"><i class="icon-large icon-comments"></i> <?php comments_number( '0', '1', '%'); ?></a><?php } ?>
								<span class="post_social">
									<?php if( river_qode_is_like_enabled() ) { ?>
										<span class="blog_like">
											 <?php if(function_exists('qode_like')) { qode_like(); } ?>
										</span>
									<?php } ?>
								</span>	
							</div>
							<span class="post_infos">
								<span class="date"><?php the_time('d'); ?></span> <span class="month"><?php the_time('M'); ?></span> 
								<?php esc_html_e(' | ','river'); ?> <?php the_category(', '); ?>
								<?php esc_html_e(' | ','river'); ?> <a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
							</span>
						</div>
						<div class="post_title">
							<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_post_meta(get_the_ID(), "quote_format", true); ?></a></p>
							<span class="quote_author">&mdash; <?php the_title(); ?></span>
						</div>
					</div>	
				</div>
			</article>
<?php
		break;
		default:
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post_image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php the_post_thumbnail('full'); ?>
					</a>
				</div>
			<?php } ?>
			<div class="post_text">
				<div class="post_icons_holder">
						<?php if ( river_qode_is_core_installed() ) {
			echo do_shortcode( '[social_share]' );
		} ?>
						<?php if(river_qode_is_comments_enabled()){ ?><a  class="post_comments" href="<?php comments_link(); ?>"><i class="icon-large icon-comments"></i> <?php comments_number( '0', '1', '%'); ?></a><?php } ?>
						<span class="post_social">
							<?php if( river_qode_is_like_enabled() ) { ?>
								<span class="blog_like">
									 <?php if(function_exists('qode_like')) { qode_like(); } ?>
								</span>
							<?php } ?>
						</span>	
				</div>	
				<h2 class="post_title_label"><span class="date"><?php the_time('d M'); ?></span> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<span class="post_infos">
						<?php the_category(', '); ?><?php esc_html_e(' | ','river'); ?>
						<a class="post_author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
				</span>
				<?php the_content(); ?>
				<span class="qbutton_holder"><a href="<?php the_permalink(); ?>" class="qbutton"><?php esc_html_e('READ MORE','river'); ?></a></span>
			</div>
		</article>
<?php
}
?>		

