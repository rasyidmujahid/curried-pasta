<?php
/**
 * The template for displaying the sidebar
 *
 * @package WordPress
 * @subpackage Core Framework
 */
?>
<?php if ( is_active_sidebar( 'sidebar-widget-area' ) ) : ?>
	<div class="col-md-4 sidebar">
		<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
	</div>
<?php endif; ?>