<?php

/*
Plugin Name: Custom Latest Events
Plugin URI: http://
Description: A simple but powerful widget to display latest events.
Version: 1.00
Author: plugthemes
Author URI: http://
*/

class widget_latest_events extends WP_Widget {
		
	public function __construct() {
		// Widget Actual Process
		parent::__construct(
			'core_latest_events',
			'Core Latest Events',
			array('description' => __('Display Latest Events', CORE_THEME_NAME))
			);
	}
	
	public function form($instance) {
		// Outputs the Options Form on Admin
		$defaults = array('title' => __('Upcoming Events', CORE_THEME_NAME ), 'number' => 3);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', CORE_THEME_NAME ); ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Numbers of item to show:', CORE_THEME_NAME ); ?></label>
			<input type="text"  class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $instance['number']; ?>" />
		</p>
	<?php
	}
	
	public function update($new_instance, $old_instance) {
		// Process Widget Options to be Saved
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		
		
		return $instance;
	}
	
	public function widget($args, $instance) {
		// Outputs Content of the Widget
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$number = $instance['number'];
		
		echo $before_widget;
		
		if($title) {
			echo $before_title . $title . $after_title;
		} ?>
		<div class="widget-inner">
		<?php
			$args = array(
			'post_type' => 'event',
			'post_per_page' => $number,
			'showposts' => $number
		);
			$latest_events = new WP_Query($args);
			if ($latest_events->have_posts()):
				global $post;
		?>
		<?php while($latest_events->have_posts()): $latest_events->the_post();
				
				$event_month = get_post_meta($post->ID, 'core_event_month', true);
				$event_day = get_post_meta($post->ID, 'core_event_day', true);
				$event_time = get_post_meta($post->ID, 'core_event_time', true);
				$event_location = get_post_meta($post->ID, 'core_event_location', true); 
		?>
		<div class="event-small-list clearfix">
			
				<div class="calendar-small">
					<span class="s-month"><?php echo substr($event_month, 0, 3); ?></span>
					<span class="s-date"><?php echo $event_day; ?></span>
				</div>
			
			<div class="event-small-details">
				<h5 class="event-small-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h5>
				<div class="event-small-meta small-text">
					<?php if($event_location == '') {
						echo __('Location Not Set', CORE_THEME_NAME );
					} else {
						echo $event_location . ' ' . $event_time; 
					} ?>
				</div>
			</div>
		</div>
		<?php endwhile; endif; ?>
		</div>
		
		<?php
		wp_reset_postdata(); 
		echo $after_widget;
	}
}

// Add Widget
function widget_latest_events_init() {
	register_widget('widget_latest_events');
}

add_action('widgets_init', 'widget_latest_events_init');

?>
