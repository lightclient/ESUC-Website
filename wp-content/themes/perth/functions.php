<?php
/**
 * Perth functions and definitions
 *
 * @package Perth
 */


if ( ! function_exists( 'perth_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function perth_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Perth, use a find and replace
	 * to change 'perth' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'perth', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Content width
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1170;
	}

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('perth-medium-thumb', 700);
	add_image_size('perth-medium-thumb', 410);
	add_image_size('perth-small-thumb', 100);
	add_image_size('perth-client-thumb', 275);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'perth' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'perth_custom_background_args', array(
		'default-color' => 'e8ecf0',
		'default-image' => '',
	) ) );
}
endif; // perth_setup
add_action( 'after_setup_theme', 'perth_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function perth_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'perth' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	//Footer widget areas
	$widget_areas = get_theme_mod('footer_widget_areas', '2');
	for ($i=1; $i<=$widget_areas; $i++) {
		register_sidebar( array(
			'name'          => __( 'Footer ', 'perth' ) . $i,
			'id'            => 'footer-' . $i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}	

	//Register the front page widgets
	if ( function_exists('siteorigin_panels_activate') ) {
		register_widget( 'Perth_Services_Type_A' );
		register_widget( 'Perth_Services_Type_B' );
		register_widget( 'Perth_Facts' );
		register_widget( 'Perth_Clients' );
		register_widget( 'Perth_Testimonials' );
		register_widget( 'Perth_Skills' );
		register_widget( 'Perth_Action' );
		register_widget( 'Perth_Video_Widget' );
		register_widget( 'Perth_Social_Profile' );
		register_widget( 'Perth_Employees' );
		register_widget( 'Perth_Separator_Type_A' );
		register_widget( 'Perth_Separator_Type_B' );
		register_widget( 'Perth_Latest_News' );
	}
	register_widget( 'Perth_Contact_Info' );	
}
add_action( 'widgets_init', 'perth_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( function_exists('siteorigin_panels_activate') ) {
	require get_template_directory() . "/widgets/fp-services-type-a.php";
	require get_template_directory() . "/widgets/fp-services-type-b.php";
	require get_template_directory() . "/widgets/fp-facts.php";
	require get_template_directory() . "/widgets/fp-clients.php";
	require get_template_directory() . "/widgets/fp-testimonials.php";
	require get_template_directory() . "/widgets/fp-skills.php";
	require get_template_directory() . "/widgets/fp-call-to-action.php";
	require get_template_directory() . "/widgets/video-widget.php";
	require get_template_directory() . "/widgets/fp-social.php";
	require get_template_directory() . "/widgets/fp-employees.php";
	require get_template_directory() . "/widgets/fp-latest-news.php";
	require get_template_directory() . "/widgets/fp-sep-type-a.php";
	require get_template_directory() . "/widgets/fp-sep-type-b.php";
}
require get_template_directory() . "/widgets/contact-info.php";


/**
 * Enqueue scripts and styles.
 */
function perth_scripts() {

	if ( get_theme_mod('body_font_name') !='' ) {
	    wp_enqueue_style( 'perth-body-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('body_font_name')) ); 
	} else {
	    wp_enqueue_style( 'perth-body-fonts', '//fonts.googleapis.com/css?family=Roboto:500,300,500italic,300italic');
	}

	if ( get_theme_mod('headings_font_name') !='' ) {
	    wp_enqueue_style( 'perth-headings-fonts', '//fonts.googleapis.com/css?family=' . esc_attr(get_theme_mod('headings_font_name')) ); 
	} else {
	    wp_enqueue_style( 'perth-headings-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,800'); 
	}

	wp_enqueue_style( 'perth-style', get_stylesheet_uri() );

	wp_enqueue_style( 'perth-font-awesome', get_template_directory_uri() . '/fonts/font-awesome.min.css' );	

	wp_enqueue_script( 'perth-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'),'', true );		

	wp_enqueue_script( 'perth-main', get_template_directory_uri() . '/js/main.min.js', array('jquery'),'', true );		

	if ( get_theme_mod('blog_layout') == 'masonry-layout' && (is_home() || is_archive()) ) {
		wp_enqueue_script( 'perth-masonry-init', get_template_directory_uri() . '/js/masonry-init.js', array('jquery-masonry'),'', true );		
	}	

	wp_enqueue_script( 'perth-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'perth_scripts' );

/**
 * Enqueue Bootstrap
 */
function perth_enqueue_bootstrap() {
	wp_enqueue_style( 'perth-bootstrap', get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), true );
}
add_action( 'wp_enqueue_scripts', 'perth_enqueue_bootstrap', 9 );

/**
 * Header text
 */
function perth_header_text() {

	if ( !function_exists('pll_register_string') ) {
		$header_text 		= get_theme_mod('header_text', 'Welcome to Perth');
		$button_left		= get_theme_mod('button_left', 'Start here');
		$button_right 		= get_theme_mod('button_right', 'Read more');
	} else {
		$header_text 		= pll__(get_theme_mod('header_text', 'Welcome to Perth'));
		$button_left		= pll__(get_theme_mod('button_left', 'Start here'));
		$button_right 		= pll__(get_theme_mod('button_right', 'Read more'));	
	}
	$button_left_url	= get_theme_mod('button_left_url', '#primary');
	$button_right_url 	= get_theme_mod('button_right_url', '#primary');

	echo '<div class="header-info">
			<h3 class="header-text">' . esc_html($header_text) . '</h3>
			<div class="header-buttons">';
			if ($button_left_url) {
				echo '<a class="button header-button left-button" href="' . esc_url($button_left_url) . '">' . esc_html($button_left) . '</a>';
			}
			if ($button_right_url) {
				echo '<a class="button header-button right-button" href="' . esc_url($button_right_url) . '">' . esc_html($button_right) . '</a>';
			}
	echo 	'</div>';
	echo '</div>';
}

/**
 * Site branding
 */
if ( ! function_exists( 'perth_branding' ) ) :
function perth_branding() {
	if ( get_theme_mod('site_logo') ) :
		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr(get_bloginfo('name')) . '"><img class="site-logo" src="' . esc_url(get_theme_mod('site_logo')) . '" alt="' . esc_attr(get_bloginfo('name')) . '" /></a>'; 
	else :
		echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1>';
		if ( get_bloginfo( 'description' ) ) {
			echo '<h2 class="site-description">' . esc_html(get_bloginfo( 'description' )) . '</h2>';
		}
	endif;
}
endif;

/**
 * Change the excerpt length
 */
function perth_excerpt_length( $length ) {
  
  $excerpt = intval(get_theme_mod('exc_lenght', '55'));
  return $excerpt;

}
add_filter( 'excerpt_length', 'perth_excerpt_length', 999 );

/**
 * Blog layout
 */
function perth_blog_layout() {
	$layout = get_theme_mod('blog_layout','classic');
	return $layout;
}

/**
 * Polylang compatibility
 */
if ( function_exists('pll_register_string') ) :
function perth_polylang() {
	pll_register_string('Header text', esc_attr(get_theme_mod('header_text')), 'Perth');
	pll_register_string('Left button text', esc_attr(get_theme_mod('button_left')), 'Perth');
	pll_register_string('Right button text', esc_attr(get_theme_mod('button_right')), 'Perth');
}
add_action( 'admin_init', 'perth_polylang' );
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Page builder integration
 */
require get_template_directory() . '/inc/builder.php';

/**
 * SVGs
 */
require get_template_directory() . '/inc/svg.php';

/**
 * Styles
 */
require get_template_directory() . '/inc/styles.php';

/**
 * Theme info
 */
require get_template_directory() . '/inc/theme-info.php';


/**
 *TGM Plugin activation.
 */
require get_template_directory() . '/plugins/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'perth_recommend_plugin' );
function perth_recommend_plugin() {
 
    $plugins = array(
        array(
            'name'               => 'Page Builder by SiteOrigin',
            'slug'               => 'siteorigin-panels',
            'required'           => false,
        ),
        array(
            'name'               => 'Types - Custom Fields and Custom Post Types Management',
            'slug'               => 'types',
            'required'           => false,
        ),          
    );
 
    tgmpa( $plugins);
 
}