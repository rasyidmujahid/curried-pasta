<?php
/** template name: Gallery
 * The default page template file.
 * 
 * @package WordPress
 * @subpackage Core Framework
 */

get_header(); ?>
    <div class="container">
        <div class="row">

            <div class="col-md-3 sidebar-gallery">
                <div class="widget-main">
                    <div class="widget-inner">
                    	<?php get_search_form(); ?>
                        
                    </div> <!-- /.widget-inner -->
                </div> <!-- /.widget-main -->

                <div class="widget-main">
                    <div class="widget-main-title">
                        <h4 class="widget-title"><?php _e('Filter Controls', CORE_THEME_NAME); ?></h4>
                    </div>
                    <div class="widget-inner">
                        <ul class="mixitup-controls">
                            <li class="filter" data-filter="all"><?php _e('Show All', CORE_THEME_NAME); ?></li>
                            <?php
                            	$args = array('exclude' => '1', 'taxonomy' => 'gallery-category');
								$categories = get_categories($args);
								foreach ($categories as $category) {
									echo '<li class="filter" data-filter="'.$category->slug.'">'.$category->name.'</li>';
									
								}
                             ?>
                            
                        </ul>
                    </div> <!-- /.widget-inner -->
                </div> <!-- /.widget-main -->

                <div class="widget-main">
                    <div class="widget-main-title">
                        <h4 class="widget-title"><?php _e('Sort Controls', CORE_THEME_NAME); ?></h4>
                    </div>
                    <div class="widget-inner">
                        <ul class="mixitup-controls">
                            <li class="sort active" data-sort="default" data-order="desc"><?php _e('Default', CORE_THEME_NAME); ?></li>
                            <li class="sort" data-sort="data-cat" data-order="asc"><?php _e('Ascending', CORE_THEME_NAME); ?></li>
                            <li class="sort" data-sort="data-cat" data-order="desc"><?php _e('Descending', CORE_THEME_NAME); ?></li>
                        </ul>
                    </div> <!-- /.widget-inner -->
                </div> <!-- /.widget-main -->

            </div> <!-- /.col-md-3 -->

            <div class="col-md-9">
                <div class="row">
                	
                	
                    
                    <div id="Grid" class="clearfix">
                    	<?php
	                	global $wp_query;
						$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	                 	$wp_query = new WP_Query(array( 'post_type' => 'gallery', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged ));

						if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
						
						<?php 				
						   $terms = get_the_terms($post->id,"gallery-category");
						   $gallery_cats = NULL;
						   $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );  
						   
						   if ( !empty($terms) ){
						     	foreach ( $terms as $term ) {
						     		$gallery_cats .= strtolower($term->slug) . ' ';
									$gallery_id = $term->term_id;
									
				    		 	}
			   				}
						?>
	                    <div class="col-md-4 mix <?php echo $gallery_cats; ?>" data-cat="<?php echo $gallery_id; ?>">
	                        <div class="gallery-item">
	                        	<a class="fancybox" rel="gallery1" href="<?php echo $featured_image[0]; ?>">
		                        	<?php if(has_post_thumbnail()){ ?>
		                            <div class="gallery-thumb">
		                                
		                                    <?php the_post_thumbnail('gallery-thumb'); ?>
		                                
		                            </div>
		                            <?php }?>
		                            <div class="gallery-content">
		                                <h4 class="gallery-title"><?php the_title(); ?></h4>
		                                <?php the_excerpt(); ?>
		                            </div>
	                            </a>
	                        </div> <!-- /.gallery-item -->
	                    </div> <!-- /.col-md-4 -->
		                <?php endwhile; ?>
	                    <?php endif; ?>
	                    <?php wp_reset_postdata();?>
                    </div> <!-- /#Grid -->
                </div> <!-- /.row -->
	                
		       <?php core_paging_nav(); ?>
                
            </div> <!-- /.col-md-9 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
<?php get_footer(); ?>