<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Core Framework
 */
?>

<!-- begin The Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
            	<?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) : ?>
                <div class="col-md-3">
                    <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
                </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
                <div class="col-md-2">
                   <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
                </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
                <div class="col-md-2">
                     <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
                </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
                <div class="col-md-2">
                    <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
                </div>
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'footer-sidebar-5' ) ) : ?>
                <div class="col-md-3">
                     <?php dynamic_sidebar( 'footer-sidebar-5' ); ?>
                </div>
                <?php else: ?>
                <div class="col-md-3">
                    <div class="footer-widget">
                        <ul class="footer-media-icons">
                        	<?php
                        	$icon_facebook = of_get_option('icon_facebook');
							if($icon_facebook) { ?>
                           	 <li><a href="<?php echo $icon_facebook; ?>" class="fa fa-facebook"></a></li>
                            <?php } ?>
                            <?php
                        	$icon_twitter = of_get_option('icon_twitter');
							if($icon_twitter) { ?>
                           	 <li><a href="<?php echo $icon_twitter; ?>" class="fa fa-twitter"></a></li>
                            <?php } ?>
                            <?php
                        	$icon_googleplus = of_get_option('icon_googleplus');
							if($icon_googleplus) { ?>
                           	 <li><a href="<?php echo $icon_googleplus; ?>" class="fa fa-google-plus"></a></li>
                            <?php } ?>
                            <?php
                        	$icon_youtube = of_get_option('icon_youtube');
							if($icon_youtube) { ?>
                           	 <li><a href="<?php echo $icon_youtube; ?>" class="fa fa-youtube"></a></li>
                            <?php } ?>
                            <?php
                        	$icon_linkedin = of_get_option('icon_linkedin');
							if($icon_linkedin) { ?>
                           	 <li><a href="<?php echo $icon_linkedin; ?>" class="fa fa-linkedin"></a></li>
                            <?php } ?>
                            <?php
                        	$icon_instagram = of_get_option('icon_instagram');
							if($icon_instagram) { ?>
                           	 <li><a href="<?php echo $icon_instagram; ?>" class="fa fa-instagram"></a></li>
                            <?php } ?>
                            <?php
                        	$icon_apple = of_get_option('icon_apple');
							if($icon_apple) { ?>
                           	 <li><a href="<?php echo $icon_apple; ?>" class="fa fa-apple"></a></li>
                            <?php } ?>
                            <?php
                            $show_rss = of_get_option('show_rss');
							if($show_rss) { ?>
							<li><a href="<?php bloginfo('rss2_url'); ?>" class="fa fa-rss"></a></li>
							<?php } ?>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>
            </div> <!-- /.row -->

            <div class="bottom-footer">
                <div class="row">
                    <div class="col-md-5">
                        <?php
	                        $copyright_info = of_get_option('footer_text');
							if($copyright_info) {
								echo stripslashes(htmlspecialchars_decode($copyright_info));
							} ?>
                    </div> <!-- /.col-md-5 -->
                    <div class="col-md-7">
                    	<?php
	                    	$show_footer_menu = of_get_option('footer_menu');
							if($show_footer_menu == "yes") {
	                       		wp_nav_menu( array( 'theme_location' => 'footer_menu', 'menu_class' => 'footer-nav' ) ); 
                        }?>
                    </div> <!-- /.col-md-7 -->
                </div> <!-- /.row -->
            </div> <!-- /.bottom-footer -->

        </div> <!-- /.container -->
    </footer> <!-- /.site-footer -->
    
    <?php 
    
		if(of_get_option('ga_code')) {
			echo '<script>';
			echo of_get_option('ga_code'); 
			echo '</script>';
		}
	?>

<?php wp_footer(); ?>
</body>
</html>
