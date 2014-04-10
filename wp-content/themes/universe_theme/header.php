<?php
/**
 * @package WordPress
 * @subpackage Core Framework
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> 
<![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> 
<![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes();?>> <!--<![endif]-->
<head>
    <title><?php bloginfo('name'); ?> <?php wp_title("|",true); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>">
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11" />

	<!-- Favicons -->
   	<?php if (of_get_option('touch_icon_large') != "") { ?><link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo of_get_option('touch_icon_large'); ?>"><?php } ?>
    <?php if (of_get_option('touch_icon_medium') != "") { ?><link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo of_get_option('touch_icon_small'); ?>"><?php } ?>
    <?php if (of_get_option('touch_icon_small') != "") { ?><link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo of_get_option('touch_icon_small'); ?>"><?php } ?>
    <?php if (of_get_option('favicon') != "") { ?><link rel="shortcut icon" href="<?php echo of_get_option('favicon'); ?>"> <?php } ?>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

    <!-- This one in here is responsive menu for tablet and mobiles -->
    <div class="responsive-navigation visible-sm visible-xs">
        <a href="#" class="menu-toggle-btn">
            <i class="fa fa-bars"></i>
        </a>
        <div class="responsive_menu">
            <?php wp_nav_menu( array( 'theme_location' => 'header_menu_secondary', 'menu_class' => 'main_menu' ) ); ?>
            <?php
						$show_social_icons = of_get_option('social_icons_id');
						if($show_social_icons == "yes") { ?>
                        <ul class="social_icons pull">
                        	<?php 
	                        	$icon_facebook = of_get_option('icon_facebook');
								if($icon_facebook) { ?>
			                    <li><a href="<?php echo $icon_facebook; ?>" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <?php } ?>
                            <?php 
	                        	$icon_twitter = of_get_option('icon_twitter');
								if($icon_twitter) { ?>
			                    <li><a href="<?php echo $icon_twitter; ?>" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <?php } ?>
                            <?php 
	                        	$icon_pinterest = of_get_option('icon_pinterest');
								if($icon_pinterest) { ?>
			                    <li><a href="<?php echo $icon_pinterest; ?>" data-toggle="tooltip" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <?php } ?>
                             <?php 
	                        	$icon_googleplus = of_get_option('icon_googleplus');
								if($icon_googleplus) { ?>
			                    <li><a href="<?php echo $icon_googleplus; ?>" data-toggle="tooltip" title="Google+"><i class="fa fa-google-plus"></i></a></li>
                            <?php } ?>
                            
                            <?php
                            	$show_rss = of_get_option('show_rss');
								if($show_rss) { ?>
								<li><a href="<?php bloginfo('rss2_url'); ?>" data-toggle="tooltip" title="RSS"><i class="fa fa-rss"></i></a></li>
							<?php } ?>
								
                        </ul> <!-- /.social-icons -->
              <?php }?>
        </div> <!-- /.responsive_menu -->
    </div> <!-- /responsive_navigation -->
    
    <header class="site-header">
        <div class="container">
            <div class="row">
                <div class="col-md-4 header-left">
                	<?php
            			$show_header_info = of_get_option('header_info_id');
						if($show_header_info == "yes") { ?>
		                    <p><i class="fa fa-phone"></i><?php echo of_get_option('phone_info'); ?></p>
		                    <p><i class="fa fa-envelope"></i> <a href="mailto:<?php echo of_get_option('mail_info'); ?>"><?php echo of_get_option('mail_info'); ?></a></p>
                    <?php } ?>
                </div> <!-- /.header-left -->
                <div class="col-md-4">
                    <div class="logo">
                        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>" rel="home">
                        	<?php $logo_url = of_get_option('logo_url');
							if( $logo_url) { ?>
								<img  src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>">
								<?php }
							else { ?>
                            	<img src="<?php echo get_template_directory_uri(). '/core/images/logo.png'; ?>" alt="<?php bloginfo('name'); ?>">
                            <?php } ?>
                        </a>
                    </div> <!-- /.logo -->
                </div> <!-- /.col-md-4 -->

                <div class="col-md-4 header-right">
                	
                	<?php 
                		// Show Primary Menu?
	                	$show_primary_menu = of_get_option('primary_menu_id');
						if($show_primary_menu =="yes") {
	                    	wp_nav_menu( array( 'theme_location' => 'header_menu_primary', 'menu_class' => 'small-links' ) );
					} ?>
					
                    <?php
                    	// Show Searchform? 
	                    $show_searchform = of_get_option('search_box_id');
						if($show_searchform =="yes") {
							get_search_form();
					} ?>
                </div> <!-- /.header-right -->
            </div>
        </div> <!-- /.container -->

        <div class="nav-bar-main" role="navigation">
            <div class="container">
                <nav class="main-navigation clearfix visible-md visible-lg" role="navigation">
                        <?php wp_nav_menu( array(
								'container'       => 'ul', 
								'menu_class'      => 'main-menu sf-menu', 
								'menu_id'         => '',
								'depth'           => 0,
								'theme_location'  => 'header_menu_secondary'
								)); 
						?>
						<?php
						$show_social_icons = of_get_option('social_icons_id');
						if($show_social_icons == "yes") { ?>
                        <ul class="social-icons pull-right">
                        	<?php 
	                        	$icon_facebook = of_get_option('icon_facebook');
								if($icon_facebook) { ?>
			                    <li><a href="<?php echo $icon_facebook; ?>" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                            <?php } ?>
                            <?php 
	                        	$icon_twitter = of_get_option('icon_twitter');
								if($icon_twitter) { ?>
			                    <li><a href="<?php echo $icon_twitter; ?>" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                            <?php } ?>
                            <?php 
	                        	$icon_pinterest = of_get_option('icon_pinterest');
								if($icon_pinterest) { ?>
			                    <li><a href="<?php echo $icon_pinterest; ?>" data-toggle="tooltip" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
                            <?php } ?>
                             <?php 
	                        	$icon_googleplus = of_get_option('icon_googleplus');
								if($icon_googleplus) { ?>
			                    <li><a href="<?php echo $icon_googleplus; ?>" data-toggle="tooltip" title="Google+"><i class="fa fa-google-plus"></i></a></li>
                            <?php } ?>
                            
                            <?php
                            	$show_rss = of_get_option('show_rss');
								if($show_rss) { ?>
								<li><a href="<?php bloginfo('rss2_url'); ?>" data-toggle="tooltip" title="RSS"><i class="fa fa-rss"></i></a></li>
							<?php } ?>
								
                        </ul> <!-- /.social-icons -->
                        <?php }?>
                </nav> <!-- /.main-navigation -->
            </div> <!-- /.container -->
        </div> <!-- /.nav-bar-main -->

    </header> <!-- /.site-header -->
    
    <?php if(!is_front_page()) { ?>
    <!-- Page Title -->
    <div class="container">
        <div class="page-title clearfix">
            <div class="row">
                <?php breadcrumbs(); ?>
            </div>
        </div>
    </div>
    <?php } ?>
