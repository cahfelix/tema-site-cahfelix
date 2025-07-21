<?php

class Qode_Flickr_Widget extends WP_Widget {

	function __construct() {
		
		parent::__construct(
	 		'qode-flickr-widget', esc_html__( 'River Flickr Widget', 'river' ), array('classname' => 'flickr', 'description' => 'Qode Flickr Widget for user photo stream!'), array('id_base' => 'qode-flickr-widget')
		);
	}

	function widget($args, $instance)	{

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);

		$user_name = $instance['user_name'];

		$number = $instance['number'];

		$under_text=$instance['under_text'];

		$img_widht=$instance['img_widht'];

		$img_height=$instance['img_height'];

		echo wp_kses_post( $before_widget );

		if($title!='') {

			echo wp_kses_post( $before_title.$title.$after_title );


		}
		
		if($user_name && $number) {
			
			$api_key = '04f2ebdf1f13890b64cb9c96d4108baf';
			
			
			
			$userid = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key='.$api_key.'&username='.urlencode($user_name).'&format=json');
			
			if ( ! is_array( $userid ) ) {
				return;
			}
			
			$userid = trim($userid['body'], 'jsonFlickrApi()');
			$userid = json_decode($userid);
			
			if($userid->user->id!='') {
				
				$url_item = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.urls.getUserPhotos&api_key='.$api_key.'&user_id='.$userid->user->id.'&format=json');
				
				$url_item = trim($url_item['body'], 'jsonFlickrApi()');
				
				$url_item = json_decode($url_item);
				
				
				
				$photos = wp_remote_get('https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key='.$api_key.'&user_id='.$userid->user->id.'&per_page='.$number.'&format=json');
				
				$photos = trim($photos['body'], 'jsonFlickrApi()');
				
				$photos = json_decode($photos);
				
				?>

				<ul class='flickr_widget'>

					<?php foreach($photos->photos->photo as $photo): $photo = (array) $photo; ?>

					<li class='flickr_single_photo'>

						<a href='<?php echo esc_url($url_item->user->url . $photo['id'] ); ?>' target='_blank' title="<?php echo esc_attr($photo['title']); ?>">

							<img src='<?php $url = "https://farm" . $photo['farm'] . ".static.flickr.com/" . $photo['server'] . "/" . $photo['id'] . "_" . $photo['secret'] . '_s' . ".jpg"; echo esc_attr($url); ?>' alt='<?php echo esc_attr($photo['title']); ?>' width="<?php echo intval($img_widht); ?>" height="<?php echo intval($img_height); ?>" />

						</a>

					</li>

					<?php endforeach; ?>

				</ul>

				<?php

			} else {

				echo '<p>' . esc_html__( 'Invalid flickr username.', 'river' ) . '</p>';

			}

		}

		if($under_text!=''){

			echo '<div class="widget_description"><p>' .$instance['under_text'] . '</p></div>';
		}

		echo wp_kses_post( $after_widget );

	}

	function form($instance)

	{

		$defaults = array('title' => esc_html__( 'Flickr Stream', 'river' ), 'user_name' => '', 'number' => 6,'under_text'=>'','img_widht'=>60,'img_height'=>60);

		$instance = wp_parse_args((array) $instance, $defaults); ?>	

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'river' ); ?></label>

			<input style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('user_name')); ?>"><?php esc_html_e( 'Username:', 'river' ); ?></label>

			<input style="width: 216px;" id="<?php echo esc_attr($this->get_field_id('user_name')); ?>" name="<?php echo esc_attr($this->get_field_name('user_name')); ?>" value="<?php echo esc_attr($instance['user_name']); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e( 'Number of photos to show:', 'river' ); ?></label>

			<input style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" value="<?php echo esc_attr($instance['number']); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('under_text')); ?>"><?php esc_html_e( 'Type text under widget(Optional):', 'river' ); ?></label>

			<textarea style="resize:none; width:216px; height:50px;" id="<?php echo esc_attr($this->get_field_id('under_text')); ?>" name="<?php echo esc_attr($this->get_field_name('under_text')); ?>"><?php echo esc_attr($instance['under_text']); ?></textarea>

		</p>

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('img_widht')); ?>"><?php esc_html_e( 'Image width:', 'river' ); ?></label>

			<input style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('img_widht')); ?>" name="<?php echo esc_attr($this->get_field_name('img_widht')); ?>" value="<?php echo esc_attr($instance['img_widht']); ?>" />

		</p>

		<p>

			<label for="<?php echo esc_attr($this->get_field_id('img_height')); ?>"><?php esc_html_e( 'Image Height:', 'river' ); ?></label>

			<input style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('img_height')); ?>" name="<?php echo esc_attr($this->get_field_name('img_height')); ?>" value="<?php echo esc_attr($instance['img_height']); ?>" />

		</p>		

	<?php

	}
	
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['user_name'] = $new_instance['user_name'];
		
		$instance['number'] = $new_instance['number'];
		
		$instance['under_text'] = $new_instance['under_text'];
		
		$instance['img_widht'] = $new_instance['img_widht'];
		
		$instance['img_height'] = $new_instance['img_height'];
		
		return $instance;
	}
}