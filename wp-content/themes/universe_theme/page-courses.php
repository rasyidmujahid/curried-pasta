<?php
/** template name: Courses 
 * The course template file.
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
            <div  class="col-md-8">
               <?php get_template_part('course-search'); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget-main">
                            <div class="widget-inner">
                            	
                                <dl class="course-list" role="tablist">
                                	<?php
							            global $wp_query;
										$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
					                 	$wp_query = new WP_Query(array( 'post_type' => 'course', 'order' => 'DESC', 'orderby' => 'date', 'paged' => $paged ));
									 	if($wp_query->have_posts()): ?>
									
										<?php while ($wp_query->have_posts()): $wp_query->the_post(); 
										
										// Get the terms associated with course level
										$terms = get_the_terms($post->id,'course-level');
										$course_level = NULL;
										   
										   if ( !empty($terms) ){
										     foreach ( $terms as $term ) {
										       $course_level .= $term->name. ' ';
										     }
										   }
										
										// Get the custom metabox with aditional informations about courses
										$course_status = get_post_meta($post->ID, 'core_course_status', true);
										$course_discount = get_post_meta($post->ID, 'core_course_discount', true);
										 
										$label_class = NULL; 
										if(!empty( $course_status) ){
											if( $course_status == '' ){
												$label_class = '';
												
											}
											
											else if( $course_status == 'New Course'){
												     $label_class = 'label-success';
												
											}
											else if( $course_status =='Not Avaliable'){
												     $label_class = 'label-danger';
												
											}
										}
										
										if(!empty( $course_discount)){
											if( $course_discount == ''){
												$label_class = '';
											}
											else {
												 	$course_discount_text = __('Save', CORE_THEME_NAME) .' '. $course_discount.' '.'%';
													$course_status = '';
													$label_class = 'label-warning';
											}
										}
			
										?>
                                    <dt>
                                        <i class="fa fa-caret-right page-ui-icon"></i>
                                        <span class="level"><?php if($course_level) echo $course_level;?></span>
                                        <a href="<?php the_permalink();?>">
                                        	<?php the_title();?>
                                        	<?php 
                                        		if( !empty($label_class)) { ?> 
		                                        	<span class="label <?php echo $label_class; ?>">
		                                        		
		                                        		<?php if( $course_status){
		                                        				echo $course_status; 
		                                        			
		                                        			} else  {
		                                        				echo $course_discount_text; 
		                                        			}
														?>
		                                        		
		                                        	</span>
		                                    <?php } ?>
                                        </a>
                                    </dt>
                                    <?php endwhile;?>
                                    <?php endif; 
                                   	wp_reset_postdata();?>
                                </dl>
                            </div> <!-- /.widget-inner -->
                        </div> <!-- /.widget-main -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->

			 	<?php core_paging_nav(); ?>
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