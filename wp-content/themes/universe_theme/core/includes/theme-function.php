<?php

 // Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 900;
}
/* 
 * Snippet from: http://wpengineer.com/1960/display-post-thumbnail-post-page-overview
 * 
 */
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	
	// for post and page
	add_theme_support('post-thumbnails', array( 'post', 'page' ) );
	
	function fb_AddThumbColumn($cols) {
		
		$cols['thumbnail'] = __('Thumbnail', CORE_THEME_NAME);
		
		return $cols;
	}
	
	function fb_AddThumbValue($column_name, $post_id) {
			
			$width = (int) 35;
			$height = (int) 35;
			
			if ( 'thumbnail' == $column_name ) {
				// thumbnail of WP 2.9
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				// image from gallery
				$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				elseif ($attachments) {
					foreach ( $attachments as $attachment_id => $attachment ) {
						$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
					}
				}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None', CORE_THEME_NAME);
					}
			}
	}
	
	// for posts
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
	
	// for pages
	add_filter( 'manage_pages_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_pages_custom_column', 'fb_AddThumbValue', 10, 2 );
}

/*-----------------------------------------------------------------------------------*/
/*	Outputs a Google Map Based on Paramenters Entered
/*-----------------------------------------------------------------------------------*/

function core_print_map($lat, $lon) {
	$lat_info = $lat;
	$lon_info = $lon;
	?>
	<script>
		function initialize() {
			var mapOptions = {
			zoom : 8,
			center : new google.maps.LatLng(<?php echo $lat_info;?>,  <?php echo $lon_info;?>)
			};
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		}

		function loadScript() {
			var script = document.createElement('script');
			script.type = 'text/javascript';
			script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
			document.body.appendChild(script);
		}

		window.onload = loadScript; 
	</script>
<?php }

/*-----------------------------------------------------------------------------------*/
/*	Advanced Search For Courses Page
/*-----------------------------------------------------------------------------------*/

function course_search_args() {
	$args = array();
	$args['form'] = array('action' => home_url().'/courses-search-results/',
    'method' => 'GET',
    'id' => 'courses-search',
    'name' => 'courses-search',
    'class' => 'course-search-form');
						
	$args['wp_query'] = array('post_type' => 'course',
	'posts_per_page' => -1,
	'order' => 'DESC',
	'orderby' => 'date');
						
	$args['fields'][] = array('type' => 'search',
	'label' => '',
	'value' => '',
	'placeholder' => __('Type Course Title in Here', CORE_THEME_NAME),
	'class' => 'searchbox',
	'operator' => 'OR');
						
	$args['fields'][] = array('type' => 'taxonomy',
	'label' => __('Campus:', CORE_THEME_NAME),
	'taxonomy' => 'course-campus',
	'format' => 'select',
	'default' => '-- select --',
	'class' => 'searchselect',
	'operator' => 'OR');
						
	$args['fields'][] = array('type' => 'taxonomy',
	'label' => __('Discipline:', CORE_THEME_NAME),
	'taxonomy' => 'course-discipline',
	'format' => 'select',
	'default' => '-- select --',
	'class' => 'searchselect',
	'operator' => 'OR');
						
	$args['fields'][] = array('type' => 'taxonomy',
	'label' => __('Study Level:', CORE_THEME_NAME),
	'taxonomy' => 'course-level',
	'format' => 'select',
	'default' => '-- select --',
	'class' => 'searchselect',
	'operator' => 'OR');
						
	$args['fields'][] = array('type' => 'submit',
	'value' => __('Submit Search', CORE_THEME_NAME),
	'class'=> 'mainBtn');
	
	return $args;
}

/*-----------------------------------------------------------------------------------*/
/*	Pagination
/*-----------------------------------------------------------------------------------*/

