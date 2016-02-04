<?php
/**
 * Page builder support
 *
 * @package Perth
 */


/* Defaults */
add_theme_support( 'siteorigin-panels', array( 
	'margin-bottom' => 0,
) );

/* Theme widgets */
function perth_theme_widgets($widgets) {
	$theme_widgets = array(
		'Perth_Services_Type_A',
		'Perth_Services_Type_B',
		'Perth_Facts',
		'Perth_Clients',
		'Perth_Testimonials',
		'Perth_Skills',
		'Perth_Action',
		'Perth_Video_Widget',
		'Perth_Social_Profile',
		'Perth_Employees',
		'Perth_Latest_News',
		'Perth_Separator_Type_A',
		'Perth_Separator_Type_B'
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('perth-theme');
			$widgets[$theme_widget]['icon'] = 'dashicons dashicons-schedule';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'perth_theme_widgets');

/* Add a tab for the theme widgets in the page builder */
function perth_theme_widgets_tab($tabs){
	$tabs[] = array(
		'title' => __('Perth Theme Widgets', 'perth'),
		'filter' => array(
			'groups' => array('perth-theme')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'perth_theme_widgets_tab', 20);

/* Replace default row options */
function perth_row_styles($fields) {

	$fields['bottom_border'] = array(
		'name' => __('Bottom Border Color', 'perth'),
		'type' => 'color',
		'priority' => 3,		
	);
	$fields['padding'] = array(
		'name' => __('Top/bottom padding', 'perth'),
		'type' => 'measurement',
		'description' => __('Top and bottom padding for this row [default: 100px]', 'perth'),
		'priority' => 4,
	);
	$fields['align'] = array(
		'name' => __('Center align the content?', 'perth'),
		'type' => 'checkbox',
		'description' => __('This may or may not work. It depends on the widget styles.', 'perth'),
		'priority' => 5,
	);		
	$fields['background'] = array(
		'name' => __('Background Color', 'perth'),
		'type' => 'color',
		'description' => __('Background color of the row.', 'perth'),
		'priority' => 6,
	);
	$fields['color'] = array(
		'name' => __('Color', 'perth'),
		'type' => 'color',
		'description' => __('Color of the row.', 'perth'),
		'priority' => 7,
	);	
	$fields['background_image'] = array(
		'name' => __('Background Image', 'perth'),
		'type' => 'image',
		'description' => __('Background image of the row.', 'perth'),
		'priority' => 8,
	);
	$fields['row_stretch'] = array(
		'name' 		=> __('Row Layout', 'perth'),
		'type' 		=> 'select',
		'options' 	=> array(
			'' 				 => __('Standard', 'perth'),
			'full' 			 => __('Full Width', 'perth'),
			'full-stretched' => __('Full Width Stretched', 'perth'),
		),
		'priority' => 9,
	);
	$fields['mobile_padding'] = array(
		'name' 		  => __('Mobile padding', 'perth'),
		'type' 		  => 'select',
		'description' => __('Here you can select a top/bottom row padding for screen sizes < 1024px', 'perth'),		
		'options' 	  => array(
			'' 				=> __('Default', 'perth'),
			'mob-pad-0' 	=> __('0', 'perth'),
			'mob-pad-15'    => __('15px', 'perth'),
			'mob-pad-30'    => __('30px', 'perth'),
			'mob-pad-45'    => __('45px', 'perth'),
		),
		'priority'    => 10,
	);
	$fields['class'] = array(
		'name' => __('Row Class', 'perth'),
		'type' => 'text',
		'description' => __('Add your own class for this row', 'perth'),
		'priority' => 11,
	);
	$fields['column_padding'] = array(
		'name'        => __('Columns padding', 'perth'),
		'type'        => 'checkbox',
		'description' => __('Remove padding between columns for this row?', 'perth'),
		'priority'    => 12,
	);	

	return $fields;
}
remove_filter('siteorigin_panels_row_style_fields', array('SiteOrigin_Panels_Default_Styling', 'row_style_fields' ) );
add_filter('siteorigin_panels_row_style_fields', 'perth_row_styles');

/* Filter for the styles */
function perth_row_styles_output($attr, $style) {
	$attr['style'] = '';

	if(!empty($style['bottom_border'])) $attr['style'] .= 'border-bottom: 1px solid '. esc_attr($style['bottom_border']) . ';';
	if(!empty($style['background'])) $attr['style'] .= 'background-color: ' . esc_attr($style['background']) . ';';
	if(!empty($style['color'])) {
		$attr['style'] .= 'color: ' . esc_attr($style['color']) . ';';
		$attr['data-hascolor'] = 'hascolor';
	}
	if(!empty($style['align'])) $attr['style'] .= 'text-align: center;';
	if(!empty( $style['background_image'] )) {
		$url = wp_get_attachment_image_src( $style['background_image'], 'full' );
		if( !empty($url) ) {
			$attr['style'] .= 'background-image: url(' . esc_url($url[0]) . ');';
			$attr['class'][] = 'parallaxBg';
			$attr['data-hasbg'] = 'hasbg';			
		}
	}
	if(!empty($style['padding'])) {
		$attr['style'] .= 'padding: ' . esc_attr($style['padding']) . ' 0; ';
	} else {
		$attr['style'] .= 'padding: 100px 0; ';
	}
	if( !empty( $style['row_stretch'] ) ) {
		$attr['class'][] = 'perth-stretch';
		$attr['data-stretch-type'] = esc_attr($style['row_stretch']);
	}
	if( !empty( $style['mobile_padding'] ) ) {
		$attr['class'][] = esc_attr($style['mobile_padding']);
	}
    if( !empty( $style['column_padding'] ) ) {
       $attr['class'][] = 'no-col-padding';
    }
    
	if(empty($attr['style'])) unset($attr['style']);
	return $attr;
}
add_filter('siteorigin_panels_row_style_attributes', 'perth_row_styles_output', 10, 2);