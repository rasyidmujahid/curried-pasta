<?php 
global $wp_query;

$found_posts = $wp_query->found_posts;
$per_page = get_option('posts_per_page');
$post_count = $found_posts - $per_page;

if($found_posts > $per_page) :
?>
<div class="row" id="load-more" data-order='999'>
	<div class="col-md-12">
		<div class="load-more-btn">
			<a id="load-more-btn" href="#">		
				<span id="detail-holder">
					<div id="loader" data-perpage="<?php echo $per_page; ?>"></div>
					<div class="load-more-text"><?php _e('Click here to load more', CORE_THEME_NAME);  ?></div>
				</span>
			</a>
		</div>
	</div> <!-- /.col-md-12 -->
</div> <!-- /.row -->
<?php endif; ?>
