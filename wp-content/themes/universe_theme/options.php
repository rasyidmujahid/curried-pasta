<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	// Layout Mode
	$layout_mode = array(
		'wide' => __('Fullwidth Layout', 'options_framework_theme'),
		'boxed' => __('Boxed Layout', 'options_framework_theme')
		
	);
	
	$color_choice = array(
		'blue' => __('Default', 'options_framework_theme'),
		'brown' => __('Brown', 'options_framework_theme'),
		'red' => __('Red', 'options_framework_theme'),
		'violet' => __('Violet', 'options_framework_theme'),
		'yellow' => __('Yellow', 'options_framework_theme'),
	);

	// Display search box in the header
	$core_search_box = array(
		'no' => __('No', 'options_framework_theme'),
		'yes' => __('Yes', 'options_framework_theme')
	);
	
	// Display social icons in the header
	$core_social_icons = array(
		'no' => __('No', 'options_framework_theme'),
		'yes' => __('Yes', 'options_framework_theme')
	);
	
	// Display info in the header
	$core_header_info = array(
		'no' => __('No', 'options_framework_theme'),
		'yes' => __('Yes', 'options_framework_theme')
	);
	
	// Display primary menu in the header
	$core_primary_menu = array(
		'no' => __('No', 'options_framework_theme'),
		'yes' => __('Yes', 'options_framework_theme')
	);
	
	// Footer menu
	$footer_menu_array = array(
		'yes' => __('Yes', 'options_framework_theme'),
		'no' => __('No', 'options_framework_theme')
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );
	
	// Typography Defaults
	$typography_body_defaults = array(
		'size' => '13px',
		'face' => 'Helvetica, Arial, sans-serif',
		'style' => 'normal',
		'color' => '666666' );

	
	// Fonts
	$typography_mixed_fonts = array_merge( options_typography_get_os_fonts() , options_typography_get_google_fonts() );
	asort($typography_mixed_fonts);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}


	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/images/';

	$options = array();
	
	// General Options
	$options[] = array(
		'name' => __('General', 'options_framework_theme'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Logo & Favicon', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'type' => 'info',
		'class' => 'first-heading');

	$options['logo_url'] = array(
		'name' => __('Upload Logo', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your <strong>logo image</strong>. For example <em>http://your_website_url_here/wp-content/themes/theme_folder/images/logo.png</em>', 'options_framework_theme'),
		'id' => 'logo_url',
		'std' => get_stylesheet_directory_uri() . '/core/images/logo.png',
		'type' => 'upload');

	$options['favicon'] = array(
		'name' => __('Upload Favicon (16x16)', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your <strong>favicon</strong>. For example <em>http://your_website_url_here/wp-content/themes/theme_folder/favicon.ico</em>', 'options_framework_theme'),
		'id' => 'favicon',
		'std' => get_stylesheet_directory_uri() . '/core/images/ico/favicon.png',
		'type' => 'upload');
	
	$options['touch_icon_small'] = array(
		'name' => __('Apple Touch Icon (72x72)', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your <strong>Apple Touch Icon</strong>. For example <em>http://your_website_url_here/wp-content/themes/theme_folder/apple-touch-icon-72.png</em>', 'options_framework_theme'),
		'id' => 'touch_icon_small',
		'std' => get_stylesheet_directory_uri() . '/core/images/ico/apple-touch-icon-72.png',
		'type' => 'upload');
	
	$options['touch_icon_medium'] = array(
		'name' => __('Apple Touch Icon (114x114)', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your <strong>Apple Touch Icon</strong>. For example <em>http://your_website_url_here/wp-content/themes/theme_folder/apple-touch-icon-114.png</em>', 'options_framework_theme'),
		'id' => 'touch_icon_medium',
		'std' => get_stylesheet_directory_uri() . '/core/images/ico/apple-touch-icon-114.png',
		'type' => 'upload');
	
	$options['touch_icon_large'] = array(
		'name' => __('Apple Touch Icon (144x144)', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your <strong>Apple Touch Icon</strong>. For example <em>http://your_website_url_here/wp-content/themes/theme_folder/apple-touch-icon-144.png</em>', 'options_framework_theme'),
		'id' => 'touch_icon_large',
		'std' => get_stylesheet_directory_uri() . '/core/images/ico/apple-touch-icon-144.png',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Social Icons', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'type' => 'info');
	
	$options['icon_facebook'] = array(
		'name' => __('Facebook URL', 'options_framework_theme'),
		'desc' => __('Paste here your Facebook URL', 'options_framework_theme'),
		'id' => 'icon_facebook',
		'std' => '',
		'type' => 'text');
	
	$options['icon_twitter'] = array(
		'name' => __('Twitter URL', 'options_framework_theme'),
		'desc' => __('Paste here your Twitter URL', 'options_framework_theme'),
		'id' => 'icon_twitter',
		'std' => '',
		'type' => 'text');
	
	$options['icon_pinterest'] = array(
		'name' => __('Pinterest URL', 'options_framework_theme'),
		'desc' => __('Paste here your Pinterest URL', 'options_framework_theme'),
		'id' => 'icon_pinterest',
		'std' => '',
		'type' => 'text');
	
	$options['icon_googleplus'] = array(
		'name' => __('Google+ URL', 'options_framework_theme'),
		'desc' => __('Paste here your Google+ URL', 'options_framework_theme'),
		'id' => 'icon_googleplus',
		'std' => '',
		'type' => 'text');
	
	$options['icon_youtube'] = array(
		'name' => __('Youtube URL', 'options_framework_theme'),
		'desc' => __('Paste here your Youtube URL', 'options_framework_theme'),
		'id' => 'icon_youtube',
		'std' => '',
		'type' => 'text');
	
	$options['icon_linkedin'] = array(
		'name' => __('Linkedin URL', 'options_framework_theme'),
		'desc' => __('Paste here your Linkedin URL', 'options_framework_theme'),
		'id' => 'icon_linkedin',
		'std' => '',
		'type' => 'text');
	
	$options['icon_instagram'] = array(
		'name' => __('Instagram URL', 'options_framework_theme'),
		'desc' => __('Paste here your Instagram URL', 'options_framework_theme'),
		'id' => 'icon_instagram',
		'std' => '',
		'type' => 'text');
	
	$options['icon_apple'] = array(
		'name' => __('Apple URL', 'options_framework_theme'),
		'desc' => __('Paste here your Apple URL', 'options_framework_theme'),
		'id' => 'icon_apple',
		'std' => '',
		'type' => 'text');
	
	$options['show_rss'] = array(
		'name' => __('Show RSS Icon?', 'options_framework_theme'),
		'desc' => __('Check to show RSS icon on header/footer.', 'options_framework_theme'),
		'id' => 'show_rss',
		'std' => '1',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => __('Sponsors', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'type' => 'info');
	
	$options['show_sponsor'] = array(
		'name' => __('Show Sponsors Section', 'options_framework_theme'),
		'desc' => __('Check to show sponsor section on homepage.', 'options_framework_theme'),
		'id' => 'show_sponsor',
		'std' => '1',
		'type' => 'checkbox');
	
	$options['sponsor_1'] = array(
		'name' => __('Upload Sponsor Image 1', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your sponsor image', 'options_framework_theme'),
		'id' => 'sponsor_1',
		'std' => get_stylesheet_directory_uri() . '/core/images/campus/campus-logo1.png',
		'type' => 'upload');
	
	$options['sponsor_2'] = array(
		'name' => __('Upload Sponsor Image 2', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your sponsor image', 'options_framework_theme'),
		'id' => 'sponsor_2',
		'std' => get_stylesheet_directory_uri() . '/core/images/campus/campus-logo2.png',
		'type' => 'upload');
	
	$options['sponsor_3'] = array(
		'name' => __('Upload Sponsor Image 3', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your sponsor image', 'options_framework_theme'),
		'id' => 'sponsor_3',
		'std' => get_stylesheet_directory_uri() . '/core/images/campus/campus-logo3.png',
		'type' => 'upload');
	
	$options['sponsor_4'] = array(
		'name' => __('Upload Sponsor Image 4', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your sponsor image', 'options_framework_theme'),
		'id' => 'sponsor_4',
		'std' => get_stylesheet_directory_uri() . '/core/images/campus/campus-logo4.png',
		'type' => 'upload');
	
	$options['sponsor_5'] = array(
		'name' => __('Upload Sponsor Image 5', 'options_framework_theme'),
		'desc' => __('Click Upload or Enter the direct path to your sponsor image', 'options_framework_theme'),
		'id' => 'sponsor_5',
		'std' => get_stylesheet_directory_uri() . '/core/images/campus/campus-logo5.png',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Contact Page Map', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'type' => 'info');
	
	$options['contact_lat'] = array(
		'name' => __('Google Maps Latitude Coords', 'options_framework_theme'),
		'desc' => __('Paste here the latitude info of your map. For example: <em>-12.8809532</em>', 'options_framework_theme'),
		'id' => 'contact_lat',
		'std' => '-12.8809532',
		'type' => 'text');
	
	$options['contact_lon'] = array(
		'name' => __('Google Maps Longitude Coords', 'options_framework_theme'),
		'desc' => __('Paste here the longitude info of your map. For example: <em>-38.4174871</em>', 'options_framework_theme'),
		'id' => 'contact_lon',
		'std' => '-38.4174871',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Code Integration', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'type' => 'info');
	
	$options['ga_code'] = array(
		'name' => __('Google Analytics Code', 'options_framework_theme'),
		'desc' => __('You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.', 'options_framework_theme'),
		'id' => 'ga_code',
		'std' => '',
		'type' => 'textarea');

	// Layout Options
	$options[] = array(
		'name' => __('Layout', 'options_framework_theme'),
		'type' => 'heading');
	
	$options['sidebar_pos'] = array( "name" => "Sidebar position",
		"desc" => "Choose sidebar position.",
		"id" => "sidebar_pos",
		"std" => "right",
		"type" => "images",
		"options" => array(
			'left' => $imagepath . '2cl.png',
			'right' => $imagepath . '2cr.png',)
		);
	
	$options['author_info'] = array(
		'name' => __('Enable Author Bio on Blog Pages', 'options_framework_theme'),
		'desc' => __('Check to enable author bio on blog pages.', 'options_framework_theme'),
		'id' => 'author_info',
		'std' => '1',
		'type' => 'checkbox');
	
	// Header Options
	$options[] = array(
		'name' => __('Header', 'options_framework_theme'),
		'type' => 'heading');
	
	$options['primary_menu_id'] = array( 
		"name" => "Display Primary Menu?",
		"desc" => "Display primary menu in the header?",
		"id" => "primary_menu_id",
		"type" => "radio",
		"std" => "yes",
		"options" => $core_primary_menu);

	$options['search_box_id'] = array( 
		"name" => "Display Search Box?",
		"desc" => "Display search box in the header?",
		"id" => "search_box_id",
		"type" => "radio",
		"std" => "yes",
		"options" => $core_search_box);
	
	$options['social_icons_id'] = array( 
		"name" => "Display Social Icons?",
		"desc" => "Display social icons in the header?",
		"id" => "social_icons_id",
		"type" => "radio",
		"std" => "yes",
		"options" => $core_social_icons);
	
	$options['header_info_id'] = array( 
		"name" => "Display Header Info?",
		"desc" => "Display contact info in the header?",
		"id" => "header_info_id",
		"type" => "radio",
		"std" => "yes",
		"options" => $core_header_info);

	$options[] = array(
		'name' => __('Phone Info', 'options_framework_theme'),
		'desc' => __('Type here your phone info. It will be showed only if <strong>Display Header Info</strong> is marked as yes.', 'options_framework_theme'),
		'id' => 'phone_info',
		'std' => '+01 2334 853',
		'type' => 'text');
	
	$options[] = array(
		'name' => __('Mail Info', 'options_framework_theme'),
		'desc' => __('Type here your mail info. It will be showed only if <strong>Display Header Info</strong> is marked as yes.', 'options_framework_theme'),
		'id' => 'mail_info',
		'std' => 'email@universe.com',
		'type' => 'text');

	// Footer Options
	$options[] = array(
		'name' => __('Footer', 'options_framework_theme'),
		'type' => 'heading');

	$options['footer_text'] = array( 
		"name" => "Footer Copyright Text",
		"desc" => "Enter text used in the left side of the footer. HTML tags are allowed.",
		"id" => "footer_text",
		"std" => "",
		"type" => "textarea");
	
	$options['footer_menu'] = array( 
		"name" => "Display Footer menu?",
		"desc" => "Do you want to display footer menu?",
		"id" => "footer_menu",
		"std" => "yes",
		"type" => "radio",
		"options" => $footer_menu_array);

	// Typograpgy Options
	$options[] = array(
		'name' => __('Typography', 'options_framework_theme'),
		'type' => 'heading');

	$options['google_mixed_3'] = array( 'name' => 'Body Text',
		'desc' => 'Choose your prefered font for body text. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the Google Web Fonts library.</em>',
		'id' => 'google_mixed_3',
		'std' => array( 'size' => '13px', 'face' => 'Arial, Helvetica, sans-serif', 'color' => '#666666'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts )
			);
							
	$options['h1_heading'] = array( 'name' => 'H1 Heading',
		'desc' => 'Choose your prefered font for H1 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the Google Web Fonts library.</em>',
		'id' => 'h1_heading',
		'std' => array( 'size' => '30px', 'lineheight' => '30px', 'face' => 'Arial, Helvetica, sans-serif', 'color' => '#333333'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts )
			);
		
	$options['h2_heading'] = array( 'name' => 'H2 Heading',
		'desc' => 'Choose your prefered font for H2 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the Google Web Fonts library.</em>',
		'id' => 'h2_heading',
		'std' => array( 'size' => '22px', 'lineheight' => '22px', 'face' => 'Arial, Helvetica, sans-serif', 'color' => '#333333'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts )
			);
							
	$options['h3_heading'] = array( 'name' => 'H3 Heading',
		'desc' => 'Choose your prefered font for H3 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the Google Web Fonts library.</em>',
		'id' => 'h3_heading',
		'std' => array( 'size' => '18px', 'lineheight' => '18px', 'face' => 'Arial, Helvetica, sans-serif', 'color' => '#333333'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts )
			);
		
	$options['h4_heading'] = array( 'name' => 'H4 Heading',
		'desc' => 'Choose your prefered font for H4 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the Google Web Fonts library.</em>',
		'id' => 'h4_heading',
		'std' => array( 'size' => '13px', 'face' => 'Helvetica, Arial, sans-serif', 'color' => '#282a2c'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts )
			);
							
	$options['h5_heading'] = array( 'name' => 'H5 Heading',
		'desc' => 'Choose your prefered font for H5 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the Google Web Fonts library.</em>',
		'id' => 'h5_heading',
		'std' => array( 'size' => '12px', 'lineheight' => '18px', 'face' => 'Arial, Helvetica, sans-serif', 'color' => '#333333'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts )
			);
							
	$options['h6_heading'] = array( 'name' => 'H6 Heading',
		'desc' => 'Choose your prefered font for H6 heading and titles. <em>Note: fonts marked with <strong>*</strong> symbol will be loaded from the Google Web Fonts library.</em>',
		'id' => 'h6_heading',
		'std' => array( 'size' => '12px', 'lineheight' => '18px', 'face' => 'Arial, Helvetica, sans-serif', 'color' => '#333333'),
		'type' => 'typography',
		'options' => array(
		'faces' => $typography_mixed_fonts )
			);
	
	// Styling Options
	$options[] = array(
		'name' => __('Styling', 'options_framework_theme'),
		'type' => 'heading');
	
	$options[] = array(
		'name' => __('Predefined Color Scheme', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'type' => 'info',
		'class' => 'first-heading');
		
	$options[] = array(
		'name' => __('Predefined Color Scheme', 'options_framework_theme'),
		'desc' => __('Choose a predefined color scheme.', 'options_framework_theme'),
		'id' => 'color_choice',
		'std' => 'default',
		'type' => 'select',
		'options' => $color_choice);
	
	/*$options[] = array(
		'name' => __('Custom Color Scheme', 'options_framework_theme'),
		'desc' => __('', 'options_framework_theme'),
		'type' => 'info');

	$options['accent_color'] = array( 
		"name" => "Accent Color",
		"desc" => "Change the main accent color for links and social icons hover.",
		"id" => "accent_color",
		"std" => "#fecd0b",
		"type" => "color");
	
	$options['first_color'] = array( 
		"name" => "First Color",
		"desc" => "Change color of footer and header backgrounds, buttons and others page elements.",
		"id" => "first_color",
		"std" => "#004884", 
		"type" => "color");
	
	$options['second_color'] = array( 
		"name" => "Second Color",
		"desc" => "Change color of footer social icons background and others elements.",
		"id" => "second_color",
		"std" => "#003a6a",
		"type" => "color"); 
	
	$options['third_color'] = array( 
		"name" => "Third Color",
		"desc" => "Change color of text and links in the footer/header.",
		"id" => "third_color",
		"std" => "#8ab5d6",
		"type" => "color");
	
	$options['fourth_color'] = array( 
		"name" => "Fourth Color",
		"desc" => "Change color of menu separators, borders and links hover in the footer/header.",
		"id" => "fourth_color",
		"std" => "#4782b2",
		"type" => "color"); */

	// Custom CSS Options
	$options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'type' => 'heading' );

	 $options[] = array(
		'name' => __('Custom CSS', 'options_framework_theme'),
		'desc' => __('Advanced CSS Options. Paste your CSS Code.', 'options_framework_theme'),
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');

	return $options;
}