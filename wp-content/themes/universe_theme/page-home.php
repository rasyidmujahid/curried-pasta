<?php  
/** template name: Home Page
 * The Home Page Template.
 *
 * @package WordPress
 * @subpackage Core Framework
 */

get_header();
?>

<div class="container">
        <div class="row">
            <div class="col-md-8">
             	<?php get_template_part('slider'); ?>
            </div> <!-- /.col-md-12 -->
            <?php if ( is_active_sidebar( 'home-sidebar-3' ) ) : ?>
            <div class="col-md-4 request-information">
            	
               <?php dynamic_sidebar( 'home-sidebar-3' ); ?>
              
            </div> <!-- /.col-md-4 -->
            <?php endif; ?>
        </div>
    </div>
    
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
                	<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="col-md-12">
                        <div class="widget-item">
                            
                            <?php the_content(); ?>
                        </div> <!-- /.widget-item -->
                    </div> <!-- /.col-md-12 -->
                   <?php endwhile; else : ?>
                    		<div class="col-md-12">
                    			<div class="widget-main">
                    				<div class="widget-inner">
                    					<p><?php _e( 'No posts found.', CORE_THEME_NAME ); ?></p>
                    				</div>
                    			</div>
                    		</div>
                    <?php endif ?>
                </div> <!-- /.row -->

                <div class="row">

                    <?php if ( is_active_sidebar( 'home-sidebar-1' ) ) : ?>
                    <div class="col-md-6">
                    	<?php dynamic_sidebar( 'home-sidebar-1' ); ?>
                    </div> <!-- /.col-md-6 -->
                    <?php endif; ?>
                    
                    <?php if ( is_active_sidebar( 'home-sidebar-2' ) ) : ?>
                    <div class="col-md-6">
                    	<?php dynamic_sidebar( 'home-sidebar-2' ); ?>
                    </div> <!-- /.col-md-6 -->
                    <?php endif; ?>
                    
                </div> <!-- /.row -->
                
                <?php 
                $show_sponsor = of_get_option('show_sponsor');
				if ($show_sponsor) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget-main">
                            <div class="widget-main-title">
                                <h4 class="widget-title"><?php _e('Our Campus', CORE_THEME_NAME ); ?></h4>
                            </div> <!-- /.widget-main-title -->
                            <div class="widget-inner">
                                <div class="our-campus clearfix">
                                    <ul>
                                    	<?php
	                                    	$sponsor_1 = of_get_option('sponsor_1');
											if ($sponsor_1) { ?>
	                                        	<li><img src="<?php echo $sponsor_1; ?>" alt=""></li>
                                        <?php } ?>
                                        <?php
	                                    	$sponsor_2 = of_get_option('sponsor_2');
											if ($sponsor_2) { ?>
	                                        	<li><img src="<?php echo $sponsor_2; ?>" alt=""></li>
                                        <?php } ?>
                                        <?php
	                                    	$sponsor_3 = of_get_option('sponsor_3');
											if ($sponsor_3) { ?>
	                                        	<li><img src="<?php echo $sponsor_3; ?>" alt=""></li>
                                        <?php } ?>
                                        <?php
	                                    	$sponsor_4 = of_get_option('sponsor_4');
											if ($sponsor_4) { ?>
	                                        	<li><img src="<?php echo $sponsor_4; ?>" alt=""></li>
                                        <?php } ?>
                                         <?php
	                                    	$sponsor_5 = of_get_option('sponsor_5');
											if ($sponsor_5) { ?>
	                                        	<li><img src="<?php echo $sponsor_5; ?>" alt=""></li>
                                        <?php } ?>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- /.widget-main -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
                <?php } ?>

            </div> <!-- /.col-md-8 -->
            <?php
				$sidebar_pos = of_get_option('sidebar_pos');
				if ($sidebar_pos == 'right') {
					get_sidebar();
				}
			?>
     </div> <!--//.row -->
</div> <!--//.container -->

<?php get_footer(); ?>