<?php

add_action( 'after_setup_theme', 'core_setup' );

if ( ! function_exists( 'core_setup' ) ):

function core_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 360, 220, true ); // Normal post thumbnails
		add_image_size('blog-single', 750, 390, true);
		add_image_size('events-thumb', 170, 150, true);
		add_image_size('events-single', 225, 240, true);
		add_image_size('courses-single', 770, 220, true);
		add_image_size('slider-image', 770, 400, true ); // Slider Thumbnail
		add_image_size('gallery-thumb', 260, 180, true ); // Slider Thumbnail
		add_image_size('widget-blog-thumb', 65, 65, true);
		
	}

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// custom menu support
	add_theme_support( 'menus' );
	if ( function_exists( 'register_nav_menus' ) ) {
	  	register_nav_menus(
	  		array(
	  		  'header_menu_primary' => 'Header Menu Primary',
	  		  'header_menu_secondary' => 'Header Menu Secondary',
	  		  'footer_menu' => 'Footer Menu'
	  		)
	  	);
	}
}
endif;

#-----------------------------------------------------------------#
# Register Slider Post Type
#-----------------------------------------------------------------#
function home_slider_register(){
		
	$labels = array(
		'name' => __('Slides', 'taxonomy general name', CORE_THEME_NAME),
		'singular_name' => __('Slide', CORE_THEME_NAME),
		'search_items' => __('Search Slides', CORE_THEME_NAME),
		'all_items' => __('All Slides', CORE_THEME_NAME),
		'parent_item' => __('Parent Slide', CORE_THEME_NAME),
		'edit_item' => __('Edit Slide', CORE_THEME_NAME),
		'update_item' => __('Update Slide', CORE_THEME_NAME),
		'add_new_item' => __('Add New Slide', CORE_THEME_NAME),
		'menu_name' => __('Home Slides', CORE_THEME_NAME)
	);
	
	$args = array(
		'labels' => $labels,
		'singular_label' => __('Home Slides', CORE_THEME_NAME),
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'capability_type' => 'page',
		'query_var' => 'slide',
		'rewrite' => array(
					'slug' => 'slide-view',
					'with_front' => false,
				),
		'menu_icon' => 'dashicons-admin-home',
		'supports' => array(
					'title',
            		'thumbnail',
            		'custom-fields'
				)
	);
	
	register_post_type( 'home_slider', $args );  	
} 

add_action('init','home_slider_register');



/* Include Metaboxes for Slider Custom Post Type*/
include("meta/slider-meta.php");

#-----------------------------------------------------------------#
# Register Events Post Type
#-----------------------------------------------------------------#
function events_post_register(){
		
	$labels = array(
		'name' => __('Events', 'taxonomy general name', CORE_THEME_NAME),
		'singular_name' => __('Event', CORE_THEME_NAME),
		'search_items' => __('Search Events', CORE_THEME_NAME),
		'all_items' => __('All Events', CORE_THEME_NAME),
		'parent_item' => __('Parent Event', CORE_THEME_NAME),
		'edit_item' => __('Edit Event', CORE_THEME_NAME),
		'update_item' => __('Update Event', CORE_THEME_NAME),
		'add_new_item' => __('Add New Event', CORE_THEME_NAME),
		'menu_name' => __('Events', CORE_THEME_NAME)
	);
	
	$args = array(
		'labels' => $labels,
		'singular_label' => __('Events', CORE_THEME_NAME),
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => true,
		'hierarchical' => true,
		'exclude_from_search' => true,
		'capability_type' => 'post',
		'query_var' => 'event',
		'rewrite' => array(
					'slug' => 'event',
					'with_front' => false,
				),
		'menu_icon' => 'dashicons-calendar',
		'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'comments',
					'custom-fields'
				)
	);
	
	register_post_type( 'event', $args );  	
} 

add_action('init','events_post_register');

/* Include Metaboxes for Events Custom Post Type*/
include("meta/events-meta.php");

#-----------------------------------------------------------------#
# Register Courses Post Type
#-----------------------------------------------------------------#

