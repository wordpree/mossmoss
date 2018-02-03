/*
*option
*---width                ,slider width of X%
*---slider_to_scoll      ,the numbers of scolling sliders 
*---speed                ,change time for sliders
*---duration             ,sliders duration time
*---transition           ,the animation of sliders
*---dot_nav              ,display dot nav
*---arrow_nav            ,display arrow left or right head
*---auto_play            ,sliders auto play
*---infinite             ,sliders ifinitive formate
*---fancy_panel_wrapper ,customized class	     
*<html structural require>
*<div class="fancy-panel-wrapper customized class">
   <div class="fancy-panel">
		<div class="slider-bg-img"/>
		<div class="slider-caption"/>
   </div>
   <div class="fancy-panel customized class">
   		<div class="slider-bg-img"/>
   		<div class="slider-caption"/>
   </div>
*</div>
*
*/
(function($){
	'use strict';
	$.fn.fancySlider=function(options){
		
		var default_settings  = {
			width:1,
			slider_to_show:1,
			slider_to_scoll:1,
			speed:3000,
			duration:1500,
			transition:'slider',
			dot_nav:true,
			arrow_nav:true,
			auto_play:true,
			infinite:true,
			fancy_panel_wrapper:"customized class"
		};
		var opts = $.extend(
			default_settings,
			options
		);
		var $fancy_panel_wrapper = $("."+opts.fancy_panel_wrapper);//obtain customized class
		var view_point         = $(window).width();
		var slider_num         = $fancy_panel_wrapper.find('.fancy-panel').length+opts.slider_to_scoll;//include cloned 
		var slider_width       = opts.width*view_point/opts.slider_to_scoll;
		var slider_scoll_width = opts.width*view_point; 
		var sliders_width      = slider_width*slider_num;
		var slider_step        = 0;
		var slider_index       = 1;//1,2,3,...
		var interval              ;
		
		$( window ).resize(function() {
             view_point = $(window).width();
			 slider_width       = opts.width*view_point/opts.slider_to_scoll;
		     sliders_width      = slider_width*slider_num;
			 $fancy_panel_wrapper.find('.fancy-panel')    
		   	                .css({'width':slider_width+ 'px'});
	   
		   $fancy_panel_wrapper   
		   	                .css('width',sliders_width + 'px');
        });
		
        function fancy_markup(){
			 /*clone scrolling sliders for end of the stack*/
		   for(var i=1;i<opts.slider_to_scoll+1;i++){
		   	   $fancy_panel_wrapper.find('.fancy-panel:nth-child('+i+')').clone().addClass('cloned').appendTo($fancy_panel_wrapper);
		   }
			
		   $fancy_panel_wrapper.find('.fancy-panel')    
		   	                .css({'width':slider_width+ 'px'});
	   
		   $fancy_panel_wrapper   
		   	                .css('width',sliders_width + 'px')
		   	                .wrapAll('<div id= "fancy-slider" class="fancy-slider"/>');
		   
		   if(opts.arrow_nav === true){
			   $('.fancy-slider')
			                .append('<button class="btn-prev fancy-btn"/>')
			                .append('<button class="btn-next fancy-btn"/>');
		   }
		   if(opts.dot_nav === true){
			    $('.fancy-slider')
			                .append('<ul class="slider-dot-wrapper"/>');
		
			   for(var j=0;j<slider_num-opts.slider_to_scoll ;j++){
				 $('.slider-dot-wrapper').append('<li class="slider-dot"/>');
			   }
		   }
		}
		  
		function main_loop_animation(step){
			$fancy_panel_wrapper.addClass('fancy-slider-transition-1').animate({'opacity':1},{
				duration:1500,
				step:function(){
					$(this).css({
							'-ms-transform'     : 'translate3d('+step+'px,0,0)',
							'-o-transform'      : 'translate3d('+step+'px,0,0)',
							'-moz-transform'    : 'translate3d('+step+'px,0,0)',
						    '-webkit-transform' : 'translate3d('+step+'px,0,0)',
				            'transform'         : 'translate3d('+step+'px,0,0)'
					});
				},complete:function(){
					  slider_index++;
				      if(slider_index ===slider_num/opts.slider_to_scoll ){//reached the last slider cloned
						  slider_index=1;
						  $(this).removeClass('fancy-slider-transition-1').css({
							  '-webkit-transform'  : 'translate3d(0,0,0)' ,
				              'transform'         : 'translate3d(0,0,0)',
							  '-ms-transform'     : 'translate3d(0,0,0)',
							  '-o-transform'      : 'translate3d(0,0,0)',
							  '-moz-transform'    : 'translate3d(0,0,0)',
								  });	  
					  }     
				}
			}); 
		}  
		
		function fancy_main_loop(){
			var dot_index = slider_index+1;
			$( window ).resize(function() {
             view_point = $(window).width();
			 slider_scoll_width = opts.width*view_point;
        });
			slider_step =-slider_scoll_width*slider_index;
			main_loop_animation(slider_step);	 
			if(opts.dot_nav){//dot activated
				if(dot_index >$('.slider-dot').length){
				    dot_index=1;
			    }
			    $('.slider-dot').removeClass('selected');
			    $(".slider-dot:nth-child("+dot_index+")").addClass('selected');
			}  	
		}
		
        function fancy_arrow_effect(){//it can be modified later for infinitive loop
			$('.fancy-btn').click(function(){
				var arrow_index;
				var step;
				if($(this).hasClass('btn-prev')){
					slider_index--;
				}else{
					slider_index++;
				}
				if(slider_index <1){
					slider_index=1;
				} 	
				if(slider_index >$('.slider-dot').length){
					slider_index=4;
				}
				arrow_index =slider_index-1;
				step=-arrow_index*slider_scoll_width;
                $fancy_panel_wrapper.css({
					   '-webkit-transform' : 'translate3d('+step+'px,0,0)',
				       '-ms-transform'     : 'translate3d('+step+'px,0,0)',
				       '-o-transform'      : 'translate3d('+step+'px,0,0)',
				       '-moz-transform'    : 'translate3d('+step+'px,0,0)',
				       'transform'         : 'translate3d('+step+'px,0,0)',
					}).addClass('fancy-slider-transition-1');
				if(opts.dot_nav){
					$('.slider-dot').removeClass('selected');
		            $('.slider-dot:nth-child('+slider_index+')').addClass('selected');
				}
		   });
		} 
		
		function fancy_dot_effect(){
			$('li.slider-dot:first-child').addClass('selected');
			$('.slider-dot').each(function(index){
				var $this = $(this);
				var step =-index*slider_scoll_width;				 
				$this.on('click',function(){
					slider_index =index+1;//syn slider index
			        $fancy_panel_wrapper.css({
					   '-webkit-transform' : 'translate3d('+step+'px,0,0)',
				       '-ms-transform'     : 'translate3d('+step+'px,0,0)',
				       '-o-transform'      : 'translate3d('+step+'px,0,0)',
				       '-moz-transform'    : 'translate3d('+step+'px,0,0)',
				       'transform'         : 'translate3d('+step+'px,0,0)',
					}).addClass('fancy-slider-transition-1');
					$('.slider-dot').removeClass('selected');
		            $this.addClass('selected');
			   });  
			});	
		} 
		
		function slider_move_loop(){
	      fancy_main_loop();	
		}
	
		
		function stop_fancy_slider(){
			clearInterval(interval);
		}
		
		function start_fancy_slider(){
			interval=setInterval(slider_move_loop,opts.speed);
		}
		
		/*fire here*/
		fancy_markup();
		start_fancy_slider();
		$('.fancy-slider').on('mouseenter',stop_fancy_slider).on('mouseleave',start_fancy_slider);
		if(opts.dot_nav){
		  fancy_dot_effect();
		}
		if(opts.arrow_nav){
		  fancy_arrow_effect();
		}

		
		return this;
	};
	
	
}(jQuery));
//# sourceMappingURL=maps/jquery.fancyslider.js.map
