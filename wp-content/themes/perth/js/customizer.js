/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	//Menu background
	wp.customize('menu_bg_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('background-color', newval );
		} );
	});
	//Site title
	wp.customize('site_title_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-title a').css('color', newval );
		} );
	});
	//Site desc
	wp.customize('site_desc_color',function( value ) {
		value.bind( function( newval ) {
			$('.site-description').css('color', newval );
		} );
	});
	//Top level menu items
	wp.customize('top_items_color',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation a').not('.main-navigation ul ul a').css('color', newval );
		} );
	});	
	//Sub-menu items
	wp.customize('submenu_items_color',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation ul ul a').css('color', newval );
		} );
	});
	wp.customize('submenu_background',function( value ) {
		value.bind( function( newval ) {
			$('.main-navigation ul ul li').css('background-color', newval );
		} );
	});	
	//Header text
	wp.customize('header_text_color',function( value ) {
		value.bind( function( newval ) {
			$('.header-text').css('color', newval );
		} );
	});	
	// Body text color
	wp.customize('body_text_color',function( value ) {
		value.bind( function( newval ) {
			$('body').css('color', newval );
		} );
	});
	//Footer widgets background
	wp.customize('footer_widgets_background',function( value ) {
		value.bind( function( newval ) {
			$('.footer-widgets').css('background-color', newval );
		} );
	})
	//Rows overlay
	wp.customize('rows_overlay',function( value ) {
		value.bind( function( newval ) {
			$('.overlay').css('background-color', newval );
		} );
	})
	//Header overlay
	wp.customize('header_overlay',function( value ) {
		value.bind( function( newval ) {
			$('.header-overlay').css('background-color', newval );
		} );
	})	
	//Header image height
	wp.customize('header_height',function( value ) {
		value.bind( function( newval ) {
			$('.header-image').css('height', newval+'px' );
		} );
	})	

} )( jQuery );
