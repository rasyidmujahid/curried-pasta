<?php

/**
 * Core only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
	require get_template_directory() . '/core/includes/back-compat.php';
}


/* ------------------------------------------------------------------------ */
/* Theme Constants
/* ------------------------------------------------------------------------ */

define('CORE_DIRECTORY', get_template_directory(). '/core');
define('CORE_THEME_NAME', 'universe');

/* ------------------------------------------------------------------------ */
/* Translation
/* ------------------------------------------------------------------------ */

add_action('after_setup_theme', 'lang_setup');
function lang_setup(){
	load_theme_textdomain(CORE_THEME_NAME, CORE_DIRECTORY . '/languages');
}

#-----------------------------------------------------------------#
# Category Rel Fix
#-----------------------------------------------------------------#

function remove_category_list_rel( $output ) {
    // Remove rel attribute from the category list
    return str_replace( ' rel="category tag"', '', $output );
}
 
add_filter( 'wp_list_categories', 'remove_category_list_rel' );
add_filter( 'the_category', 'remove_category_list_rel' );

/* ------------------------------------------------------------------------ */
/* Threaded Comments
/* ------------------------------------------------------------------------ */


if(!function_exists('enable_threaded_comments')) {
	function enable_threaded_comments()
	{
		if (!is_admin()) {
			if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
				wp_enqueue_script('comment-reply');
			}
		}	
	}
add_action('get_header', 'enable_threaded_comments');
}

/* ------------------------------------------------------------------------ */
/* Includes
/* ------------------------------------------------------------------------ */

// Register and load CSS/JS
require_once CORE_DIRECTORY. '/includes/theme-enqueue.php'; 

// Theme Setup
require_once CORE_DIRECTORY. '/includes/theme-init.php';

// Theme Additional Functions
require_once CORE_DIRECTORY. '/includes/theme-function.php';

// Theme Typography (Google Fonts, System Fonts)
require_once CORE_DIRECTORY. '/includes/theme-typography.php';

// Theme Widgets and Sidebar
require_once CORE_DIRECTORY. '/includes/sidebar-init.php';

// Theme Advanced Search for Courses
require_once CORE_DIRECTORY. '/includes/wpas.php';

// Theme Widgets
include_once CORE_DIRECTORY. '/includes/widgets/core-recent-posts.php';
include_once CORE_DIRECTORY. '/includes/widgets/core-latest-events.php';
include_once CORE_DIRECTORY. '/includes/widgets/core-testimonials.php';
include_once CORE_DIRECTORY. '/includes/widgets/core-flickr.php';


//Automatic Plugin Activation
require_once CORE_DIRECTORY . '/includes/class-tgm-plugin-activation.php';
require_once CORE_DIRECTORY . '/includes/register-plugins.php';

/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
require_once dirname( __FILE__ ) . '/admin/options-framework.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */

add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}

/*
 * Add login/logout link into menu
 */

add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
	if( $args->theme_location == 'header_menu_primary' ) {
		ob_start();
        wp_loginout('index.php');
        $loginoutlink = ob_get_contents();
        ob_end_clean();
        $items .= '<li>'. $loginoutlink .'</li>';
    }
    return $items;
}