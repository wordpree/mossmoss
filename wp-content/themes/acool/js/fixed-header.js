jQuery(document).ready(function($){
/*fix fixed header padding*/

	//$(".ct_header_class").removeClass( 'fixed' );//addClass( 'fixed' );

	$(window).scroll(function(){
		if($(window).scrollTop()<200)
		{
		   $(".ct_header_class").removeClass( 'fixed' );
		   $(".ct_header_class").height("80px"); 
		}
		else
		{			  
			$("#ct_header").addClass( 'fixed' );  
			$(".ct_header_class").height("70px"); 
		}
	});

});