(function( $ ){
  'use strict';

   function checkboxDisplay(_class,_id){
	   var $target = $('ul.'+ _class + ' li:last');
   	   var prop = $('ul.'+ _class + ' ' +'#'+_id).prop('checked');
   	   if (prop === true){
		   $target.show();
	   }else{
		   	$target.hide();
	   }
	   $('ul.'+ _class + ' li:nth-child(1)').find('input').click(function(){
		    $target.toggle();
	   });
   }
   
   function radioDisplay(_class,_id){
	   var prop = $('ul.'+ _class + ' ' +'#'+_id).prop('checked');
	   var $target = $('ul.'+ _class + ' li').slice(2);
	   if (prop === true){
		   $target.hide();
	   }
	   $('ul.'+ _class + ' li:nth-child(1)').find('input').click(function(){
		    $target.hide();
	   });
	   $('ul.'+ _class + ' li:nth-child(2)').find('input').click(function(){
		    $target.show();
	   });
   }

   $( document ).ready(function(){
	   radioDisplay('lazyload','wpfs_lazyload_progressive');
	   checkboxDisplay('centre','wpfs_centre_centre');
	   checkboxDisplay('autoplay','wpfs_autoplay_autoplay');
	   radioDisplay('animation','wpfs_animation_slide');
   });

   $( window ).load(function(){


   });




})( jQuery );
//# sourceMappingURL=maps/fancy-slider-admin.js.map
