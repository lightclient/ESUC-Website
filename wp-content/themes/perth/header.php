<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Perth
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="preloader">
	<div class="preload-inner">
		<div class="box1 preloader-box"></div>
		<div class="box2 preloader-box"></div>
		<div class="box3 preloader-box"></div>
		<div class="box4 preloader-box"></div>
	</div>
</div>	

<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'perth' ); ?></a>

	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="container">
			<?php if ( display_header_text() ) : ?>
			<div class="site-branding col-md-4 col-sm-6 col-xs-12">
				<?php perth_branding(); ?>
			</div>
			<?php endif; ?>
			<nav id="site-navigation" class="main-navigation col-md-8" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav><!-- #site-navigation -->
			<nav class="mobile-nav"></nav>
		</div>
	</header><!-- #masthead -->
	<div class="header-clone"></div>

	<?php if ( get_header_image() && ( get_theme_mod('front_header_type' ,'image') == 'image' && is_front_page() || get_theme_mod('site_header_type', 'image') == 'image' && !is_front_page() ) ) : ?>
	<div class="header-image">
		<div class="header-overlay"></div>
		<?php perth_header_text(); ?>
	</div>
	<?php endif; ?>

	<div id="content" class="site-content">
		<div id="content-wrapper" class="container">