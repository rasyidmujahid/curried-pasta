<?php

/*-----------------------------------------------------------------------------------
	Metaboxes for Events Post Type
-----------------------------------------------------------------------------------*/

$meta_box_events = array(
	'id' => 'core-meta-box-events',
	'title' => __('Events Options', CORE_THEME_NAME),
	'post_type' => 'event',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	 array(
			'name' => __('Event Month', CORE_THEME_NAME),
			'desc' => __('Choose the event month ', CORE_THEME_NAME),
			'id' => 'core_event_month',
			'type' => 'select',
			'options' => array(__('January', CORE_THEME_NAME), 
								__('February', CORE_THEME_NAME),
								__('March', CORE_THEME_NAME),
								__('April', CORE_THEME_NAME),
								__('May', CORE_THEME_NAME),
								__('June', CORE_THEME_NAME),
								__('July', CORE_THEME_NAME),
								__('August', CORE_THEME_NAME),
								__('September', CORE_THEME_NAME),
								__('October', CORE_THEME_NAME),
								__('November', CORE_THEME_NAME), 
								__('December', CORE_THEME_NAME)
								)
		),
		array(
			'name' => __('Event Day', CORE_THEME_NAME),
			'desc' => __('Choose the event day. ', CORE_THEME_NAME),
			'id' => 'core_event_day',
			'type' => 'select',
			'options' => array( '1', 
								'2', 
								'3',
								'4',
								'5',
								'6',
								'7',
								'8',
								'9',
								'10',
								'11',
								'12',
								'13',
								'14',
								'15',
								'16',
								'17',
								'18',
								'19',
								'20',
								'21',
								'22',
								'23',
								'24',
								'25',
								'26',
								'27',
								'28',
								'29',
								'30',
								'31'
								)
		),
    	
		array(
    	   'name' => __('Event Year', CORE_THEME_NAME),
    	   'desc' => __('Enter the event year using this format <em>0000.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_year',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Event Time', CORE_THEME_NAME),
    	   'desc' => __('Enter the event time using this format <em>00:00AM/PM to 00:00AM/PM.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_time',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Event Location', CORE_THEME_NAME),
    	   'desc' => __('Enter the event location, example: <em>Cramton Auditorium.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_location',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Event City', CORE_THEME_NAME),
    	   'desc' => __('Enter the city of the event, example: <em>London.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_city',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Event Zip Code', CORE_THEME_NAME),
    	   'desc' => __('Enter the address zip code, example: <em>10308 89.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_zip',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Event Country', CORE_THEME_NAME),
    	   'desc' => __('Enter the event country, example: <em>United Kingdom.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_country',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Event Phone', CORE_THEME_NAME),
    	   'desc' => __('Enter the phone info, example: <em>+44 (0)20 7040 8037.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_phone',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	
    	array(
    	   'name' => __('Event Map Latitude', CORE_THEME_NAME),
    	   'desc' => __('Enter the google map longitude information, example: <em>-12.8809532.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_lat',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Event Map Longitude', CORE_THEME_NAME),
    	   'desc' => __('Enter the google map longitude information, example: <em>-38.4174871.</em>', CORE_THEME_NAME),
    	   'id' => 'core_event_lon',
    	   'type' => 'text',
    	   'std' => ''
    	)
    	
	)
);

add_action('add_meta_boxes', 'core_add_metabox_events');

/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/

function core_add_metabox_events() {
	global $meta_box_events;
	add_meta_box($meta_box_events['id'],$meta_box_events['title'], 'core_events_meta_options', $meta_box_events['post_type'], $meta_box_events['context'], $meta_box_events['priority']);
}

/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function core_events_meta_options() {
	global $meta_box_events, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('Please fill additional fields for events.', CORE_THEME_NAME).'</p>';
	// Use nonce for verification
	//wp_nonce_field( basename( __FILE__ ), 'core_meta_box_nonce' );
	echo '<input type="hidden" name="core_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_events['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		switch ($field['type']) {
 
			
			//If Text		
			case 'text':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
			
			break;
			
			//If textarea		
			case 'textarea':
			
			echo '<tr style="border-top:1px solid #eeeeee;">',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style="line-height:18px; display:block; color:#999; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
				'<td>';
			echo '<textarea name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" rows="8" cols="5" style="width:100%; margin-right: 20px; float:left;">', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '</textarea>';
			
			break;
			
			//If Select	
			case 'select':
			
				echo '<tr>',
				'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; margin:5px 0 0 0; line-height: 18px;">'. $field['desc'].'</span></label></th>',
				'<td>';
			
				echo'<select id="' . $field['id'] . '" name="'.$field['id'].'">';
			
				foreach ($field['options'] as $option) {
					
					echo'<option';
					if ($meta == $option ) { 
						echo ' selected="selected"'; 
					}
					echo'>'. $option .'</option>';
				
				} 
				
				echo'</select>';
			
			break; 
			
		}

	}
 
	echo '</table>';
}

 
add_action('save_post', 'core_save_data_events');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function core_save_data_events($post_id) {
	global $meta_box_events;
 
 	
	// verify nonce
	 if ( !isset($_POST['core_meta_box_nonce']) || !wp_verify_nonce( $_POST['core_meta_box_nonce'], basename(__FILE__) )) {
		return $post_id;
	}
 
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}
 
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
 
	foreach ($meta_box_events['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
 
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], stripslashes(htmlspecialchars($new)));
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	
}

?>