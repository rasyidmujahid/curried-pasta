<?php 
/*
 * The single events template file.
 *
 * @package WordPress
 * @subpackage Core framework
 */

get_header(); 
?>
    <div class="container">
        <div class="row">
        	<?php
				$sidebar_pos = of_get_option('sidebar_pos');
				if ($sidebar_pos == 'left') {
					get_sidebar();
				}
				
			?>
            <!-- Here begin Main Content -->
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                    	<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="event-container clearfix">
                            <div class="left-event-content">
                                <?php the_post_thumbnail('events-single'); ?>
                                <div class="event-contact">
                                    <h4>Contact Details</h4>
                                    <?php 
                                    	$event_location = get_post_meta(get_the_id(), 'core_event_location', true);
										$event_city = get_post_meta(get_the_id(), 'core_event_city', true);
										$event_zip_code = get_post_meta(get_the_id(), 'core_event_code', true);
										$event_country = get_post_meta(get_the_id(), 'core_event_country', true);
										$event_phone = get_post_meta(get_the_id(), 'core_event_phone', true);
                                    ?>

                                    <ul>
                                        <li><?php the_title(); ?></li>                                     
                                        <li><?php echo $event_location; ?></li>
                                        <li><?php echo $event_city; ?></li>
                                        <li><?php echo $event_zip_code; ?></li>
                                        <li><?php echo $event_country; ?></li>
                                        <li><?php echo $event_phone; ?></li>
                                    </ul>
                                </div>
                            </div> <!-- /.left-event-content -->
                            <div class="right-event-content">
                                <h2 class="event-title"><?php the_title(); ?></h2> 
                                <?php the_content(); ?>
                               
                                <div class="google-map-canvas" id="map-canvas"></div>
                                <?php
			                    	
									$lat = stripslashes(get_post_meta(get_the_id(), 'core_event_lat', true));
									$lon = stripslashes(get_post_meta(get_the_id(), 'core_event_lon', true));
	
									core_print_map($lat, $lon);
								?>
                                
                            </div> <!-- /.right-event-content -->
                        </div> <!-- /.event-container -->
                        <?php endwhile; else : ?>
                    		<p><?php _e( 'No posts found.', CORE_THEME_NAME ); ?></p>
                    	<?php endif ?>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.col-md-8 -->
            <?php
				$sidebar_pos = of_get_option('sidebar_pos');
				if ($sidebar_pos == 'right') {
					get_sidebar();
				}
			?>
        </div> <!-- /.row -->
    </div> <!-- /.container -->
<?php get_footer(); ?>