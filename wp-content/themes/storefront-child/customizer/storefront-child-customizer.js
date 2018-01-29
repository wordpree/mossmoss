( function( $ ) {

	// Update the site title in real time...
	wp.customize( 'brief_info_background_image', function( value ) {
		value.bind( function( newval ) {
			$( '.brief-intro .section-title').css('background-image','url('+newval+')');
		} );
	} );
	wp.customize( 'social_media_bg', function( value ) {
		value.bind( function( newval ) {
			$( '.social-media .media-container').css('background-image','url('+newval+')');
		} );
	} );
	wp.customize( 'social_media_title', function( value ) {
		value.bind( function( newval ) {
			$( '.media-container h2' ).html( newval );
		} );
	} );

})(jQuery);

