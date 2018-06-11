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
// 		    $(self).find('.widget_shopping_cart_content').slideDown('slow',function(){
			
// 			});
// 		},
// 		mouseleave:function(){
// 		    $(self).find('.widget_shopping_cart_content').slideUp('slow',function(){	
		
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
// 		var testimonialPos=$(self).offset().top;
// 		if(winScroll>testimonialPos-300){
// 			$(self).animate({'opacity':1},1000);
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
    var normalOpts = {},
	    resOpts    = {},
	    syncOpts   = {},
	    para       = {};

	var settingsInit = {
		_noramlOpts: function(){
			return {
				speed:300,
				slidesToShow:1,
				slidesToScroll:1,
				autoplaySpeed:3000,
				cssEase:'ease',
				lazyLoad:'progressive',
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
		},

		_stateCtr: function(){
			return { 
				bpActivate:false,
				uninstall:false,
				syncActivate:false
			};
		},
        /* customized syncing settings aren't supported now*/
		_syncOpts: function(){
			return {
		    	slidesToShow: 1,
			    slidesToScroll: 1,
			    arrows: false,
			    fade: true,
			    asNavFor: '.fancy-slider'
		    };
		},

		_resOpts: function(){
			var bp = {xl:1024,l:960,m:768,s:460};
			var dftResOpts ={};
			for ( var property in bp ) {
				dftResOpts[property]={};
				dftResOpts[property].breakpoint = bp[property];
				dftResOpts[property].settings = {
				    slidesToShow: 1,
				    slidersToScroll:1,
				    infinite: false,
				    arrows: false,
				    dots: false
				};
			}
            return dftResOpts;
		}
	};

	var settingsGet = {

		_radio:function(refer,target){
	    	return (fancy_slider_opts[refer][0] === target) ? true : false;
	    },

	    _text:function(refer,suffix){
	    	return fancy_slider_opts[refer][suffix] ;
	    },

	    _checkbox:function(haystack,search,obj){
	    	for ( var i = 0; i < search.length; i++) {
	    		if ( search[i] === 'rtl' ){
			    	$('.fancy-slider').attr({
			    		dir: 'rtl'
			    	});
				}
				if ( search[i] === 'unslick' ) {
					para.uninstall = true;
				}
			    if ( haystack.indexOf( search[i] ) >= 0 ) {
				    obj[ search[i] ] = true;			    
			    }
			}
	    },

	    _number:function(refer,suffix){
	    	return parseInt( fancy_slider_opts[refer][suffix] );
	    },

	    _textarea:function(state,refer){
	    	if ( state ) {
				var lazyImage = fancy_slider_opts[refer].img_name.split(',');
			    for (var j = 0; j < lazyImage.length; j++) {
					var $target =$("img[src$="+"'"+lazyImage[j]+"'"+"]");
				    $target.attr({
				    	'data-lazy': $target.attr('src')
				    }).removeAttr('src');				
			    }
			}
	    },

		_setResOpts: function(ele,bp,slider,scroll){
            resOpts[ele] = {
			    breakpoint: bp,
				settings: {
				    slidesToShow: slider,
				    slidersToScroll:scroll,
				}
			};
		},

		_getOpts : function(){
			var haystack   = [],
	            search     = [],
			    self = this;
			Object.keys( fancy_slider_opts ).forEach( function (ele){
			    switch ( ele ) {
					case 'animation':
					    normalOpts.fade    = self._radio( ele,'fade');
						normalOpts.speed   = self._number(ele,'speed');
						normalOpts.cssEase = self._text(ele,'css_ease');
						break;

					case 'autoplay':
					    normalOpts.autoplay      = self._radio( ele,'enable' );
					    normalOpts.autoplaySpeed = self._number(ele,'speed');
						break;

					case  'centre':
						normalOpts.centerMode    = self._radio( ele,'enable' );
					    normalOpts.centerPadding = self._number(ele,'padding') + 'px';
						break;

					case 'lazyload':
						normalOpts.lazyLoad = self._radio( ele,'ondemand' ) ? 'ondemand':'progressive';
	                    self._textarea( normalOpts.lazyLoad,ele );					
						break;

					case 'format':
					    haystack = ['dots','infinite','arrows','rtl','focusOnSelect'];
					    search = fancy_slider_opts[ele];
					    self._checkbox(haystack,search,normalOpts);			    
						break;

					case 'standard':
						normalOpts.slidesToShow   =  self._number( ele,'sli_qty' );
						normalOpts.slidesToScroll =  self._number( ele,'scr_qty' );
						break;

					case 'sync':
					    para.syncActivate = self._radio( ele,'enable' );
					    if ( para.syncActivate ) {
					    	var synClass = self._text( ele,'asNavFor' );
					    	normalOpts.asNavFor = '.' + synClass;
					    	$( '.fancy-slider' ).clone().
					    	insertBefore( '.fancy-slider' ).
					    	addClass( synClass ).
					    	removeClass( 'fancy-slider' );
					    }
						break;

	                case 'bp_ac':
	                    para.bpActivate = self._radio( ele,'enable' );
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
						    var name = ele.replace('bp_', '');
						    self._setResOpts( name,self._number(ele,'bp'),self._number(ele,'sli_qty'),self._number(ele,'scr_qty') );
		                    self._checkbox( haystack,search,resOpts[name].settings );
		                    if ( para.uninstall ) {
		                    	resOpts[name].settings = 'unslick';
		                    }
					    }
					    break;
				}
		    });
	    }
	};

	var optsReturn = {
		_run:function(){
		    settingsGet._getOpts();
		},
		_settingsProcess : function(){
			var normalRtn  = {},
	            resRtn     = {},
	            paraRtn    = {},
	            syncRtn    = {};
			normalRtn = $.extend( {},settingsInit._noramlOpts(),normalOpts );
			paraRtn   = $.extend( {},settingsInit._stateCtr(),para );
			syncRtn   = $.extend( {},settingsInit._syncOpts(),syncOpts );
			resRtn    = $.extend( true,{},settingsInit._resOpts(),resOpts );
			return [normalRtn,resRtn,syncRtn,paraRtn];
		}    
	};

	$(document).ready(function(){
        var responsiveOpts ={};
		var settings;
		var opts;

        optsReturn._run();
        settings = optsReturn._settingsProcess();
        opts = settings[0];
        /* responsive mode on */
		if ( settings[3].bpActivate ){
			responsiveOpts = {
	        	responsive:[
				    settings[1].xl,
				    settings[1].l,
				    settings[1].m,
				    settings[1].s,
				]
			};
	        opts = $.extend( {},settings[0],responsiveOpts );
		}
        $('.fancy-slider').slick(opts);

        /* syncing mode on */
		if ( settings[3].syncActivate  ){
			$(settings[0].asNavFor).slick(settings[2]);
		}
	    
	});
})(jQuery);
//# sourceMappingURL=../maps/storefront-child-frontpage.js.map
