<?php
class Related_Posts extends WP_Widget {

	public function __construct() {
		parent::__construct(
	 		'related_posts_widget', // Base ID
			esc_html__( 'River Related Posts', 'river' ), // Name
			array( 'description' => esc_html__( 'Display a list of your related blog posts', 'river' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Related Posts','river') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10; 

		echo wp_kses_post( $before_widget );
		if ( ! empty( $title ) )
			echo wp_kses_post( $before_title . $title . $after_title ); ?>

		<?php
		
			$tags = wp_get_post_tags(get_the_ID());
			
 			if ($tags) {
				
 				$tag_ids = array();
				foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
				$args = array(
					'post_status' => 'publish',
					'tag__in' => $tag_ids,
					'post__not_in' => array(get_the_ID()),
					'posts_per_page'=>$number // Number of related posts to display.
				);
 				$related_query = new WP_Query($args);
				if ($related_query->have_posts()) {
			?>
			
 
            <?php
            while ($related_query->have_posts()) : $related_query->the_post();
            ?>
				<div class="post no_image">
                <div class="text">
                    <a href="<?php the_permalink() ?>" > <?php the_title();?> </a>
                </div>
				</div>
            <?php
            endwhile;
            ?>
 
        
 
<?php }
			    wp_reset_postdata();
}
?>
	<?php	echo wp_kses_post( $after_widget );
	}

	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number']; 
		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5; 
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:','river'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Number of posts:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
		</p>
		<?php 
	}
}