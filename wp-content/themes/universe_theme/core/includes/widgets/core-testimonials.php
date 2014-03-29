<?php

/*
Plugin Name: Custom Testimonials Widget
Plugin URI: http://
Description: A simple but powerful widget to display latest testimonials.
Version: 1.00
Author: plugthemes
Author URI: http://
*/

class widget_testimonials extends WP_Widget {
		
	public function __construct() {
		// Widget Actual Process
		parent::__construct(
			'core_testimonials',
			'Core Testimonials',
			array('description' => __('Display Latest Testimonials', CORE_THEME_NAME))
			);
	}
	
	public function form($instance) {
		// Outputs the Options Form on Admin
		$defaults = array('title' => __('Testimonials', CORE_THEME_NAME ), 'number' => 3);
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
			'post_type' => 'testimonial',
			'post_per_page' => $number,
			'showposts' => $number
		);
			$testimonials = new WP_Query($args);
			if ($testimonials->have_posts()):
				global $post;
				
		?>
		
		<div id="slider-testimonials">
			<ul>
				<?php while($testimonials->have_posts()): $testimonials->the_post();
					$author_name = get_post_meta($post->ID, 'core_testi_name', true);
				?>
				<li>
					<?php the_content(); ?>
					<strong><?php echo $author_name; ?></strong>
				</li>
				<?php endwhile;?>
			</ul>
			<a class="prev fa fa-angle-left" href=""></a>
            <a class="next fa fa-angle-right" href=""></a>
		</div>
		<?php endif; ?>
		</div>
		
		<?php
		wp_reset_postdata(); 
		echo $after_widget;
	}
}

// Add Widget
function widget_testimonials_init() {
	register_widget('widget_testimonials');
}

add_action('widgets_init', 'widget_testimonials_init');

?>
