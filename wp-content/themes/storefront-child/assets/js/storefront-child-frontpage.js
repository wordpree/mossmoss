// /*1---@header cart included
//  * Makes the header cart content scrollable if the heigth of items more than readable height
//  * Apply the CSS on page load and mouseover. Mouseover is used as items can be added to the cart via ajax and we'll *need to recheck.
//  *2---@slider included
//  *
//  *3---@featured post included
//  *
//  *4---@testimonial included
//  *
//  *5---@social links included
//  */
// /*

// $(window).on('beforeunload', function(){
// 	'use strict';
//   $(window).scrollTop(0);
// });
// */

// jQuery(document).ready(function(){
// 	'use strict';
// 	fancy_slider();
// 	header_cart_scoll();
// 	featured_posts_scroll();
// 	recent_post_slider();
// });
// /*====================================
//               1 header cart
// ====================================*/
// function header_cart_scoll(){
// 	 'use strict';

// 	var $body =$('body');
// 	if($body.hasClass('woocommerce-cart') ||$body.hasClass('woocommerce-checkout')||$(window).width()<768 ){
// 		return;	
// 	}
// 	$(document).ajaxSuccess(function() {
//      listItemScroll();
//     });
//      listItemScroll();
// }
//  function listItemScroll(){
// 	 'use strict';
// 	var windowHeight =$(window).height();
// 	var $cart =$('.site-header-cart');	
// 	var $cartList = $cart.find('.cart_list');
// 	var cart_heigth=$cart.outerHeight(true);
// 	var itemListHeight =$('.widget_shopping_cart_content').outerHeight(true);
	 
// 	if(itemListHeight+cart_heigth > 0.7*windowHeight){
// 		$cartList.css({'maxHeight':'16em','overflow':'auto'});
// 	}
// 	$cart.on({
// 		mouseenter:function(){
// 		    $(this).find('.widget_shopping_cart_content').slideDown('slow',function(){
			
// 			});
// 		},
// 		mouseleave:function(){
// 		    $(this).find('.widget_shopping_cart_content').slideUp('slow',function(){	
		
// 			});
// 		}
// 	});
//  }
// /*====================================
//               2 menu toggle
// ====================================*/
// // var $toggle_menu =$('.primary-navigation-left,.primary-navigation-right');
// // if(($('.menu-toggle').css('display'))!=='none'){
// // 	$toggle_menu.css({'display':'none'});
// // }
// // $('.menu-toggle').click(function(){
// // 	$('.slide-out').toggleClass('page-slide-out');
// // 	$('.mini-nav-container').toggleClass('mini-slider-in');
// // });
// /*====================================
//               3 slider effect
// ====================================*/
// function fancy_slider(){
// 	'use strict';
// 	var args={
// 	fancy_panel_wrapper:'header-slider-wrapper',
// 	dot_nav:true,
// 	arrow_nav:true,
// 	slider_to_scoll:1,
// 	speed:5000,	
// 	};
// $('.header-slider-wrapper').fancySlider(args);


// }


// /*====================================
//               4 featured posts
// ====================================*/
// function featured_posts_scroll(){
// 	'use strict';
// 	smooth_scroll_fn();
	
// 	$(window).scroll(function(){
// 		scroll_effect();
// 	});
// }
// function scroll_effect(){
// 	'use strict';
// 	var winScroll =$(window).scrollTop();
// 	$('.testimonial').each(function(){
// 		var testimonialPos=$(this).offset().top;
// 		if(winScroll>testimonialPos-300){
// 			$(this).animate({'opacity':1},1000);
// 		}
// 	});
	
// }

// function smooth_scroll_fn(){
// 	'use strict';
// 	if(!$('.yee_slider_wrapper').length){
// 		return;
// 	}
// 	$('.yee_slider_wrapper').prepend('<div class="nav_next"/>');
	
// 	$('.nav_next').on('click', function() {
// 		var $scropTop = $('.testimonials-container .testimonial:first-child');
// 		$('html, body').animate({
// 			scrollTop: $scropTop.offset().top-30
// 		}, 1000);

