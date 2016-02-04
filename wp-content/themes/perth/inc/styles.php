<?php
/**
 * @package Perth
 */

//Converts hex colors to rgba for the menu background color
function perth_hex2rgba($color, $opacity = false) {

        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        $rgb =  array_map('hexdec', $hex);
        $opacity = 0.6;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';

        return $output;
}

//Dynamic styles
function perth_custom_styles($custom) {

	$custom = '';

	//Menu style
	$sticky_menu = get_theme_mod('sticky_menu','sticky');
	if ($sticky_menu == 'static') {
		$custom .= ".site-header { position: relative;}"."\n";
		$custom .= ".header-clone { display:none;}"."\n";
	}
	$menu_style = get_theme_mod('menu_style','inline');
	if ($menu_style == 'centered') {
		$custom .= ".site-header .container { display: block;}"."\n";
		$custom .= ".site-branding { width: 100%; text-align: center;margin-bottom:15px;}"."\n";
		$custom .= ".main-navigation { width: 100%;float: none;}"."\n";
		$custom .= ".main-navigation ul { float: none;text-align:center;}"."\n";
		$custom .= ".main-navigation li { float: none; display: inline-block;}"."\n";
		$custom .= ".main-navigation ul ul li { display: block; text-align: left;}"."\n";
	}

    //Body size
    $header_height = get_theme_mod( 'header_height', '600' );
    if ($header_height) {
        $custom .= "@media only screen and (min-width: 992px) {.header-image { height:" . intval($header_height) . "px; }}"."\n";
    }

	//__COLORS
	//Primary color
	$primary_color = get_theme_mod( 'primary_color', '#315b9d' );
	if ( $primary_color != '#315b9d' ) {
		$custom .= ".fact,.header-button.left-button:hover,.perth_contact_info_widget span,.entry-title a:hover,.post-title a:hover,.widget-area .widget a:hover,.main-navigation a:hover,a,a:hover,button,.button,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { color:" . esc_attr($primary_color) . ";}"."\n";
		$custom .= ".header-button.left-button,.site-footer,.go-top,.project-filter li,.owl-theme .owl-controls .owl-page span,.social-menu-widget li,.skill-progress,.tagcloud a:hover,.comment-navigation .nav-next,.posts-navigation .nav-next,.post-navigation .nav-next,.comment-navigation .nav-previous,.posts-navigation .nav-previous,.post-navigation .nav-previous,button:hover,.button:hover,input[type=\"button\"]:hover,input[type=\"reset\"]:hover,input[type=\"submit\"]:hover { background-color:" . esc_attr($primary_color) . ";}"."\n";
		$custom .= "@media only screen and (min-width: 1025px) {.main-navigation li::after { background-color:" . esc_attr($primary_color) . ";}}"."\n";
		$custom .= "@-webkit-keyframes preload {from {background-color: #333;} to {background-color:" . esc_attr($primary_color) . ";}}"."\n";
		$custom .= "@keyframes preload {from {background-color: #333;} to {background-color: " . esc_attr($primary_color) . ";} }"."\n";
		$custom .= ".fact,.header-button.left-button,.footer-column .widget-title,.widget-area .widget-title,.button,input[type=\"button\"],input[type=\"reset\"],input[type=\"submit\"] { border-color:" . esc_attr($primary_color) . ";}"."\n";
		$custom .= ".svg-container.service-icon-svg,.employee-svg { fill:" . esc_attr($primary_color) . ";}"."\n";	
		$rgba 	= perth_hex2rgba($primary_color, 0.6);
		$custom .= ".project-title{ background-color:" . esc_attr($rgba) . ";}"."\n";		
	}
	//Menu background
	$menu_bg_color = get_theme_mod( 'menu_bg_color', '#ffffff' );
	$custom .= ".site-header { background-color:" . esc_attr($menu_bg_color) . ";}" . "\n";
	//Site title
	$site_title = get_theme_mod( 'site_title_color', '#2B3C4D' );
	$custom .= ".site-title a, .site-title a:hover { color:" . esc_attr($site_title) . "}"."\n";
	//Site desc
	$site_desc = get_theme_mod( 'site_desc_color', '#808D99' );
	$custom .= ".site-description { color:" . esc_attr($site_desc) . "}"."\n";
	//Top level menu items color
	$top_items_color = get_theme_mod( 'top_items_color', '#53565A' );
	$custom .= ".main-navigation a { color:" . esc_attr($top_items_color) . "}"."\n";
	//Sub menu items color
	$submenu_items_color = get_theme_mod( 'submenu_items_color', '#d5d5d5' );
	$custom .= ".main-navigation ul ul a { color:" . esc_attr($submenu_items_color) . "}"."\n";
	//Sub menu background
	$submenu_background = get_theme_mod( 'submenu_background', '#242D37' );
	$custom .= ".main-navigation ul ul li { background-color:" . esc_attr($submenu_background) . "}"."\n";	
	//Header text
	$header_text_color = get_theme_mod( 'header_text_color', '#ffffff' );
	$custom .= ".header-text { color:" . esc_attr($header_text_color) . "}"."\n";
	//Body
	$body_text = get_theme_mod( 'body_text_color', '#798A9B' );
	$custom .= "body { color:" . esc_attr($body_text) . "}"."\n";
	//Footer widget area background
	$footer_widgets_background = get_theme_mod( 'footer_widgets_background', '#242D37' );
	$custom .= ".footer-widgets { background-color:" . esc_attr($footer_widgets_background) . "}"."\n";	
	//Rows overlay
	$rows_overlay = get_theme_mod( 'rows_overlay', '#1c1c1c' );
	$custom .= ".overlay { background-color:" . esc_attr($rows_overlay) . "}"."\n";		
	//Header overlay
	$rows_overlay = get_theme_mod( 'header_overlay', '#315B9D' );
	$disable_hoverlay = get_theme_mod( 'header_overlay_disable');
	$custom .= ".header-overlay { background-color:" . esc_attr($rows_overlay) . "}"."\n";	
	if ($disable_hoverlay) {
		$custom .= ".header-overlay {display:none;}"."\n";			
	}

	//__Fonts
	$body_fonts = get_theme_mod('body_font_family');	
	$headings_fonts = get_theme_mod('headings_font_family');
	if ( $body_fonts !='' ) {
		$custom .= "body { font-family:" . wp_kses_post($body_fonts) . ";}"."\n";
	}
	if ( $headings_fonts !='' ) {
		$custom .= "h1, h2, h3, h4, h5, h6 { font-family:" . wp_kses_post($headings_fonts) . ";}"."\n";
	}
    //Site title
    $site_title_size = get_theme_mod( 'site_title_size', '36' );
    if ($site_title_size) {
        $custom .= ".site-title { font-size:" . intval($site_title_size) . "px; }"."\n";
    }
    //Site description
    $site_desc_size = get_theme_mod( 'site_desc_size', '14' );
    if ($site_desc_size) {
        $custom .= ".site-description { font-size:" . intval($site_desc_size) . "px; }"."\n";
    }
    //Menu
    $menu_size = get_theme_mod( 'menu_size', '13' );
    if ($menu_size) {
        $custom .= ".main-navigation li { font-size:" . intval($menu_size) . "px; }"."\n";
    }    	    	
	//H1 size
	$h1_size = get_theme_mod( 'h1_size','36' );
	if ($h1_size) {
		$custom .= "h1 { font-size:" . intval($h1_size) . "px; }"."\n";
	}
    //H2 size
    $h2_size = get_theme_mod( 'h2_size','30' );
    if ($h2_size) {
        $custom .= "h2 { font-size:" . intval($h2_size) . "px; }"."\n";
    }
    //H3 size
    $h3_size = get_theme_mod( 'h3_size','24' );
    if ($h3_size) {
        $custom .= "h3 { font-size:" . intval($h3_size) . "px; }"."\n";
    }
    //H4 size
    $h4_size = get_theme_mod( 'h4_size','18' );
    if ($h4_size) {
        $custom .= "h4 { font-size:" . intval($h4_size) . "px; }"."\n";
    }
    //H5 size
    $h5_size = get_theme_mod( 'h5_size','14' );
    if ($h5_size) {
        $custom .= "h5 { font-size:" . intval($h5_size) . "px; }"."\n";
    }
    //H6 size
    $h6_size = get_theme_mod( 'h6_size','12' );
    if ($h6_size) {
        $custom .= "h6 { font-size:" . intval($h6_size) . "px; }"."\n";
    }
    //Body size
    $body_size = get_theme_mod( 'body_size', '14' );
    if ($body_size) {
        $custom .= "body { font-size:" . intval($body_size) . "px; }"."\n";
    }   
    $widget_titles = get_theme_mod( 'pb_titles', '36' );
    if ($widget_titles) {
        $custom .= ".panel-grid .widget-title { font-size:" . intval($widget_titles) . "px; }"."\n";
    } 

	//Output all the styles
	wp_add_inline_style( 'perth-style', $custom );	
}
add_action( 'wp_enqueue_scripts', 'perth_custom_styles' );