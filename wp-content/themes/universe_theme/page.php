<?php
/** The default page template file.
 * 
 * @package WordPress
 * @subpackage Core framework
 */

get_header(); ?>
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
                    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    	<div <?php post_class(); ?>>
	                        <div class="widget-main">
	                            <div class="widget-inner">
	                                <h3 class="archive-title"><?php the_title(); ?></h3>
										<?php the_content(); ?>
										<?php wp_link_pages(); ?>
										
	                            </div> <!-- /.widget-inner -->
	                        </div> <!-- /.widget-main -->
                       </div>
                        <?php endwhile; else : ?>
                    		<p><?php _e( 'No posts found.', CORE_THEME_NAME ); ?></p>
                    	<?php endif ?>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
                <?php comments_template(); ?>
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