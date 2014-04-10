<?php

/*-----------------------------------------------------------------------------------
	Metaboxes for Courses Post Type
-----------------------------------------------------------------------------------*/

$meta_box_courses = array(
	'id' => 'core-meta-box-courses',
	'title' => __('Courses Additional Info', CORE_THEME_NAME),
	'post_type' => 'course',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
    	 array(
			'name' => __('Course Avaliable?', CORE_THEME_NAME),
			'desc' => __('Choose a course status.', CORE_THEME_NAME),
			'id' => 'core_course_status',
			'type' => 'select',
			'std' => '',
			'options' => array('',
								__('New Course', CORE_THEME_NAME), 
								__('Not Avaliable', CORE_THEME_NAME)
								
								)
		),
		array(
    	   'name' => __('Courses Discounts', CORE_THEME_NAME),
    	   'desc' => __('Enter percentage discount for this course. ', CORE_THEME_NAME),
    	   'id' => 'core_course_discount',
    	   'type' => 'text',
    	   'std' => ''
    	)
    	
			
	)
);

add_action('add_meta_boxes', 'core_add_metabox_courses');

/*-----------------------------------------------------------------------------------*/
/*	Add metabox to edit page
/*-----------------------------------------------------------------------------------*/

function core_add_metabox_courses() {
	global $meta_box_courses;
	add_meta_box($meta_box_courses['id'],$meta_box_courses['title'], 'core_courses_meta_options', $meta_box_courses['post_type'], $meta_box_courses['context'], $meta_box_courses['priority']);
}

/*-----------------------------------------------------------------------------------*/
/*	Callback function to show fields in meta box
/*-----------------------------------------------------------------------------------*/

function core_courses_meta_options() {
	global $meta_box_courses, $post;
 	
	echo '<p style="padding:10px 0 0 0;">'.__('Please fill additional fields for courses.', CORE_THEME_NAME).'</p>';
	// Use nonce for verification
	echo '<input type="hidden" name="core_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
 
	echo '<table class="form-table">';
 
	foreach ($meta_box_courses['fields'] as $field) {
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

 
add_action('save_post', 'core_save_data_courses');


/*-----------------------------------------------------------------------------------*/
/*	Save data when post is edited
/*-----------------------------------------------------------------------------------*/
 
function core_save_data_courses($post_id) {
	global $meta_box_courses;
 
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
 
	foreach ($meta_box_courses['fields'] as $field) {
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