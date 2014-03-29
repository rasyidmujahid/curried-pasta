<?php 
/**
 * The single courses template file.
 *
 * @package WordPress
 * @subpackage Core Framework
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
                        <div class="course-post">
                        	<?php if(has_post_thumbnail()) { ?>
	                            <div class="course-image">
	                                <?php the_post_thumbnail('courses-single'); ?>
	                            </div> <!-- /.course-image -->
                            <?php } ?>
                            <div class="course-details clearfix">
                                <h3 class="course-post-title"><?php the_title(); ?></h3>
                                <?php the_content(); ?>
                                
                                <a href="<?php echo home_url();?>/contact" class="mainBtn pull-right"><?php _e('Apply to this course', CORE_THEME_NAME); ?></a>
                            </div> <!-- /.course-details -->
                        </div> <!-- /.course-post -->
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