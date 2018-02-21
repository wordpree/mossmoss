jQuery(document).ready(function($){
	
	//tooltip
	$(function () { $("[data-toggle='tooltip']").tooltip(); });

	// responsive nav
	jQuery(".site-nav-toggle").click(function(){
		jQuery(".site-nav").toggle();
	});
	
	//search
	var $ct_top_menu = $( 'ul.nav' ),
		$ct_search_icon = $( '#ct_search_icon' );
	$(document).bind("click",function(e){        
		if($(e.target).closest(".ct-search-form").length == 0 && $(e.target).closest("#ct_search_icon").length == 0){

		$(".ct-search-form").hide();
		$(".ct-search-form").addClass( 'ct-hidden' );


		}

	})
	$ct_search_icon.click( function() {
		var $this_el = $(this),$form = $this_el.siblings( '.ct-search-form' );

		if ( $form.hasClass( 'ct-hidden' ) )
		{
			$form.css( { 'display' : 'block', 'opacity' : 0 } ).animate( { opacity : 1 }, 500 );
		}
		else
		{
			$form.animate( { opacity : 0 }, 500 );
		}

		$form.toggleClass( 'ct-hidden' );
	});
	
	//mobile menu
	ct_duplicate_menu( $('#ct-top-navigation ul.nav'), $('#ct-top-navigation .mobile_nav'), 'mobile_menu', 'ct_mobile_menu' );

	function ct_duplicate_menu( menu, append_to, menu_id, menu_class )
	{
		var $cloned_nav;

		menu.clone().attr('id',menu_id).removeClass().attr('class',menu_class).appendTo( append_to );
		$cloned_nav = append_to.find('> ul');


	   $(function(){
			$(document).on("click",function(e){            
				if($(e.target).closest("#mobile_menu").length == 0 && $(e.target).closest(".mobile_menu_bar").length == 0){

				$(".mobile_nav").removeClass( 'opened' ).addClass( 'closed' );
				$cloned_nav.slideUp( 500 );					
					
				}
			})
		})
		
		append_to.on( 'click', function(){
			
			if ( $(this).hasClass('closed') )
			{
				$(this).removeClass( 'closed' ).addClass( 'opened' );
				$cloned_nav.slideDown( 500 );
			} else {
				$(this).removeClass( 'opened' ).addClass( 'closed' );
				$cloned_nav.slideUp( 500 );
			}
			return false;
		});

		append_to.on( 'click', 'a', function(event){
			event.stopPropagation();
		});
	}


  //fact
	var decimal_places = 0;
	var k_n = 0;
	var decimal_factor = decimal_places === 0 ? 1 : decimal_places * 10;
	
	$('.fact').waypoint(function(down)
		{
			if(k_n == 0)
			{
				$('.fact').each(function () {
					var $this = $(this);
					$({ Counter: 0 }).animate({ Counter: parseInt($(this).data('fact')) },{
						duration: 2000,
						 easing: 'swing',
						step: function ()
						{
							$this.text(Math.ceil(this.Counter));
						}
					});//$({ Counter: 0 }).animate({ Counter: parseInt($(this).data('fact')) },{
				});//$('.fact').each(function () {
				k_n =1;
			}			
			$('.fact').animateNumber({color: 'green'},3000);
		},	
		{
			offset: '70%',
			triggerOnce: true
		}
	);//$('.fact').animateNumber(


	$('.ct_post_img a img').each(function() {
		var width = $(this).width();   
		var height = $(this).height();  
		var needheight = width* 0.66;  
		$(this).css("height", needheight);  
		$(this).css("width", width); 
	});
	
});	

//return top
	window.onscroll=function(){ 
		if (jQuery(document).scrollTop() > 200) 
		{ 
			jQuery(".gotopdiv").css({display:"block"});
		}else{ 
			jQuery(".gotopdiv").css({display:"none"});	
		} 
	}

	function goTop(){
		jQuery('html,body').animate({'scrollTop':0},600);
	}
	//return top end	


