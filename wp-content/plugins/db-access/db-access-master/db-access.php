<?php
/*
Plugin Name: db-access
Plugin URI: http://jimsward.com/db-access
Description: A tool for viewing, sorting, searching, exporting,
printing, and manipulating the contents of HTML tables derived  
from tables found in your WordPress database.
Version: 0.8.7
Author: Jim Sward
Author URI: http://JimSward.com
License: GPLv2
*/


/*  Copyright 2014  Jim Sward  (email : Jim@JimSward.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

//Initialize options to default values. Once set, add_option() ignores these values
add_option( 'db_access_export_file', 'myTable.csv' );
add_option( 'db_access_pagination', 'on' );
add_option( 'db_access_filters', 'on' );
add_option( 'db_access_print', 'on' );
add_option( 'db_access_columns', 'on' );
add_option( 'db_access_output', 'on' );
add_option( 'db_access_crosshairs', 'on' );
add_option( 'db_access_editable', '' );

 include("settings-page.php"); // creates admin page for db-access and a settings page both on the dashboard
 
 add_filter('plugin_row_meta', 	'db_access_set_plugin_meta', 2, 10);
 function db_access_set_plugin_meta( $links, $file ) { // Add a link to this plugin's settings page
	static $this_plugin;
	if(!$this_plugin) $this_plugin = plugin_basename(__FILE__);
	if($file == $this_plugin) {
		$settings_link = '<a href="options-general.php?page=db-access">'.__('Settings', 'db_access').'</a>';	
		array_unshift($links, $settings_link);
	}
	return $links; 
}

function db_access_menu_page_display() {
    // Create a header in the default WordPress 'wrap' container
    $html = '<div class="wrap">';
    $html .= '<h2>db-access</h2>';
    $html .= '</div>';
	echo $html;
		
	
	$plugindir = plugins_url() . '/' . dirname( plugin_basename( __FILE__ ) );
	$tablescript = $plugindir . "/includes/tablesorter/js/jquery.tablesorter.js";
    wp_enqueue_script( "ts", $tablescript  );
	$tablewdg = $plugindir . "/includes/tablesorter/js/jquery.tablesorter.widgets.js";
    wp_enqueue_script( "wg", $tablewdg  );
	
	$tablecs = $plugindir . "/includes/tablesorter/js/widgets/widget-columnSelector.js"; //columnSelector
    wp_enqueue_script( "cs", $tablecs  );
	
	$tablepr = $plugindir . "/includes/tablesorter/js/widgets/widget-print.js"; //print widget
    wp_enqueue_script( "pr", $tablepr  );
	
	$tableop = $plugindir . "/includes/tablesorter/js/widgets/widget-output.js"; //output widget
    wp_enqueue_script( "op", $tableop  );
	
	$tableedit = $plugindir . "/includes/tablesorter/js/widgets/widget-editable.js"; //editable widget
    wp_enqueue_script( "ed", $tableedit  );
	
	$tablepager = $plugindir . "/includes/tablesorter/addons/pager/jquery.tablesorter.pager.js";
	wp_enqueue_script( "tp", $tablepager  );
	wp_enqueue_script( "jquery-ui-dialog"  );
	
	$tablestl = $plugindir . "/includes/tablesorter/css/theme.default.css";	
	wp_enqueue_style( 'ts', $tablestl );	

	$crosshr = $plugindir . "/js/jquery.crosshairs.js";
	wp_enqueue_script( "ch", $crosshr );
	
	
	$styles = $plugindir .  "/css/style.css";		
	wp_enqueue_style( 'db', $styles );
	$js = $plugindir . "/js/gettables.js";
	wp_enqueue_script( "db_access", $js  );	
	
	
	
	
	
	//make a js object - dbaSettings - available to the script gettables.js
	wp_localize_script( 'db_access', 'dbaSettings', array ( 'plugindir' => $plugindir,
	'export_file'	=> get_option('db_access_export_file'),
	'pagination'	=> get_option('db_access_pagination'),
	'filter'	=> get_option('db_access_filters'),
	'print'	=> get_option('db_access_print'),
	'columnSelector'	=> get_option('db_access_columns'),
	'crosshairs'	=> get_option('db_access_crosshairs'),	
	'output' => get_option('db_access_output'),
	'editable' => get_option('db_access_editable')		
	 
	 ) );
	 				 
 } // end menu_page_display	
	

function dbaccess_create_menu() {	
	//create a submenu under Settings
	add_menu_page( 'dbaccess', 'dbaccess', 'manage_options', __FILE__, 'db_access_menu_page_display' );
}
	add_action( 'admin_menu', 'dbaccess_create_menu' );
	
	
	//AJAX handlers
	add_action( 'wp_ajax_tables_action', 'tables_action_callback' );
function tables_action_callback() {
	global $wpdb;
	$sql = "SHOW TABLES";
//respond with a list of tables to populate the dropdown list
$results = $wpdb->get_results($sql );
$send = json_encode($results);
echo $send;
	die();
}

	add_action( 'wp_ajax_showtables_action', 'showtables_action_callback' );
function showtables_action_callback() {
	global $wpdb;
	
$tablename = $_GET['tablename'];

$results = $wpdb->get_results( 
	"
	SELECT * 
	FROM $tablename
	WHERE 1
	"
);
$send = json_encode($results);
echo $send;
	die();
}

add_action( 'wp_ajax_update_cell_action', 'update_cell_action_callback' );
function update_cell_action_callback() {
global $wpdb;
	
$table = sanitize_text_field( $_POST['table'] );
$keyname = sanitize_text_field( $_POST['keyname'] );
$key = sanitize_text_field( $_POST['key'] );
$col = sanitize_text_field( $_POST['col'] );
$text = sanitize_text_field( $_POST['text'] );

	//we don't want any escaping inserted with the text
	$wpdb->query(
	"
	UPDATE $table
    SET $col = '$text' 
    WHERE $keyname = $key
	"
	);	

	die();
}	
	
?>