<?php

class Perth_Skills extends WP_Widget {

    function perth_skills() {
		$widget_ops = array('classname' => 'perth_skills_widget', 'description' => __( 'Show your visitors some of your skills.', 'perth') );
        parent::__construct(false, $name = __('Perth FP: Skills', 'perth'), $widget_ops);
		$this->alt_option_name = 'perth_skills_widget';
		
		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		
    }
	
	function form($instance) {
		$title     			= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$skill_one   		= isset( $instance['skill_one'] ) ? esc_html( $instance['skill_one'] ) : '';
		$skill_one_max   	= isset( $instance['skill_one_max'] ) ? absint( $instance['skill_one_max'] ) : '';
		$skill_two   		= isset( $instance['skill_two'] ) ? esc_attr( $instance['skill_two'] ) : '';
		$skill_two_max   	= isset( $instance['skill_two_max'] ) ? absint( $instance['skill_two_max'] ) : '';
		$skill_three   		= isset( $instance['skill_three'] ) ? esc_attr( $instance['skill_three'] ) : '';
		$skill_three_max 	= isset( $instance['skill_three_max'] ) ? absint( $instance['skill_three_max'] ) : '';
		$skill_four   		= isset( $instance['skill_four'] ) ? esc_attr( $instance['skill_four'] ) : '';		
		$skill_four_max  	= isset( $instance['skill_four_max'] ) ? absint( $instance['skill_four_max'] ) : '';
	?>

	<p><em><?php _e('You can add up to four of your skills in this widget. Skill value must be between 0-100.', 'perth'); ?></em></p>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>

	<h4><?php _e('Skill 1', 'perth'); ?></h4>
	<p>
	<label for="<?php echo $this->get_field_id('skill_one'); ?>"><?php _e('First skill name', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_one'); ?>" name="<?php echo $this->get_field_name('skill_one'); ?>" type="text" value="<?php echo $skill_one; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('skill_one_max'); ?>"><?php _e('First skill value', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_one_max'); ?>" name="<?php echo $this->get_field_name('skill_one_max'); ?>" type="text" value="<?php echo $skill_one_max; ?>" />
	</p>

	<h4><?php _e('Skill 2', 'perth'); ?></h4>
	<p>
	<label for="<?php echo $this->get_field_id('skill_two'); ?>"><?php _e('Second skill name', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_two'); ?>" name="<?php echo $this->get_field_name('skill_two'); ?>" type="text" value="<?php echo $skill_two; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('skill_two_max'); ?>"><?php _e('Second skill value', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_two_max'); ?>" name="<?php echo $this->get_field_name('skill_two_max'); ?>" type="text" value="<?php echo $skill_two_max; ?>" />
	</p>	

	<h4><?php _e('Skill 3', 'perth'); ?></h4>
	<p>
	<label for="<?php echo $this->get_field_id('skill_three'); ?>"><?php _e('Third skill name', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_three'); ?>" name="<?php echo $this->get_field_name('skill_three'); ?>" type="text" value="<?php echo $skill_three; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('skill_three_max'); ?>"><?php _e('Third skill value', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_three_max'); ?>" name="<?php echo $this->get_field_name('skill_three_max'); ?>" type="text" value="<?php echo $skill_three_max; ?>" />
	</p>

	<h4><?php _e('Skill 4', 'perth'); ?></h4>
	<p>
	<label for="<?php echo $this->get_field_id('skill_four'); ?>"><?php _e('Fourth skill name', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_four'); ?>" name="<?php echo $this->get_field_name('skill_four'); ?>" type="text" value="<?php echo $skill_four; ?>" />
	</p>

	<p>
	<label for="<?php echo $this->get_field_id('skill_four_max'); ?>"><?php _e('Fourth skill value', 'perth'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('skill_four_max'); ?>" name="<?php echo $this->get_field_name('skill_four_max'); ?>" type="text" value="<?php echo $skill_four_max; ?>" />
	</p>
							

	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] 				= strip_tags($new_instance['title']);
		$instance['skill_one'] 			= strip_tags($new_instance['skill_one']);
		$instance['skill_one_max'] 		= intval($new_instance['skill_one_max']);
		$instance['skill_two'] 			= strip_tags($new_instance['skill_two']);
		$instance['skill_two_max'] 		= intval($new_instance['skill_two_max']);
		$instance['skill_three'] 		= strip_tags($new_instance['skill_three']);
		$instance['skill_three_max']	= intval($new_instance['skill_three_max']);
		$instance['skill_four'] 		= strip_tags($new_instance['skill_four']);
		$instance['skill_four_max'] 	= intval($new_instance['skill_four_max']);
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['perth_skills']) )
			delete_option('perth_skills');		  
		  
