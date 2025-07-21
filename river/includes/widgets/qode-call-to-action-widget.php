<?php

class Call_To_Action extends WP_Widget {
    public function __construct() {
		parent::__construct(
	 		'call_to_action_widget', // Base ID
			esc_html__( 'River Call To Action', 'river' ), // Name
			array( 'description' => esc_html__( 'Display a Call to Action element', 'river' ), ) // Args
		);
	}
    
    public function widget($args, $instance) {
		// outputs the content of the widget
        extract($args);
        
        $html                   = "";
        $button_html            = "";
        $text_html              = "";
        $section_wrapper_styles = "";
        $text_styles            = "";
        $button_styles          = "";
        $button_classes         = "";
        
        if($instance['background_color'] != "") {
            $section_wrapper_styles .= "background-color:".$instance['background_color'].";";
        }
        
        if($instance['text_color']) {
            $text_styles .= "color: ".$instance['text_color'].";";
        }
        
        if($instance['button_color']) {
            $button_styles .= "color: ".$instance['button_color'].";";
        }

        if($instance['button_background_color']) {
            $button_styles .= "background-color: ".$instance['button_background_color'].";";
        }
        
        if($instance['button_border_color']) {
            $button_styles .= "border-color: ".$instance['button_border_color'].";";
        }
        
        $button_classes .= " {$instance['button_type']}";
        
        $button_link    = (isset($instance['button_link']) && $instance['button_link'] != "") ? $instance['button_link'] : '#';
        $button_target  = (isset($instance['button_target']) && $instance['button_target'] != "") ? $instance['button_target'] : '_self';
        $button_text    = (isset($instance['button_text']) && $instance['button_text'] != "") ? $instance['button_text'] : esc_html__('Default button text', 'river');
        $text           = (isset($instance['text']) && $instance['text'] != "") ? $instance['text'] :  esc_html__('Default call to action text', 'river');
        
        $html        .= "<div class='qode_call_to_action container' style='{$section_wrapper_styles}'>";
        $html        .= "<div class='container_inner'>";
        $html        .= "<section class='grid_section'>";
        $html        .= "<div class='two_columns_75_25 clearfix'>";
        
        $button_html .= "<div class='column2 call_to_action_button_wrapper {$instance['button_position']}'>";
        $button_html .= "<div class='column_inner'>";
        $button_html .= "<a href='{$button_link}' target='{$button_target}' class='qbutton {$button_classes}' style='{$button_styles}'>{$button_text}</a>";
        $button_html .= "</div>"; //close column_inner button html
        $button_html .= "</div>"; //close column2 button html
        
        $text_html   .= "<div class='column1 call_to_action_text_wrapper wpb_column column_container'>";
        $text_html   .= "<div class='column_inner call_to_action_text_wrapper wpb_column column_container'>";
        $text_html   .= "<p style='{$text_styles}'>".do_shortcode($text)."</p>";
        $text_html   .= "</div>"; //close column_inner text html
        $text_html   .= "</div>"; //close column1 text html
        
        //if we need to show the button
        if($instance['button_option'] == "yes") {
            if($instance['button_position'] == 'left') {
                $html  .= $button_html;
                $html  .= $text_html;
            } else {
                $html  .= $text_html;
                $html  .= $button_html;
            }
        } else {
            $html  .= $text_html;
        }
        
        
        $html        .= "</div>";
        $html        .= "</section>";
        $html        .= "</div>";
        $html        .= "</div>";
        
        echo river_qode_get_module_part($html);
        
	}

