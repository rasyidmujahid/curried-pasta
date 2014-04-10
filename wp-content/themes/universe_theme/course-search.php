<div class="row">
	<div class="col-md-12">
		<div class="widget-main">
			<div class="widget-inner">
				<div class="course-search">
					<h3><?php _e('Find a course', CORE_THEME_NAME ); ?></h3>	
					<?php
						$args = course_search_args();
						$course_search_object = new WP_Advanced_Search($args);
						$course_search_object->the_form();
					?>
				</div>
			</div>
			<!-- /.widget-inner -->
		</div>
		<!-- /.widget-main -->
	</div>
	<!-- /.col-md-12 -->
</div>
<!-- /.row -->
