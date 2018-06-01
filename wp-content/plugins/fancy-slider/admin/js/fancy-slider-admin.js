(function( $ ){
  'use strict';
   
   /* hide or show sub input area when a specific item is selected */
   function radioDisplay(_class,_id){
	   var prop = $('ul.'+ _class + ' ' +'#'+_id).prop('checked');
	   var $target = $('ul.'+ _class + ' li').slice(2);
	   if (prop === true){
		   $target.hide();
	   }
	   $('ul.'+ _class + ' li:nth-child(1)').find('input').click(function(){
		    $target.show();
	   });
	   $('ul.'+ _class + ' li:nth-child(2)').find('input').click(function(){
		    $target.hide();
	   });
   }

   /* check a number input area valid or not */
   function numberChk(){

		var $inputs = $('input[type="number"]');
		var pat = /^\d+$/;
		$inputs.each(function(index) {
			$(this).before('<span class="invalid">invalid figure</span>');	 
		});

	    $('.wrap form').on('submit',function(e){
		   	$inputs.each(function(index) {
		   		var $this = $(this);
		   		var target = $this.val();
		   		if (! pat.test( target ) ){
		   			$this.focus().prev().addClass('activate');
				    e.preventDefault();
				    return false;
			   	}
		   	});		   	
	    });

	   	$('.wrap form').on('click keydown',function(){
		    $('span.activate ').blur().removeClass('activate');
		});
   }
   $( document ).ready(function(){
	   radioDisplay('lazyload','wpfs_lazyload_progressive');
	   radioDisplay('centre','wpfs_centre_disable');
	   radioDisplay('autoplay','wpfs_autoplay_disable');
	   numberChk();   
   });

   $( window ).load(function(){


   });




})( jQuery );
//# sourceMappingURL=maps/fancy-slider-admin.js.map
