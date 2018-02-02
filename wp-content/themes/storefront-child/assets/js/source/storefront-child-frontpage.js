/*1---@header cart included
 * Makes the header cart content scrollable if the heigth of items more than readable height
 * Apply the CSS on page load and mouseover. Mouseover is used as items can be added to the cart via ajax and we'll *need to recheck.
 *2---@slider included
 *
 *3---@featured post included
 *
 *4---@testimonial included
 *
 *5---@social links included
 */
/*

$(window).on('beforeunload', function(){
	'use strict';
  $(window).scrollTop(0);
});
*/

jQuery(document).ready(function(){
	'use strict';
	fancy_slider();
	header_cart_scoll();
	featured_posts_scroll();
	recent_post_slider();
});
/*====================================
              1 header cart
====================================*/
function header_cart_scoll(){
	 'use strict';

	var $body =$('body');
	if($body.hasClass('woocommerce-cart') ||$body.hasClass('woocommerce-checkout')||$(window).width()<768 ){
		return;	
	}
	$(document).ajaxSuccess(function() {
     listItemScroll();
    });
     listItemScroll();
}
 function listItemScroll(){
	 'use strict';
	var windowHeight =$(window).height();
	var $cart =$('.site-header-cart');	
	var $cartList = $cart.find('.cart_list');
	var cart_heigth=$cart.outerHeight(true);
	var itemListHeight =$('.widget_shopping_cart_content').outerHeight(true);
	 
	if(itemListHeight+cart_heigth > 0.7*windowHeight){
		$cartList.css({'maxHeight':'16em','overflow':'auto'});
	}
	$cart.on({
		mouseenter:function(){
		    $(this).find('.widget_shopping_cart_content').slideDown('slow',function(){
			
			});
		},
		mouseleave:function(){
		    $(this).find('.widget_shopping_cart_content').slideUp('slow',function(){	
		
			});
			
		}
	});
 }
/*====================================
              2 menu toggle
====================================*/
var $toggle_menu =$('.primary-navigation-left,.primary-navigation-right');
if(($('.menu-toggle').css('display'))!=='none'){
	$toggle_menu.css({'display':'none'});
}
$('.menu-toggle').click(function(){
	$('.slide-out').toggleClass('page-slide-out');
	$('.mini-nav-container').toggleClass('mini-slider-in');
});
/*====================================
              3 slider effect
====================================*/
function fancy_slider(){
	'use strict';
	var args={
	fancy_panel_wrapper:'header-slider-wrapper',
	dot_nav:true,
	arrow_nav:true,
	slider_to_scoll:1,
	speed:5000,	
	};
$('.header-slider-wrapper').fancySlider(args);

}


/*====================================
              4 featured posts
====================================*/
function featured_posts_scroll(){
	'use strict';
	smooth_scroll_fn();
	
	$(window).scroll(function(){
		scroll_effect();
	});
}
function scroll_effect(){
	'use strict';
	var winScroll =$(window).scrollTop();
	$('.testimonial').each(function(){
		var testimonialPos=$(this).offset().top;
		if(winScroll>testimonialPos-300){
			$(this).animate({'opacity':1},1000);
		}
	});
	
}

function smooth_scroll_fn(){
	'use strict';
	if(!$('.yee_slider_wrapper').length){
		return;
	}
	$('.yee_slider_wrapper').prepend('<div class="nav_next"/>');
	
	$('.nav_next').on('click', function() {
		var $scropTop = $('.testimonials-container .testimonial:first-child');
		$('html, body').animate({
			scrollTop: $scropTop.offset().top-30
		}, 1000);

    });
}
/*====================================
              5 recent posts
====================================*/
function recent_post_slider(){
	'use strict';
	var args={
	fancy_panel_wrapper:'newly-products-wrapper',
	dot_nav:false,
	arrow_nav:false,
	slider_to_scoll:2,
	speed:4000,
	duration:2000
	};
$('.newly-products-wrapper').fancySlider(args);

}