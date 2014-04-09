<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

	// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	
?>

<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>
	<div class="row">
		<div class="col-md-12">
			<div id="comments" class="blog-post-comments">
				<div class="widget-main-title">
		             <h4 class="widget-title"><?php comments_number('No Comments', 'One Comment', '% Comments' );?></h4>
		        </div>
	       </div>
	        <div class="blog-comments-content">
	        	<ul class="comment-list">
				<?php wp_list_comments(array('avatar_size' => 60)); ?>
				</ul>
	        </div>
  		</div> <!-- /. col-md-12 -->
	</div> <!-- /. row -->
	
	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>


 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<!--<p class="nocomments">Comments are closed.</p>-->

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>
	<div class="row">
		<div class="col-md-12">
			
			<?php
			
			$commenter = wp_get_current_commenter();
			$req = get_option('require_name_email');
			$aria_req = ($req ? "aria-required='true'" : '');
			
			$comments_args = array(
			'title_reply' => '<div class="widget-main-title"><h4 class="widget-title">'.__('Leave a Comment', CORE_THEME_NAME).
			'</h4></div>',
			'label_submit' =>  __('Submit Comment', CORE_THEME_NAME ),
			'comment_notes_after' => '<div class="row"><div class="col-md-12">'.
				'<input class="mainBtn" type="submit" name="" value="'.__('Submit Comment', CORE_THEME_NAME ).'" /></div></div>',
			'comment_notes_before' => '',
			
			'comment_field' => '<div class="row"><div class="col-md-12"><p>'.
			'<label for="comment">'.__('Your Comment:', CORE_THEME_NAME).'</label>'.
			'<textarea id="comment" name="comment" rows="4" aria-required="true">'.'</textarea></p></div></div>',
			
			'fields'=> apply_filters('comment_form_default_fields', array(
				
				'author' => 
				'<div class="row"><div class="col-md-4"><p>'.
				'<label for="author">'.__('Your Name:', CORE_THEME_NAME).'</label>'.
				($req ? '<span class="required">*</span>' : '').
				'<input id="author" name="author" type="text" value="'.esc_attr($commenter['comment_author']).
				'" size="22"'.$aria_req. '/></p></div>',
				
				'email' => 
				'<div class="col-md-4"><p>'.
				'<label for="email">'.__('Email Address:', CORE_THEME_NAME).'</label>'.
				($req ? '<span class="required">*</span>' : '').
				'<input id="email" name="email" type="text" value="'.esc_attr($commenter['comment_author_email']).
				'" size="22"'.$aria_req. '/></p></div>',
				
				'url' => 
				'<div class="col-md-4"><p>'.
				'<label for="url">'.__('Your Website:', CORE_THEME_NAME).'</label>'.
				
				'<input id="url" name="url" type="text" value="'.esc_attr($commenter['comment_author_url']).
				'" size="22" /></p></div></div>',

			)));
				
			comment_form($comments_args);  ?>
			
			<?php if ( post_password_required() ) { ?>
					<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', CORE_THEME_NAME); ?></p>
			<?php
				return;
			} ?>
			
		</div><!-- /. col-md-12 -->
</div><!-- /. row -->
<?php endif; // if you delete this the sky will fall on your head ?>