 	public function form($instance) {
        
        //set widget values
		$text                       = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
        $text_color                 = isset( $instance['text_color'] ) ? esc_attr( $instance['text_color'] ) : '';
        $background_color           = isset( $instance['background_color'] ) ? esc_attr( $instance['background_color'] ) : '';
        $button_option              = isset( $instance['button_option'] ) ? esc_attr( $instance['button_option'] ) : 'no';
        $button_type                = isset( $instance['button_type'] ) ? esc_attr( $instance['button_type'] ) : '';
        $button_color               = isset( $instance['button_color'] ) ? esc_attr( $instance['button_color'] ) : '';
        $button_background_color    = isset( $instance['button_background_color'] ) ? esc_attr( $instance['button_background_color'] ) : '';
        $button_border_color        = isset( $instance['button_border_color'] ) ? esc_attr( $instance['button_border_color'] ) : '';
        $button_text                = isset( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : '';
        $button_link                = isset( $instance['button_link'] ) ? esc_attr( $instance['button_link'] ) : '';
        $button_target              = isset( $instance['button_target'] ) ? esc_attr( $instance['button_target'] ) : '';
        $button_position            = isset( $instance['button_position'] ) ? esc_attr( $instance['button_position'] ) : 'right';
            
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'text' )); ?>"><?php esc_html_e( 'Text:','river'); ?></label>
        <textarea class="widefat" id="<?php echo esc_attr($this->get_field_id( 'text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text' )); ?>" cols="5" rows="5"><?php echo esc_attr( $text ); ?></textarea>
		</p>
        
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'text_color' )); ?>"><?php esc_html_e( 'Text Color:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'text_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_color' )); ?>" type="text" value="<?php echo esc_attr( $text_color ); ?>" />
		</p>
        
		<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'background_color' )); ?>"><?php esc_html_e( 'Background Color:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'background_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'background_color' )); ?>" type="text" value="<?php echo esc_attr( $background_color ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_option' )); ?>"><?php esc_html_e( 'Show Button:','river' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'button_option' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_option' )); ?>">
            <option value="yes" <?php if(esc_attr($button_option) == "yes"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Yes', 'river' ); ?></option>
            <option value="no" <?php if(esc_attr($button_option) == "no"){echo 'selected="selected"';} ?>><?php esc_html_e( 'No', 'river' ); ?></option>
		</select>
        </p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_type' )); ?>"><?php esc_html_e( 'Button Type:','river' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'button_type' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_type' )); ?>">
            <option value="normal" <?php if(esc_attr($button_type) == "normal"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Normal', 'river' ); ?></option>
            <option value="no_fill" <?php if(esc_attr($button_type) == "no_fill"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Transparent', 'river' ); ?></option>
		</select>
        </p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_text' )); ?>"><?php esc_html_e( 'Button Text:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'button_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_text' )); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_color' )); ?>"><?php esc_html_e( 'Button Color:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'button_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_color' )); ?>" type="text" value="<?php echo esc_attr( $button_color ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_background_color' )); ?>"><?php esc_html_e( 'Button Background Color:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'button_background_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_background_color' )); ?>" type="text" value="<?php echo esc_attr( $button_background_color ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_border_color' )); ?>"><?php esc_html_e( 'Button Border Color:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'button_border_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_border_color' )); ?>" type="text" value="<?php echo esc_attr( $button_border_color ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_link' )); ?>"><?php esc_html_e( 'Button Link:','river' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'button_link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_link' )); ?>" type="text" value="<?php echo esc_attr( $button_link ); ?>" />
		</p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_target' )); ?>"><?php esc_html_e( 'Button Target:','river' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'button_target' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_target' )); ?>">
            <option value="_blank" <?php if(esc_attr($button_target) == "_blank"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Blank', 'river' ); ?></option>
            <option value="_self" <?php if(esc_attr($button_target) == "_self"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Self', 'river' ); ?></option>
            <option value="_top" <?php if(esc_attr($button_target) == "_top"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Top', 'river' ); ?></option>
            <option value="_parent" <?php if(esc_attr($button_target) == "_parent"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Parent', 'river' ); ?></option>
		</select>
        </p>
        
        <p>
		<label for="<?php echo esc_attr($this->get_field_id( 'button_position' )); ?>"><?php esc_html_e( 'Button Position:','river' ); ?></label>
		<select id="<?php echo esc_attr($this->get_field_id( 'button_position' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'button_position' )); ?>">
            <option value="right" <?php if(esc_attr($button_position) == "right"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Right', 'river' ); ?></option>
            <option value="left" <?php if(esc_attr($button_position) == "left"){echo 'selected="selected"';} ?>><?php esc_html_e( 'Left', 'river' ); ?></option>
		</select>
        </p>
        
		<?php 
	}

	public function update($new_instance, $old_instance) {
		// processes widget options to be saved
        $instance = array();
        
		$instance['text']                           = strip_tags( $new_instance['text'] );
		$instance['text_color']                     = $new_instance['text_color'];
		$instance['background_color']               = $new_instance['background_color']; 
		$instance['button_option']                  = $new_instance['button_option']; 
		$instance['button_type']                    = $new_instance['button_type']; 
		$instance['button_text']                    = $new_instance['button_text']; 
		$instance['button_color']                   = $new_instance['button_color']; 
		$instance['button_background_color']        = $new_instance['button_background_color']; 
		$instance['button_border_color']            = $new_instance['button_border_color']; 
		$instance['button_link']                    = $new_instance['button_link']; 
		$instance['button_target']                  = $new_instance['button_target']; 
		$instance['button_position']                = $new_instance['button_position']; 
        
		return $instance;
	}
}
