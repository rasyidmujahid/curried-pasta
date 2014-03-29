<?php
/** template name: Contact
 * The default page template file.
 * 
 * @package WordPress
 * @subpackage Core Framework
 */

get_header(); ?>
    <div class="container">
        <div class="row">       	
        	<div class="col-md-5">
                <div class="contact-map">
                    <div class="google-map-canvas" id="map-canvas"></div>
                    <?php
                    	$lat = of_get_option('contact_lat');
						$lon = of_get_option('contact_lon');
						core_print_map($lat, $lon);
					?>
                </div>
            </div> <!-- /.col-md-5 -->
            <!-- Here begin Main Content -->
            <div class="col-md-7"> 
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                		<div class="contact-page-content">
	                    <div class="contact-heading">
	                        <h3><?php the_title(); ?></h3>
	                        <?php the_content(); ?>
	                    </div>
	                </div>
                    <?php endwhile; else : ?>
                    	<p><?php _e( 'No posts found.', CORE_THEME_NAME ); ?></p>
                    <?php endif ?>
            </div> <!-- /.col-md-7 -->  
        </div> <!-- /.row -->
    </div> <!-- /.container -->
<?php get_footer(); ?>