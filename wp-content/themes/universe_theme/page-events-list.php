<?php 
/**template name: Events List
 * The events grid template file.
 *
 * @package WordPress
 * @subpackage Core Framework
 */

get_header();
?>
<div class="container">
	<div class="row">
		<?php //$sidebar = get_sidebar();
			$sidebar_pos = of_get_option('sidebar_pos');
			if ($sidebar_pos == 'left') {
				get_sidebar();
			}
		?>
		<!-- Here begin Main Content -->
		<div id="ajax-container" class="col-md-8">
			<div class="row">
				<div class="col-md-12">
					<?php
			           	global $wp_query;
						$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	                 	$wp_query = new WP_Query(array( 'post_type' => 'event', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged ));
					 	if($wp_query->have_posts()): ?>
				 	
				 		<?php while ($wp_query->have_posts()): $wp_query->the_post();
									 
							// Get the custom metabox with aditional informations for events
							$event_date = NULL;
							$event_month = get_post_meta($post->ID, 'core_event_month', true);
							$event_day = get_post_meta($post->ID, 'core_event_day', true);
							$event_year = get_post_meta($post->ID, 'core_event_year', true);
							$event_time = get_post_meta($post->ID, 'core_event_time', true);
							$event_location = get_post_meta($post->ID, 'core_event_location', true);
							if($event_location ==''){
								$event_location = __('Location Not Set', CORE_THEME_NAME);
							}
										
							if(!empty($event_month) && (!empty($event_day)) && (!empty($event_year))) {
								$event_date = $event_month . ' ' . $event_day . ', ' . $event_year;
							}
							else {
								$event_date = __('Date Not Set', CORE_THEME_NAME);
						}
						?> 

						<div class="post-item list-event-item">
                            <div class="box-content-inner clearfix">
                            	<?php if(has_post_thumbnail()) { ?>
                                <div class="list-event-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('events-thumb'); ?>
                                    </a>
                                </div>
                                <?php } ?>
                                <div class="list-event-header">
                                    <span class="event-place small-text"><i class="fa fa-globe"></i>
                                    	<?php
										if ($event_location) {
											echo $event_location;
										}
										?>
                                    </span>
                                    <span class="event-date small-text"><i class="fa fa-calendar-o"></i>
                                    	<?php echo $event_date; ?>
                                    </span>
                                    <div class="view-details"><a href="<?php the_permalink(); ?>" class="lightBtn"><?php _e('View Details &rarr;', CORE_THEME_NAME); ?></a></div>
                                </div>
                                <h5 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <?php the_excerpt(); ?> 
                            </div> <!-- /.box-content-inner -->
                        </div> <!-- /.list-event-item -->
						<?php endwhile; ?>
                    	<?php endif; ?>
                    	<?php wp_reset_postdata(); ?>
						</div>
						<!-- /.col-md-12 -->
			</div> <!-- /.row -->
			<?php get_template_part('core/includes/index-loadmore'); ?>
			<div id="ajax-container-new" class="row"></div>
			 <?php core_paging_nav(); ?>
			
		</div>
		<!-- /.col-md-8 -->
		<?php
			$sidebar_pos = of_get_option('sidebar_pos');
			if ($sidebar_pos == 'right') {
				get_sidebar();
			}
		?>
	</div>
	<!-- /.row -->
</div><!-- /.container -->
<?php get_footer(); ?>