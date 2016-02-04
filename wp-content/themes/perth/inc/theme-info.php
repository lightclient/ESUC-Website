<?php
/**
 * Theme info page
 *
 * @package Perth
 */

//Add the theme page
add_action('admin_menu', 'perth_add_theme_info');
function perth_add_theme_info(){
	$theme_info = add_theme_page( __('Perth Info','perth'), __('Perth Info','perth'), 'manage_options', 'perth-info.php', 'perth_info_page' );
    add_action( 'load-' . $theme_info, 'perth_info_hook_styles' );
}

//Callback
function perth_info_page() {
?>
	<div class="info-container">
		<h2 class="info-title"><?php _e('Perth Info','perth'); ?></h2>
		<div class="info-block"><div class="dashicons dashicons-desktop info-icon"></div><p class="info-text"><a href="http://demo.athemes.com/themes/?theme=Perth" target="_blank"><?php _e('Theme demo','perth'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-book-alt info-icon"></div><p class="info-text"><a href="http://athemes.com/documentation/perth" target="_blank"><?php _e('Documentation','perth'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-sos info-icon"></div><p class="info-text"><a href="http://athemes.com/forums" target="_blank"><?php _e('Support','perth'); ?></a></p></div>
		<div class="info-block"><div class="dashicons dashicons-smiley info-icon"></div><p class="info-text"><a href="http://athemes.com/theme/perth-pro" target="_blank"><?php _e('Pro version','perth'); ?></a></p></div>	
	</div>
<?php
}

//Styles
function perth_info_hook_styles(){
   	add_action( 'admin_enqueue_scripts', 'perth_info_page_styles' );
}
function perth_info_page_styles() {
	wp_enqueue_style( 'perth-info-style', get_template_directory_uri() . '/css/info-page.css', array(), true );
}