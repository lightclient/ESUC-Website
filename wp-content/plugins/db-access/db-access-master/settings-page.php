<?php
$plugindir = plugins_url() . '/' . dirname( plugin_basename( __FILE__ ) );

// Add a menu for our option page
add_action('admin_menu', 'db_access_myplugin_add_page');
function db_access_myplugin_add_page() {
	add_options_page( 'db-access', 'db-access', 'manage_options', 'db-access', 'db_access_myplugin_option_page' );
}

// Draw the option page
function db_access_myplugin_option_page() {
	?>
    
   <?php wp_enqueue_script('jquery'); ?>
   
   <?php wp_enqueue_script('jquery-ui-tooltip'); ?>
   
    <script>	
    jQuery(function(){
				
		//validate input of export filename
		jQuery(':input#db_access_export_file').on( 'change', function(event){
			var valid,
			validate = /[A-Za-z0-9.-]\.csv/;
			valid = validate.test( jQuery(this).val() )
			if ( !valid )
			{
				event.preventDefault();
				alert ( 'Export File must be a valid file name with a .csv extension!' )
				jQuery(this).val( "" )
				}			
			})
			
			//this is the donate button
			<?php global $plugindir;
			$donateimg = $plugindir . "/images/paypal-donate.png"; ?>
			
			var dntbtn = ''
			dntbtn += '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">'
			dntbtn += '<input type="hidden" name="cmd" value="_xclick">'
			dntbtn += '<input type="hidden" name="business" value="jim@JimSward.com">'			
			dntbtn += '<input type="hidden" name="lc" value="PT">'
			dntbtn += '<input type="hidden" name="item_name" value="Donation">'
			dntbtn += '<input type="hidden" name="button_subtype" value="services">'
			dntbtn +='<input type="hidden" name="no_note" value="0">'
			dntbtn +='<input type="hidden" name="currency_code" value="USD">'			
			dntbtn += '<table>'
			dntbtn += '<tr><td><input type="hidden" name="on0" value="Contribute">Contribute to Author</td></tr><tr><td> </td></tr>'
			dntbtn += '</table>'			
			dntbtn += '<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">'
			dntbtn += '<input type="image" src=<?php echo  $donateimg; ?> border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">'
			dntbtn += '<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">'			
			dntbtn += '</form>'
			
			
			jQuery( '<div/>' ).html( dntbtn ).prependTo( '.settings' )
			.find( 'td' ).css( 'font-size', '18px' )
			jQuery( '#heading' ).css( 'margin-top', '30px' )					
		})		
    </script>
    
    
	<div class="wrap settings">
		<h2 id="heading">db-access</h2>
		<form action="options.php" method="post">
			<?php settings_fields('db_access_myplugin_options'); ?>
			<?php do_settings_sections('db_access_myplugin'); ?>
			<input name="Submit" type="submit" value="Save Changes" />
		</form>
	</div>
    

	<?php
}

// Register and define the settings
add_action('admin_init', 'db_access_myplugin_admin_init');
function db_access_myplugin_admin_init(){
	register_setting(
		'db_access_myplugin_options',
		'db_access_export_file'
	);
	
	register_setting(
		'db_access_myplugin_options',
		'db_access_pagination'
	);
	
	
	
	register_setting(
		'db_access_myplugin_options',
		'db_access_filters'
	);
	
	register_setting(
		'db_access_myplugin_options',
		'db_access_print'
	);
	
	register_setting(
		'db_access_myplugin_options',
		'db_access_columns'
	);
	
	register_setting(
		'db_access_myplugin_options',
		'db_access_crosshairs'
	);
	
	register_setting(
		'db_access_myplugin_options',
		'db_access_editable'
	);
			
	add_settings_section(
		'db_access_myplugin_main',
		'Plugin Settings',
		'db_access_myplugin_section_text',
		'db_access_myplugin'
	);
	
	add_settings_field(
		'db_access_export_file',
		'Export Filename',
		'db_access_myplugin_setting_input',
		'db_access_myplugin',
		'db_access_myplugin_main'
	);
	
	
	
		
	add_settings_field(
		'db_access_pagination',
		'Pagination',
		'db_access_myplugin_setting_input3',
		'db_access_myplugin',
		'db_access_myplugin_main'
		
	);
	
	add_settings_field(
		'db_access_filters',
		'Filters',
		'db_access_myplugin_setting_input4',
		'db_access_myplugin',
		'db_access_myplugin_main'
		
	);
	
	add_settings_field(
		'db_access_print',
		'Print Table',
		'db_access_myplugin_setting_input5',
		'db_access_myplugin',
		'db_access_myplugin_main'
		
	);
	
	add_settings_field(
		'db_access_columns',
		'Column Selector',
		'db_access_myplugin_setting_input6',
		'db_access_myplugin',
		'db_access_myplugin_main'
		
	);
	
	add_settings_field(
		'db_access_crosshairs',
		'Show Crosshairs',
		'db_access_myplugin_setting_input7',
		'db_access_myplugin',
		'db_access_myplugin_main'
		
	);
	
	add_settings_field(
		'db_access_editable',
		'Change Cell Text',
		'db_access_myplugin_setting_input8',
		'db_access_myplugin',
		'db_access_myplugin_main'
		
	);

		
	}


// Draw the section header
function db_access_myplugin_section_text() {
	echo '<p>Decide how you would like to see the data displayed here:</p>';
	
}

// Display and fill the form field
function db_access_myplugin_setting_input() {
	
	?>	
 <input type="text" id="db_access_export_file" name="db_access_export_file" value=" <?php echo get_option( 'db_access_export_file' ); ?>  " size="30" />	
<?php }

function db_access_myplugin_setting_input3() {
	$check = get_option('db_access_pagination') ? 'checked="checked" ' : '';	
	echo "<input type='checkbox' id='db_access_pagination'  name='db_access_pagination'  $check />";
	}
	
	function db_access_myplugin_setting_input4() {
	$check = get_option('db_access_filters') ? 'checked="checked" ' : '';	
	echo "<input type='checkbox' id='db_access_filters'  name='db_access_filters'  $check />";
	}
	
	function db_access_myplugin_setting_input5() {
	$check = get_option('db_access_print') ? 'checked="checked" ' : '';	
	echo "<input type='checkbox' id='db_access_print'  name='db_access_print'  $check />";
	}

	function db_access_myplugin_setting_input6() {
	$check = get_option('db_access_columns') ? 'checked="checked" ' : '';	
	echo "<input type='checkbox' id='db_access_columns'  name='db_access_columns'  $check />";
	}
	
	function db_access_myplugin_setting_input7() {
	$check = get_option('db_access_crosshairs') ? 'checked="checked" ' : '';	
	echo "<input type='checkbox' id='db_access_crosshairs'  name='db_access_crosshairs'  $check />";
	}
	
	function db_access_myplugin_setting_input8() {
	$check = get_option('db_access_editable') ? 'checked="checked" ' : '';	
	echo "<input type='checkbox' id='db_access_editable' title='Remember to backup the databae before you make any changes'  name='db_access_editable'  $check />";
	}
?>