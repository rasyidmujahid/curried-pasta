<?php
/** template name: Archives
 * The archives template file.
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
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                    	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="widget-main">
                            <div class="widget-inner">
                                <?php the_content(); ?>
                                <h3 class="archive-title"><?php _e('Latest 10 Posts:', CORE_THEME_NAME); ?></h3>
                                <?php $archive_10 = get_posts('numberposts=30');
                                foreach($archive_10 as $post) : ?>
	                                <ul class="archive-list">
	                                    <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
	                                </ul>
                                <?php endforeach; ?>
                                <h3 class="archive-title"><?php _e('Archives by Month:', CORE_THEME_NAME); ?></h3>
                                <ul class="archive-list">
                                    <?php wp_get_archives('type=monthly'); ?>
                                </ul>
                                <h3 class="archive-title"><?php _e('Archives by Categories', CORE_THEME_NAME); ?></h3>
                                <ul class="archive-list">
                                    <?php wp_list_categories( 'title_li=' ); ?>
                                </ul>
                            </div> <!-- /.widget-inner -->
                        </div> <!-- /.widget-main -->
                        <?php endwhile; endif; ?>
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