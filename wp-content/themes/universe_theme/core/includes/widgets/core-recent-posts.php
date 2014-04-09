<?php

/*
Plugin Name: Custom Recent Posts Widget
Plugin URI: http://
Description: A simple but powerful widget to display recent posts.
Version: 1.00
Author: plugthemes
Author URI: http://
*/

class widget_recent_posts extends WP_Widget {
		
	public function __construct() {
		// Widget Actual Process
		parent::__construct(
			'core_recent_posts',
			'Core Recent Posts',
			array('description' => __('Display Recent Posts', CORE_THEME_NAME))
			);
	}
	
	public function form($instance) {
		// Outputs the Options Form on Admin
		$defaults = array('title' => __('Latest News', CORE_THEME_NAME ), 'number' => 3);
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
			'post_type' => 'post',
			'post_per_page' => $number,
			'showposts' => $number
		);
			$recent_posts = new WP_Query($args);
			if ($recent_posts->have_posts()):
		?>
		<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
		<div class="blog-list-post clearfix">
			<?php if (has_post_thumbnail()) { ?>
				<div class="blog-list-thumb">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('widget-blog-thumb'); ?>
					</a>
				</div>
			<?php } ?>
			<div class="blog-list-details">
				<h5 class="blog-list-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h5>
				<div class="blog-list-meta small-text">
					<span><?php the_time('F j, Y'); ?></span>
					<?php _e('With', CORE_THEME_NAME ); ?>
					<span><a href="<?php comments_link(); ?>"><?php comments_number( __('No Comments', CORE_THEME_NAME), __('One Comment ', CORE_THEME_NAME), __('% Comments', CORE_THEME_NAME) ); ?></a></span>
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
function widget_recent_posts_init() {
	register_widget('widget_recent_posts');
}

add_action('widgets_init', 'widget_recent_posts_init');

?>
