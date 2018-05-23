(function( $ ){
  'use strict';
   
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

   $( document ).ready(function(){
	   radioDisplay('lazyload','wpfs_lazyload_progressive');
	   radioDisplay('centre','wpfs_centre_disable');
	   radioDisplay('autoplay','wpfs_autoplay_disable');
	   radioDisplay('animation','wpfs_animation_slide');
   });

   $( window ).load(function(){


   });




})( jQuery );
//# sourceMappingURL=maps/fancy-slider-admin.js.map
