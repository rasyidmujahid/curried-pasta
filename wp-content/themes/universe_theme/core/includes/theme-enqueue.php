<?php

/* ------------------------------------------------------------------------ */
/* Register and load javascripts
/* ------------------------------------------------------------------------ */

function core_main_js() {
		
	if(!is_admin()) {
			
		// Register
		wp_register_script('jquery-migrate', 'http://code.jquery.com/jquery-migrate-1.2.1.min.js');
		wp_register_script('modernizr', get_template_directory_uri(). '/core/js/modernizr.js', 'jquery', '2.6.2');
		wp_register_script('bootstrap-plugins', get_template_directory_uri(). '/core/bootstrap/js/bootstrap.min.js', false, false, true);
		wp_register_script('jquery-plugins', get_template_directory_uri(). '/core/js/plugins.js', 'jquery', false, true);
		wp_register_script('plugins-init', get_template_directory_uri(). '/core/js/custom.js', 'jquery', '1.0', true);

		
		// Load
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-migrate');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('bootstrap-plugins');
		wp_enqueue_script('jquery-plugins');
		wp_enqueue_script('plugins-init');
		
		
		// Conditional Enqueue
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
		}
		
		// Contact
		//if ( is_page_template('page-contact.php') ) {
			//wp_register_script('contact-map', get_template_directory_uri() . '/core/js/contact-map.php', false, false, true);
			
		
			//wp_enqueue_script('contact-map');
		//}
		
		// Events
		//if ( is_page_template('single-event.php') ) {
			//wp_register_script('event-map', get_template_directory_uri() . '/core/js/event-map.php', false, false, true);
			
		
			//wp_enqueue_script('event-map');
		//}
	}
}

add_action('wp_enqueue_scripts', 'core_main_js');


/* ------------------------------------------------------------------------ */
/* Register and load CSS
/* ------------------------------------------------------------------------ */

function core_main_styles() {
		
	// Register
	wp_register_style('bootstrap-css', get_template_directory_uri(). '/core/bootstrap/css/bootstrap.css');
	wp_register_style('font-awesome', get_template_directory_uri(). '/core/css/font-awesome.min.css');
	wp_register_style('animate', get_template_directory_uri(). '/core/css/animate.css');
	wp_register_style('main-styles', get_stylesheet_directory_uri(). '/style.css');
	
	
	// Load
	wp_enqueue_style('bootstrap-css');
	wp_enqueue_style('font-awesome');
	wp_enqueue_style('animate');
	wp_enqueue_style('main-styles');
	
	// Load Predefined Color Schemes
	$color = of_get_option('color_choice');
	if ($color) {
		wp_register_style('predefined-color', get_stylesheet_directory_uri(). '/core/css/colors/'.$color.'.css');
		wp_enqueue_style('predefined-color');
	} else {
		wp_register_style('default-color', get_stylesheet_directory_uri(). '/core/css/colors/blue.css');
		wp_enqueue_style('default-color');
		
	}
	
	// Custom CSS
	wp_register_style('custom_css', get_stylesheet_directory_uri() . '/core/css/custom.css.php', 'style');
	wp_enqueue_style('custom_css');	
}

add_action('wp_print_styles', 'core_main_styles');

?>