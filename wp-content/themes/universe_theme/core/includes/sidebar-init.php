<?php
function core_widgets_init() {
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'			=> __('Sidebar', CORE_THEME_NAME ),
		'id' 			=> 'sidebar-widget-area',
		'description'   => __( 'Located at the left/right side of pages.', CORE_THEME_NAME ),
		'before_widget' => '<div id="%1$s" class="widget-main">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-main-title"><h4 class="widget-title">',
		'after_title' => '</h4></div>',
	));
	// Footer Widget
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'			=> '#Footer Area 1',
		'id' 			=> 'footer-sidebar-1',
		'description'   => __( 'Located at the bottom of pages.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'				=> '#Footer Area 2',
		'id' 				=> 'footer-sidebar-2',
		'description'   => __( 'Located at the bottom of pages.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'				=> '#Footer Area 3',
		'id' 			=> 'footer-sidebar-3',
		'description'   => __( 'Located at the bottom of pages.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'			=> '#Footer Area 4',
		'id' 			=> 'footer-sidebar-4',
		'description'   => __( 'Located at the bottom of pages.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));
	// Location: at the top of the footer, above the copyright
	register_sidebar(array(
		'name'			=> '#Footer Area 5',
		'id' 			=> 'footer-sidebar-5',
		'description'   => __( 'Located at the bottom of pages.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="footer-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="footer-widget-title">',
		'after_title' => '</h4>',
	));
	
	// Location: on the bottom left side of the homepage
	register_sidebar(array(
		'name'			=> 'Homepage Left Content',
		'id' 			=> 'home-sidebar-1',
		'description'   => __( 'Located on the bottom left side of the homepage.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="widget-main">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-main-title"><h4 class="widget-title">',
		'after_title' => '</h4></div>',
	));
	
	// Location: on the bottom left side of the homepage
	register_sidebar(array(
		'name'			=> 'Homepage Right Content',
		'id' 			=> 'home-sidebar-2',
		'description'   => __( 'Located on the bottom right side of the homepage.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="widget-main">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-main-title"><h4 class="widget-title">',
		'after_title' => '</h4></div>',
	));
	
	// Location: on the top side of the homepage
	register_sidebar(array(
		'name'			=> 'Homepage Top Content',
		'id' 			=> 'home-sidebar-3',
		'description'   => __( 'Located on the top of the homepage.', CORE_THEME_NAME),
		'before_widget' => '<div id="%1$s" class="widget-main">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));

}
/** Register sidebars by running core_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'core_widgets_init' );
?>