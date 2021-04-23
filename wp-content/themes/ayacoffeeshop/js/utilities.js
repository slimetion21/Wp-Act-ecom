(function($) {

	"use strict";

	$( document ).ready(function() {

		if ($('#wpadminbar').length > 0) {
		
			$('#header-main-fixed').css('top', $('#wpadminbar').height() + 'px');
			$('#wpadminbar').css('position', 'fixed');
		}

		$(window).on('scroll', function () {

			if ($(this).scrollTop() > 100) {

				$('.scrollup').fadeIn();

			} else {

				$('.scrollup').fadeOut();

			}
		});

		$('.scrollup').on('click', function () {
			
			$("html, body").animate({
				  scrollTop: 0
			  }, 600);

			return false;
		});

		ayacoffeeshop_mainMenuInit();

		if ( $(window).width() < 800 ) {
		
			$('#navmain > div > ul > li').each(
		       function() {
		         if ($(this).find('> ul.sub-menu').length > 0) {

		           $(this).prepend('<span class="sub-menu-item-toggle"></span>');
		         }
		       }
		    );

			$('#navmain').on('focusin', function(){

			   	if ($('#header-main-fixed-container').hasClass("header-sticky")) {

			        if ($('#navmain > div > ul').css('right') == '-99999px') {

			          $('#navmain > div > ul').css({'right': 'auto'}).css('z-index', '5000');
			          $('#navmain ul ul').css({'right': 'auto'}).css({'position': 'relative'}).css('z-index', '5000');

			          $('.sub-menu-item-toggle').addClass('sub-menu-item-toggle-expanded');
			        }

	      		} else {

			    	if ($('#navmain > div > ul').css('z-index') == '-1') {

				        $('#navmain > div > ul').css({'z-index': '5000'});
				        $('#navmain ul ul').css({'z-index': '5000'}).css({'position': 'relative'});

				        $('.sub-menu-item-toggle').addClass('sub-menu-item-toggle-expanded');
				    }
		  		}
		    });

		   $('.sub-menu-item-toggle').on('click', function(e) {

				e.stopPropagation();

				var subMenu = $(this).parent().find('> ul.sub-menu');

				if ($('#header-main-fixed-container').hasClass("header-sticky")) {

		        	$('#navmain ul ul.sub-menu').not(subMenu).css('right', '-99999px').css('position', 'absolute');
		        	$('#navmain span.sub-menu-item-toggle').not(this).removeClass('sub-menu-item-toggle-expanded');
		        	$(this).toggleClass('sub-menu-item-toggle-expanded');
		        	if (subMenu.css('right') == '-99999px') {

		          		subMenu.css({'right': 'auto'}).css({'position': 'relative'}).css('z-index', '5000');
		          		subMenu.find('ul.sub-menu').css({'right': 'auto'}).css({'position': 'relative'}).css('z-index', '5000');

		       		} else {

		          		subMenu.css({'right': '-99999px'}).css({'position': 'absolute'});
		          		subMenu.find('ul.sub-menu').css({'right': '-99999px'}).css({'position': 'absolute'});
		       		}

		      	} else {

				    $('#navmain ul ul.sub-menu').not(subMenu).css('z-index', '-1').css('position', 'absolute');
				    $(this).toggleClass('sub-menu-item-toggle-expanded');
				    
				    if (subMenu.css('z-index') == '-1') {

		        		subMenu.css({'z-index': '5000'}).css({'position': 'relative'});
		        		subMenu.find('ul.sub-menu').css({'z-index': '5000'}).css({'position': 'relative'});

		     		} else {

		        		subMenu.css({'z-index': '-1'}).css({'position': 'absolute'});
		        		subMenu.find('ul.sub-menu').css({'z-index': '-1'}).css({'position': 'absolute'});
		     		}
		     	}
			});
		}

		$('#navmain > div').on('click', function(e) {

			e.stopPropagation();

			// toggle main menu
			if ( $(window).width() < 800 ) {

				var parentOffset = $(this).parent().offset(); 
				
				var relY = e.pageY - parentOffset.top;
			
				if (relY < 36) {
				
					var firstChild = $('ul:first-child', this);


					if (jQuery('#header-main-fixed-container').hasClass("header-sticky")) {

				          if (firstChild.css('right') == '-99999px')
				            firstChild.css({'right': 'auto'});
				        else
				            firstChild.css({'right': '-99999px'});

			        } else {

				        if (firstChild.css('z-index') == '-1')
				            firstChild.css({'z-index': '5000'});
				        else
				            firstChild.css({'z-index': '-1'});
			    	}

        firstChild.parent().toggleClass('mobile-menu-expanded');
				}
			}
		});

		$('#main-content-wrapper, #home-content-wrapper').on('focusin', function(){

			// toggle main menu
			if ( $(window).width() < 800 ) {console.log('AA');
			
				var firstChild = $('#navmain > div > ul');

				if (firstChild.css('right') != '-99999px')
			        firstChild.css({'right': '-99999px'});

			    if (firstChild.css('z-index') == '5000')
			        firstChild.css({'z-index': '-1'});

    			firstChild.parent().removeClass('mobile-menu-expanded');
			}
	    });

		// re-init main menu on screen resize
		$(window).on('resize', function () {
	       
	    	ayacoffeeshop_mainMenuClear();
	    	ayacoffeeshop_mainMenuInit();
		});
	});

	function ayacoffeeshop_mainMenuClear() {

		if ( $(window).width() >= 800 ) {
		
			$('#navmain > div > ul > li').has('ul').removeClass('level-one-sub-menu');
			$('#navmain > div > ul li ul li').has('ul').removeClass('level-two-sub-menu');										
		}

		if ( $('ul:first-child', $('#navmain > div') ).is( ":visible" ) ) {

			$('ul:first-child', $('#navmain > div') ).css('display', '');
		}
	}

	function ayacoffeeshop_mainMenuInit() {

		if ( $(window).width() >= 800 ) {
		
			$('#navmain > div > ul > li').has('ul').addClass('level-one-sub-menu');
			$('#navmain > div > ul li ul li').has('ul').addClass('level-two-sub-menu');

    // add support of browsers which don't support focus-within
    $('#navmain > div > ul > li > a:not(.login-form-icon):not(.search-form-icon), #navmain > div > ul > li > ul > li > a, #navmain > div > ul > li > ul > li > ul > li > a, .mega-menu-sub-menu')
      .on('mouseenter focus', function() {
        $(this).closest('li.level-one-sub-menu').addClass('menu-item-focused');
        $(this).closest('li.level-two-sub-menu').addClass('menu-item-focused');

        if (!$(this).parent().find('#cart-popup-content').length && $('#cart-popup-content').css('z-index') != '-1')
          $('#cart-popup-content').css('z-index', '-1');
      }).on('mouseleave blur', function() {
        $(this).closest('li.level-one-sub-menu').removeClass('menu-item-focused');
        $(this).closest('li.level-two-sub-menu').removeClass('menu-item-focused');
    });										
		}
	}

	$(window).on('scroll', function() {
		if ($(this).scrollTop() > 1){  
			$('#header-main-fixed-container').addClass("header-sticky");

			if ( $(window).width() >= 800 ) {
		      $('#navmain ul ul').css('right', '-99999px');
		    }
		}
		else{
			$('#header-main-fixed-container').removeClass("header-sticky");

			if ( $(window).width() >= 800 ) {
		      $('#navmain ul ul').css('right', 'auto');
		    }
		}
	});

	function ayacoffeeshop_setCurrentSlide(slideIndex) {

	    var headerMain = $('#header-main-fixed');
	    var sliderImageContainer = $('#slider-image-container');

	    var slides = headerMain.data('slides');

	    if (!slides || slideIndex >= $(slides).length) {

	        return;
	    }

	    var slide = slides[slideIndex];
	    var slideImage = 'url("' + slide['slideImage'] + '")';

	    if ( slideImage != sliderImageContainer.css('background-image') ) {

	        headerMain.css("background-color", '#555555');
	        sliderImageContainer.animate({opacity: 0.6}, 400, function() {
	                        $(this)
	                            .css("background-image", slideImage)
	                            .animate({opacity: 1}, 400);
	                    });
	    }

	    $(".slider-dots > span").removeClass("slider-current-dot");

	    $(".slider-dots > span:nth-child(" + (slideIndex + 1) + ")").addClass("slider-current-dot");

	    headerMain.data('currentslide', slideIndex);
	}

	$( document ).ready(function() {

	    ayacoffeeshop_setCurrentSlide(0);

	    window.sliderPrevNextClicked = false;

	    $('.slider-prev').on('click', function() {

	        var currentIndex = $('#header-main-fixed').data('currentslide');

	        window.sliderPrevNextClicked = true;

	        if (currentIndex > 0) {

	            --currentIndex;
	            ayacoffeeshop_setCurrentSlide(currentIndex);

	        } else {

	            currentIndex = $('#header-main-fixed').data('slides').length - 1;

	            ayacoffeeshop_setCurrentSlide(currentIndex);          
	        }
	    });

	    $('.slider-next').on('click', function() {

	        window.sliderPrevNextClicked = true;
	      
	        var currentIndex = $('#header-main-fixed').data('currentslide');

	        if (currentIndex < $('#header-main-fixed').data('slides').length - 1) {

	            ++currentIndex;
	            ayacoffeeshop_setCurrentSlide(currentIndex);

	        } else {

	            ayacoffeeshop_setCurrentSlide(0);          
	        }
	    });

	    $('.slider-dots > span').on('click', function() {

	        window.sliderPrevNextClicked = true;

	        var slideNum = $(this).data('slidenum');

	        ayacoffeeshop_setCurrentSlide(slideNum);
	    });

	    window.setInterval(function(){

	      if (window.sliderPrevNextClicked) {

	        window.sliderPrevNextClicked = false;
	        return;
	      }
		
			  if ( !$(window).scrollTop() ) {

				  $('.slider-next').click();
			  
		      }
	    }, 5000);

	    $(document).on('keydown', function(e) {
	        switch(e.which) {
	            case 37: // left
	            window.sliderPrevNextClicked = true;
	            $('.slider-prev').click();
	            break;

	            case 39: // right
	            window.sliderPrevNextClicked = true;
	            $('.slider-next').click();
	            break;

	            default: return;
	        }
	        e.preventDefault();
	    });
	});

})(jQuery);