jQuery( function( $ ) {
	// Handle on click per gradient.
	$( '#wppp-gradients' ).on( 'click', '.wppp-gradient', function( e ) {
		$button = $( this );
		if ( $button.hasClass( 'unchecked' ) ) {
			$button.removeClass( 'unchecked' ).addClass( 'checked' );
		} else {
			$button.removeClass( 'checked' ).addClass( 'unchecked' );
		}
	} );
	// Handle select all anchor.
	$( '#wppp-gradients' ).on( 'click', '#wppp-gradient-select-all', function( e ) {
		e.preventDefault();
		$( '.wppp-gradient' ).removeClass( 'unchecked' ).addClass( 'checked' );
	} );
	// Handle deselect all anchor.
	$( '#wppp-gradients' ).on( 'click', '#wppp-gradient-deselect-all', function( e ) {
		e.preventDefault();
		$( '.wppp-gradient' ).removeClass( 'checked' ).addClass( 'unchecked' );
	} );
} );