/**
 * Page editor: media picker for the two landing photo slots.
 *
 * @package Cerrajeros_Parla
 */
( function ( $ ) {
	'use strict';

	$( function () {
		$( '.cpc-photo-field' ).each( function () {
			var field = $( this );
			var input = field.find( 'input[type="hidden"]' );
			var preview = field.find( '.cpc-photo-preview' );
			var remove = field.find( '.cpc-photo-remove' );
			var frame;

			field.on( 'click', '.cpc-photo-select', function ( event ) {
				event.preventDefault();

				if ( ! frame ) {
					frame = wp.media( {
						title: window.cpcPhotos.title,
						button: { text: window.cpcPhotos.button },
						library: { type: 'image' },
						multiple: false
					} );

					frame.on( 'select', function () {
						var image = frame.state().get( 'selection' ).first().toJSON();
						var url = image.sizes && image.sizes.medium ? image.sizes.medium.url : image.url;

						input.val( image.id );
						preview.empty().append(
							$( '<img>', { src: url, alt: '' } ).css( { maxWidth: '100%', height: 'auto', display: 'block', marginBottom: '6px' } )
						);
						remove.prop( 'hidden', false );
					} );
				}

				frame.open();
			} );

			field.on( 'click', '.cpc-photo-remove', function ( event ) {
				event.preventDefault();
				input.val( '' );
				preview.empty();
				remove.prop( 'hidden', true );
			} );
		} );
	} );
}( jQuery ) );