function core_paging_nav() {

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $GLOBALS['wp_query']->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '<i class="fa fa-angle-left"></i>', 'twentyfourteen' ),
		'next_text' => __( '<i class="fa fa-angle-right"></i>', 'twentyfourteen' ),
	) );

	if ( $links ) :

	?>
	<nav class="row navigation" role="navigation">
		<div class="col-md-12">
			<div class="paging-navigation">
				<div class="row">
	
					<div class="col-md-6 page-info">
						<h6 class="small-text">
							<?php 
								echo __('Page', CORE_THEME_NAME).' '.$paged.' '.__('of', CORE_THEME_NAME).' '.$GLOBALS['wp_query']->max_num_pages;
							?>
						</h6>
					</div>
					<div class="col-md-6 loop-pagination">
							<?php echo $links; ?>
					</div><!-- .pagination -->
				</div>
			</div>
		</div>
	</nav><!-- .navigation -->
	<?php
	endif;
}

#-----------------------------------------------------------------#
# Display Previous/Next Links
#-----------------------------------------------------------------#

if ( ! function_exists( 'core_post_nav' ) ) :

function core_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>

	 <div class="prev-next-post clearfix">
	     <span class="whiteBtn">
	     	
	     	<?php previous_post_link( '%link', _x( '<i class="fa fa-angle-left"></i> Older Post', 'Older Post', CORE_THEME_NAME ) ); ?>
	     </span>
	     <span class="whiteBtn">
	     	
	     	<?php next_post_link( '%link', _x( ' Newer Post <i class="fa fa-angle-right"></i>', 'Newer Post', CORE_THEME_NAME ) ); ?>

	     </span>
     </div>
	
	<?php
}
endif;

#-----------------------------------------------------------------#
# Excerpt Related Functions
#-----------------------------------------------------------------#

//excerpt length
function excerpt_length( $length ) {
	return 30;
}

add_filter( 'excerpt_length', 'excerpt_length', 999 );

//custom excerpt ending
function excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'excerpt_more');

//fixing filtering for shortcodes
function shortcode_empty_paragraph_fix($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');


/*-----------------------------------------------------------------------------------*/
/*	Ajax Load Posts New
/*-----------------------------------------------------------------------------------*/

function core_ajax_init() {
 		
 	global $wp_query;

 	// Add code to index pages.
 	if( !is_admin() ) { //!is_singular()
 		
		// Enqueue jQuery Script to Process Ajax
		wp_enqueue_script(
			'core_custom',
			get_template_directory_uri(). '/core/js/ajax-load-posts.js',
			array('jquery'),
			'1.0',
			true
		);

 		// What page are we on? And what is the pages limit?
 		$max = $wp_query->max_num_pages;
 		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		//echo $max;

 		// Add some parameters for the JS.
 		wp_localize_script(
 			'core_custom',
 			'core',
 			array(
 				'startPage' => $paged,
 				'maxPages' => $max,
 				'nextLink' => next_posts($max, false)
 			)
 		);
 	}
 }

add_action('template_redirect', 'core_ajax_init');


/*-----------------------------------------------------------------------------------*/
/*	Breadcrumbs
/*-----------------------------------------------------------------------------------*/

function breadcrumbs() {
  	
  $showOnHome = 0; // 1 - show "breadcrumbs" on home page, 0 - hide
  $delimiter = ''; // divider
  $home = 'Home'; // text for link "Home"
  $showCurrent = 1; // 1 - show title current post/page, 0 - hide
  $before = '<h6><span class="page-active">'; // open tag for active breadcrumb
  $after = '</span></h6>'; // close tag for active breadcrumb

  global $post;
  $homeLink = home_url();

  if (is_front_page()) {

    if ($showOnHome == 1) echo '<div class="col-md-12"><h6><a href="' . $homeLink . '">' . $home . '</a></h6></div>';

  } else {

    echo '<div class="col-md-12"><h6><a href="' . $homeLink . '">' . $home . '</a></h6> ' . $delimiter . ' ';
	
	if ( is_home() ) {
		echo $before . 'Blog' . $after;
	} elseif ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . 'Category Archives: "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_search() ) {
      echo $before . 'Search for: "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
      echo '<h6><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></h6> ' . $delimiter . ' ';
      echo '<h6><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></h6> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<h6><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></h6> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
      	$post_name = get_post_type();
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<h6><a href="' . $homeLink . '/' . $post_name . '/">' . $post_type->labels->menu_name . '</a></h6>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        //echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<h6><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></h6>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<h6><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></h6>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Tag Archives: "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . 'by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . '404' . $after;
    }

    echo '</div>';

  }
	
}



?>