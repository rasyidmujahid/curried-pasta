<div class="main-slideshow">
	<div class="flexslider">
		<ul class="slides">
			<?php
			query_posts("post_type=home_slider&posts_per_page=-1&post_status=publish&orderby=name&order=ASC");
	        while ( have_posts() ) : the_post();
			
			$custom = get_post_custom($post->ID);
	        $caption = get_post_custom_values("core_slider_caption");
	        $image = get_the_post_thumbnail($post->ID, 'slider-image');
	        
    
        	if(has_post_thumbnail( $post->ID)){
			?>
			<li>
				<?php print $image; ?>
				<?php if($caption[0]) {
				?>
				<div class="slider-caption">
					<?php echo stripslashes(htmlspecialchars_decode($caption[0])); ?>
				</div>
				<?php } ?>
			</li>
			<?php }
				endwhile;
				wp_reset_query();
			?>
		</ul>
		<!-- /.slides -->
	</div><!-- /.flexslider -->
</div><!-- /.main-slideshow -->