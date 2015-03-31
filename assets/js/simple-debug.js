/**
* @preserve Simple Debug Info Panel 1.0 | @senff | GPL2 Licensed
*/

(function($) {
	$(document).ready(function($) {

		if (simple_debug_engage.viewport) {
			checkVP = setInterval(function(){updateDebugBox()},10);
		}

		if ( $('.box-open').length ) {
			loadHeight = $('.sdib-details table').outerHeight()+10;
			$('.sdib-details').height(loadHeight+'px');
		}

		$('.sdib-icon-open, .box-closed h2').on('click',function(){
			newHeight = $('.sdib-details table').outerHeight()+10;
			$('.sdib-details').animate({
				height: newHeight+'px'
				}, 350, function() {
		  	});
			$('.simple-debug-info-box').removeClass('box-closed').addClass('box-open');
		});

		$('.sdib-icon-close').on('click',function(){
			$('.sdib-details').animate({
				height: '0'
				}, 350, function() {
		  	});
			$('.simple-debug-info-box').removeClass('box-open').addClass('box-closed');
		});

	});

	$(window).resize(function() {
		if ( $('.box-open').length ) {
			insideHeight = $('.sdib-details table').outerHeight()+10;
			$('.sdib-details').height(insideHeight+'px');
		}
	});



	function updateDebugBox() {

    	// Calculating actual viewport width
		var e = window, a = 'inner';
		if (!('innerWidth' in window )) {
		  a = 'client';
		  e = document.documentElement || document.body;
		}

		viewportWidth = e[ a+'Width' ];
		viewportHeight = e[ a+'Height' ];

		vpWidth = $(window).width();
		vpHeight = $(window).height();
		$('.simple-debug-info-box .screen-size').html('<strong>' + viewportWidth + '</strong> x <strong>' + viewportHeight + '</strong>');
	}

}(jQuery));




