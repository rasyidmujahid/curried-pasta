<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Core Framework
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
            <div id="ajax-container" class="col-md-8">
                <div  class="row">
                	<?php if(have_posts()) : while (have_posts()) : the_post(); ?>

                    <div class="post-item col-md-6 col-sm-6">
                    	<div <?php post_class();?>>
	                        <div class="blog-grid-item" id="post-<?php the_ID(); ?>">
	                            <div class="blog-grid-thumb">
	                                <span class="cat-blog"><?php the_category(', ') ?></span>
	                                <a href="<?php the_permalink(); ?>">
	                                	<?php if (has_post_thumbnail()) {
	                                			
	                                		the_post_thumbnail(); 
											} else { ?>
												<img src="http://placehold.it/360x220" alt="">
	                                	
	                                	<?php } ?>
	                                </a>
	                            </div>
	                            <div class="box-content-inner">
	                                <h4 class="blog-grid-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
	                                <p class="blog-grid-meta small-text">
	                                	<span><?php the_time('F j, Y'); ?></span>
	                                	<?php _e(' With ', CORE_THEME_NAME ); ?>
	                                	<span><?php comments_popup_link('No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?></span>
	                                </p>
	                            </div> <!-- /.box-content-inner -->
	                        </div> <!-- /.blog-grid-item -->
                        </div> <!-- /.post-class -->
                    </div> <!-- /.col-md-6 -->
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

				<?php //get_template_part('core/includes/index-loadmore'); ?>
                       
                <div id="ajax-container-new" class="row"></div>
   
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