function courses_post_register(){
		
	$labels = array(
		'name' => __('Courses', 'taxonomy general name', CORE_THEME_NAME),
		'singular_name' => __('Course', CORE_THEME_NAME),
		'search_items' => __('Search Courses', CORE_THEME_NAME),
		'all_items' => __('All Courses', CORE_THEME_NAME),
		'parent_item' => __('Parent Course', CORE_THEME_NAME),
		'edit_item' => __('Edit Course', CORE_THEME_NAME),
		'update_item' => __('Update Course', CORE_THEME_NAME),
		'add_new_item' => __('Add New Course', CORE_THEME_NAME),
		'menu_name' => __('Courses', CORE_THEME_NAME)
	);
	
	$args = array(
		'labels' => $labels,
		'singular_label' => __('Courses', CORE_THEME_NAME),
		'public' => true,
		'show_ui' => true,
		'hierarchical' => true, //
		'show_in_nav_menus' => true,
		'exclude_from_search' => true,
		'capability_type' => 'post',
		'query_var' => 'course',
		'rewrite' => array(
					'slug' => 'course',
					'with_front' => false,
				),
		'menu_icon' => 'dashicons-welcome-learn-more',
		'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'comments',
					'custom-fields'
				)
	);
	
	register_post_type('course', $args ); 
	
	
	// Add Taxonomies Attached to Courses Post Type
	
	$disciplines_labels = array(
		'name' => __( 'Courses Disciplines', CORE_THEME_NAME),
		'singular_name' => __( 'Course Discipline', CORE_THEME_NAME),
		'search_items' =>  __( 'Search Courses Disciplines', CORE_THEME_NAME),
		'all_items' => __( 'All Courses Disciplines', CORE_THEME_NAME),
		'parent_item' => __( 'Parent Course Discipline', CORE_THEME_NAME),
		'edit_item' => __( 'Edit Course Disicipline', CORE_THEME_NAME),
		'update_item' => __( 'Update Course Discipline', CORE_THEME_NAME),
		'add_new_item' => __( 'Add New Course Discipline', CORE_THEME_NAME),
	    'menu_name' => __( 'Courses Disciplines', CORE_THEME_NAME)
	); 	
	
	register_taxonomy("course-discipline", 
			array("course"), 
			array("hierarchical" => true, 
					'labels' => $disciplines_labels,
					'show_ui' => true,
	    			'query_var' => true,
					'rewrite' => array( 'slug' => 'course-discipline' )
	));
	
	$campus_labels = array(
		'name' => __( 'Courses Campus', CORE_THEME_NAME),
		'singular_name' => __( 'Course Campus', CORE_THEME_NAME),
		'search_items' =>  __( 'Search Courses Campus', CORE_THEME_NAME),
		'all_items' => __( 'All Courses Campus', CORE_THEME_NAME),
		'parent_item' => __( 'Parent Course Campus', CORE_THEME_NAME),
		'edit_item' => __( 'Edit Course Campus', CORE_THEME_NAME),
		'update_item' => __( 'Update Course Campus', CORE_THEME_NAME),
		'add_new_item' => __( 'Add New Course Campus', CORE_THEME_NAME),
	    'menu_name' => __( 'Courses Campus', CORE_THEME_NAME)
	); 	
	
	register_taxonomy("course-campus", 
			array("course"), 
			array("hierarchical" => true, 
					'labels' => $campus_labels,
					'show_ui' => true,
	    			'query_var' => true,
					'rewrite' => array( 'slug' => 'course-campus' )
	));
	
	$level_labels = array(
		'name' => __( 'Courses Level', CORE_THEME_NAME),
		'singular_name' => __( 'Course Level', CORE_THEME_NAME),
		'search_items' =>  __( 'Search Courses Level', CORE_THEME_NAME),
		'all_items' => __( 'All Courses Level', CORE_THEME_NAME),
		'parent_item' => __( 'Parent Course Level', CORE_THEME_NAME),
		'edit_item' => __( 'Edit Course Level', CORE_THEME_NAME),
		'update_item' => __( 'Update Course Level', CORE_THEME_NAME),
		'add_new_item' => __( 'Add New Course Level', CORE_THEME_NAME),
	    'menu_name' => __( 'Courses Level', CORE_THEME_NAME)
	); 	
	
	register_taxonomy("course-level", 
			array("course"), 
			array("hierarchical" => true, 
					'labels' => $level_labels,
					'show_ui' => true,
	    			'query_var' => true,
					'rewrite' => array( 'slug' => 'course-level' )
	));
  	
} 

add_action('init','courses_post_register');

/* Include Metaboxes for Courses Custom Post Type*/
include("meta/courses-meta.php");

#-----------------------------------------------------------------#
# Register Professors Post Type
#-----------------------------------------------------------------#
function professors_post_register(){
		
	$labels = array(
		'name' => __('Professors', 'taxonomy general name', CORE_THEME_NAME),
		'singular_name' => __('Professor', CORE_THEME_NAME),
		'search_items' => __('Search Professors', CORE_THEME_NAME),
		'all_items' => __('All Professors', CORE_THEME_NAME),
		'parent_item' => __('Parent Professor', CORE_THEME_NAME),
		'edit_item' => __('Edit Professor', CORE_THEME_NAME),
		'update_item' => __('Update Professor', CORE_THEME_NAME),
		'add_new_item' => __('Add New Professor', CORE_THEME_NAME),
		'menu_name' => __('Professors', CORE_THEME_NAME)
	);
	
	$args = array(
		'labels' => $labels,
		'singular_label' => __('Professors', CORE_THEME_NAME),
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'rewrite' => array(
					'slug' => 'professor',
					'with_front' => false,
				),
		'menu_icon' => 'dashicons-businessman',
		'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'custom-fields'
				)
	);
	
	register_post_type('professor', $args );  	
} 

