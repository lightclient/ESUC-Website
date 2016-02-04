//Menu dropdown animation
jQuery(function($) {
	$('.sub-menu').hide();
	$('.main-navigation .children').hide();
	$('.menu-item').hover( 
		function() {
			$(this).children('.sub-menu').slideDown();
		}, 
		function() {
			$(this).children('.sub-menu').hide();
		}
	);
	$('.main-navigation li').hover( 
		function() {
			$(this).children('.main-navigation .children').slideDown();
		}, 
		function() {
			$(this).children('.main-navigation .children').hide();
		}
	);	
});

//Panels
jQuery(function($) {
	$(".panel-row-style").each( function() {
		if ($(this).data('hascolor')) {
			$(this).find('h1,h2,h3,h4,h5,h6,a,.fa, div, span').css('color','inherit');
		}
		if ($(this).data('hasbg')) {
			$(this).append( '<div class="overlay"></div>' );
		}			
	});
});

//Row separators
jQuery(function($) {
	var rowSvg = $('.row-svg');
	var width = $(window).width();
	var rowWidth = $('.panel-grid').width();
	var margin = (width - rowWidth)/2;	
	
	//Unwrap svg containers
	rowSvg.parentsUntil('.panel-grid').unwrap();
	rowSvg.unwrap();	
	
	//Apply margins
	rowSvg.css('margin', -margin);
	$(window).resize(function(){	
		var width 		= $(window).width();
		var rowWidth 	= $('.panel-grid').width();
		var margin 		= (width - rowWidth)/2;
		rowSvg.css('margin', -margin);
	});

	//Add classes
	$('.row-separator').next('.panel-grid').find('.panel-row-style').addClass('rowSepBefore');	
	$('.row-sep-b').prev('.panel-grid').find('.panel-row-style').addClass('rowSepAfter');	
});	

//Parallax
jQuery(function($) {
	var selectors = $(".parallaxBg, .header-image");
	$(window).bind('load', function() {
		selectors.parallax("50%", 0.1);	
	});
});

//Fit Vids
jQuery(function($) {
    $("body").fitVids();  
});

//Menu bar
jQuery(function($) {
    var headerHeight = $('.site-header').outerHeight();
    $('.header-clone').css('height',headerHeight);

	$(window).resize(function(){	
		var headerHeight = $('.site-header').outerHeight();
		$('.header-clone').css('height',headerHeight);
	});
});

//Go to top
jQuery(function($) {
	var goTop = $('.go-top');
	$(window).scroll(function() {
		if ( $(this).scrollTop() > 800 ) {
			goTop.addClass('show');
		} else {
			goTop.removeClass('show');
		}
	}); 

	goTop.on('click', function() {
		$("html, body").animate({ scrollTop: 0 }, 1000);
		return false;
	});
});

//Carousel
jQuery(function($) {
	if ( $().owlCarousel ) {
		$(".testimonials-area").owlCarousel({
			navigation : false,
			pagination: true,
			responsive: true,
			items: 1,
			itemsDesktop: [3000,1],
			itemsDesktopSmall: [1400,1],
			itemsTablet:[970,1],
			itemsTabletSmall: [600,1],
			itemsMobile: [360,1],
			touchDrag: true,
			mouseDrag: true,
			autoHeight: true,
			autoPlay: true
		});
	}
});

//Preloader
jQuery(function($) {
    $('.preloader').css('opacity', 0);
    setTimeout(function() {
        $('.preloader').hide();}, 600
    );   
});

//Mobile menu
jQuery(function($) {
	$('.main-navigation .menu').slicknav({
		label: '<i class="fa fa-bars"></i>',
		prependTo: '.mobile-nav',
		closedSymbol: '&#43;',
		openedSymbol: '&#45;',
		allowParentLinks: true
	});
});	

//Smooth scrolling
jQuery(function($) {
    $('a[href*=#]:not([href=#],.wc-tabs a,.activity-content a)').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
		        $('html,body').animate({
		          scrollTop: target.offset().top - 70
		        }, 1000);
		        return false;
		    }
		}
	});
});			