		return $instance;
	}
	
	function flush_widget_cache() {
		wp_cache_delete('perth_skills', 'widget');
	}
	
	// display widget
	function widget($args, $instance) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'perth_skills', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title 			= ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$title 			= apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$skill_one   	= isset( $instance['skill_one'] ) ? esc_html( $instance['skill_one'] ) : '';
		$skill_one_max  = isset( $instance['skill_one_max'] ) ? absint( $instance['skill_one_max'] ) : '';
		$skill_two   	= isset( $instance['skill_two'] ) ? esc_attr( $instance['skill_two'] ) : '';
		$skill_two_max  = isset( $instance['skill_two_max'] ) ? absint( $instance['skill_two_max'] ) : '';
		$skill_three   	= isset( $instance['skill_three'] ) ? esc_attr( $instance['skill_three'] ) : '';
		$skill_three_max= isset( $instance['skill_three_max'] ) ? absint( $instance['skill_three_max'] ) : '';
		$skill_four   	= isset( $instance['skill_four'] ) ? esc_attr( $instance['skill_four'] ) : '';		
		$skill_four_max = isset( $instance['skill_four_max'] ) ? absint( $instance['skill_four_max'] ) : '';

		echo $args['before_widget'];
?>

		<?php if ( $title ) echo $before_title . $title . $after_title; ?>

		<?php if ($skill_one !='') : ?>
		<div class="skillbar">
 			<div class="skill-title"><?php echo esc_html($skill_one); ?></div>
			<div class="skill-value-wrapper">
				<span class="skill-value"><?php echo absint($skill_one_max) . '%'; ?></span>
            	<div class="skill-progress" style="width:<?php echo absint($skill_one_max); ?>%"></div>
			</div>
		</div>
		<?php endif; ?>   
		<?php if ($skill_two !='') : ?>
		<div class="skillbar">
 			<div class="skill-title"><?php echo esc_html($skill_two); ?></div>
			<div class="skill-value-wrapper">
				<span class="skill-value"><?php echo absint($skill_two_max) . '%'; ?></span>
            	<div class="skill-progress" style="width:<?php echo absint($skill_two_max); ?>%"></div>
			</div>
		</div>
		<?php endif; ?> 
		<?php if ($skill_three !='') : ?>
		<div class="skillbar">
 			<div class="skill-title"><?php echo esc_html($skill_three); ?></div>
			<div class="skill-value-wrapper">
				<span class="skill-value"><?php echo absint($skill_three_max) . '%'; ?></span>
            	<div class="skill-progress" style="width:<?php echo absint($skill_three_max); ?>%"></div>
			</div>
		</div>
		<?php endif; ?> 
		<?php if ($skill_four !='') : ?>
		<div class="skillbar">
 			<div class="skill-title"><?php echo esc_html($skill_four); ?></div>
			<div class="skill-value-wrapper">
				<span class="skill-value"><?php echo absint($skill_four_max) . '%'; ?></span>
            	<div class="skill-progress" style="width:<?php echo absint($skill_four_max); ?>%"></div>
			</div>
		</div>
		<?php endif; ?> 

	<?php
		echo $args['after_widget'];

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'perth_skills', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}