// TODO future Releases Professor Type
//add_action('init','professors_post_register');

/* Include Metaboxes for Events Custom Post Type*/
//include("meta/professors-meta.php");

#-----------------------------------------------------------------#
# Register Testimonials Post Type
#-----------------------------------------------------------------#
function testimonials_post_register(){
		
	$labels = array(
		'name' => __('Testimonials', 'taxonomy general name', CORE_THEME_NAME),
		'singular_name' => __('Testimonial', CORE_THEME_NAME),
		'search_items' => __('Search Testimonials', CORE_THEME_NAME),
		'all_items' => __('All Testimonials', CORE_THEME_NAME),
		'parent_item' => __('Parent Testimonial', CORE_THEME_NAME),
		'edit_item' => __('Edit Testimonial', CORE_THEME_NAME),
		'update_item' => __('Update Testimonial', CORE_THEME_NAME),
		'add_new_item' => __('Add New Testimonial', CORE_THEME_NAME),
		'menu_name' => __('Testimonials', CORE_THEME_NAME)
	);
	
	$args = array(
		'labels' => $labels,
		'singular_label' => __('Testimonials', CORE_THEME_NAME),
		'public' => true,
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'exclude_from_search' => true,
		'rewrite' => array(
					'slug' => 'testimonial',
					'with_front' => false,
				),
		'menu_icon' => 'dashicons-format-chat',
		'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'custom-fields'
				)
	);
	
	register_post_type('testimonial', $args );  	
} 

add_action('init','testimonials_post_register');

/* Include Metaboxes for Events Custom Post Type*/
include("meta/testimonials-meta.php");

#-----------------------------------------------------------------#
# Register Gellery Post Type
#-----------------------------------------------------------------#

function gallery_post_register(){
		
	$labels = array(
		'name' => __('Gallery', 'taxonomy general name', CORE_THEME_NAME),
		'singular_name' => __('Gallery', CORE_THEME_NAME),
		'search_items' => __('Search Gallery Item', CORE_THEME_NAME),
		'all_items' => __('All Gallery Items', CORE_THEME_NAME),
		'parent_item' => __('Parent Gallery Item', CORE_THEME_NAME),
		'edit_item' => __('Edit Gallery', CORE_THEME_NAME),
		'update_item' => __('Update Gallery Item', CORE_THEME_NAME),
		'add_new_item' => __('Add New Gallery Item', CORE_THEME_NAME),
		'menu_name' => __('Gallery', CORE_THEME_NAME)
	);
	
	$args = array(
		'labels' => $labels,
		'singular_label' => __('Gallery', CORE_THEME_NAME),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'hierarchical' => false,
		'show_in_nav_menus' => true,
		'exclude_from_search' => true,
		'rewrite' => array(
					'slug' => 'gallery',
					'with_front' => false,
				),
		'menu_icon' => 'dashicons-format-gallery',
		'supports' => array(
					'title',
					'thumbnail',
					'excerpt',
					'custom-fields'
				)
	);
	
	register_post_type('gallery', $args );  
	
	
	//Add Taxonomies Attached to Gallery Post Type
	
	$gallery_labels = array(
		'name' => __( 'Gallery Categories', CORE_THEME_NAME),
		'singular_name' => __( 'Gallery Category', CORE_THEME_NAME),
		'search_items' =>  __( 'Search Gallery Category Items', CORE_THEME_NAME),
		'all_items' => __( 'All Gallery Category Items', CORE_THEME_NAME),
		'parent_item' => __( 'Parent Gallery Category', CORE_THEME_NAME),
		'edit_item' => __( 'Edit Gallery Category Item', CORE_THEME_NAME),
		'update_item' => __( 'Update Gallery Category Item', CORE_THEME_NAME),
		'add_new_item' => __( 'Add New Gallery Category Item', CORE_THEME_NAME),
	    'menu_name' => __( 'Galery Categories', CORE_THEME_NAME)
	); 	
	
	register_taxonomy("gallery-category", 
			array("gallery"), 
			array("hierarchical" => true, 
					'labels' => $gallery_labels,
					'show_ui' => true,
	    			'query_var' => true,
					'rewrite' => array( 'slug' => 'gallery-category' )
	));	
} 

add_action('init','gallery_post_register');

?>