//     });
// }
// /*====================================
//               5 recent posts
// ====================================*/
// function recent_post_slider(){
// 	'use strict';
// 	var args={
// 	fancy_panel_wrapper:'newly-products-wrapper',
// 	dot_nav:false,
// 	arrow_nav:false,
// 	slider_to_scoll:2,
// 	speed:4000,
// 	duration:2000
// 	};
// $('.newly-products-wrapper').fancySlider(args);
// }
(function($){
	'use strict';
	function fancySliderSettings(){
		var haystack,search ;
		var para = { bpActivate:false,uninstall:false };
		var opts = {};
		var normalOpts = {};
	    var resOpts = {};
	    var syncOpts = {};
		var defaultOpts = {
				speed:300,
				slidesToShow:1,
				slidesToScroll:1,
				autoplaySpeed:3000,
				cssEase:'ease',
				lazyLoad:'ondemand',
				centerPadding:'50px',
				rtl:false,
				dots:false,
				fade:false,
				arrows:false,
				autoplay:false,
				infinite:false,
				centerMode:false,
				focusOnSelect:false,
		};
		Object.keys( fancy_slider_opts ).forEach( function (ele){
		    switch ( ele ) {
				case 'animation':
				    normalOpts.fade    = (fancy_slider_opts[ele][0] === 'fade') ? true : false;
					normalOpts.speed   = parseInt( fancy_slider_opts[ele].speed );
					normalOpts.cssEase = fancy_slider_opts[ele].css_ease;
					break;

				case 'autoplay':
				    normalOpts.autoplay      = (fancy_slider_opts[ele][0] === 'enable') ? true : false;
				    normalOpts.autoplaySpeed = parseInt( fancy_slider_opts[ele].speed );
					break;

				case  'centre':
					normalOpts.centerMode    = (fancy_slider_opts[ele][0] === 'enable') ? true : false;
				    normalOpts.centerPadding =  fancy_slider_opts[ele].padding + 'px';
					break;

				case 'lazyload':
					normalOpts.lazyLoad = fancy_slider_opts[ele][0];
					var lazyImage = [];
					if ( normalOpts.lazyLoad === "ondemand" ) {
						lazyImage = fancy_slider_opts[ele].img_name.split(',');
					    for (var j = 0; j < lazyImage.length; j++) {
							var $target =$("img[src$="+"'"+lazyImage[j]+"'"+"]");
						    $target.attr({
						    	'data-lazy': $target.attr('src')
						    }).removeAttr('src');				
					    }
					}					
					break;

				case 'format':
				    haystack = ['dots','infinite','arrows','rtl','focusOnSelect'];
				    search = fancy_slider_opts[ele];
				    for ( var i = 0; i < search.length; i++) {
						    if ( haystack.indexOf( search[i] ) >= 0 ) {
							    normalOpts[search[i]] = true;
							    if ( search[i] === 'rtl' ){
							    	$('.fancy-slider').attr({
							    		dir: 'rtl'
							    	});
							    }
						    }
				    }			    
					break;

				case 'standard':
					normalOpts.slidesToShow   =  parseInt( fancy_slider_opts[ele].sli_qty ) ;
					normalOpts.slidesToScroll =  parseInt( fancy_slider_opts[ele].scr_qty ) ;
					break;

				case 'sync':
				    if (fancy_slider_opts[ele][0] === 'enable') {
				    	normalOpts.asNavFor =  '.'+fancy_slider_opts[ele].asNavFor;
				    	$('.fancy-slider').clone().
				    	insertBefore('.fancy-slider').
				    	addClass(fancy_slider_opts[ele].asNavFor).
				    	removeClass('fancy-slider');
					    syncOpts = {
					    	slidesToShow: 1,
						    slidesToScroll: 1,
						    arrows: false,
						    fade: true,
						    asNavFor: '.fancy-slider'
						    //specific settings to be added later
					    };
				    }
					break;

                case 'bp_ac':
                    para.bpActivate = (fancy_slider_opts[ele][0] === 'enable') ? true:false;
                    break;

				case 'bp_xl':
				case 'bp_l':
				case 'bp_m':
				case 'bp_s':
				    if ( para.bpActivate ){
				    	haystack = ['arrows','infinite','dots'];
					    search = Object.keys( fancy_slider_opts[ele] ).map(function(e){
						    return fancy_slider_opts[ele][e];
					    }).slice(0, -3);
	                    resOpts[ele] = {
					        breakpoint: parseInt( fancy_slider_opts[ele].bp ),
					        settings: {
						        slidesToShow: parseInt( fancy_slider_opts[ele].sli_qty ),
						        slidersToScroll:parseInt( fancy_slider_opts[ele].scr_qty ),
						        dots: false,
						        arrows:false,
						    }
	                    };
	                    for (var k = 0; k < search.length; k++) {
	                    	para.uninstall = ( search[k] === 'unslick' ) ? true : false;
	                    	if (haystack.indexOf( search[k] ) >=0 ){
	                    		resOpts[ele].settings[search[k]] = true;	
	                    	}
	                    }
	                    if ( para.uninstall ) {
	                    	resOpts[ele].settings = 'unslick';
	                    }
				    }
				    break;
			}
		});
		opts = $.extend(true,{},defaultOpts,normalOpts);
	    return [opts,resOpts,syncOpts,para];
	}

	$(document).ready(function(){
        var responsiveOpts ={};
		var settings = fancySliderSettings();
		var opts = settings[0];

        /* responsive mode on */
		if ( settings[3].bpActivate ){
			responsiveOpts = {
	        	responsive:[
				    settings[1].bp_xl,
				    settings[1].bp_l,
				    settings[1].bp_m,
				    settings[1].bp_s,
				]
			};
	        opts = $.extend( {},settings[0],responsiveOpts );
		}
        $('.fancy-slider').slick(opts);

        /* syncing mode on */
		if ( typeof(settings[0].asNavFor) !== 'undefined' ){
			$(settings[0].asNavFor).slick(settings[2]);
		}
	    
	});
})(jQuery);
//# sourceMappingURL=../maps/storefront-child-frontpage.js.map
