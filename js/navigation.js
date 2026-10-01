/**
 * Mobile navigation toggle (no dependencies).
 *
 * @package Cerrajeros_Parla
 */
( function () {
	'use strict';

	var toggle = document.querySelector( '.nav-toggle' );
	var nav = document.getElementById( 'site-navigation' );

	if ( ! toggle || ! nav ) {
		return;
	}

	function setOpen( open ) {
		toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		nav.classList.toggle( 'is-open', open );
	}

	toggle.addEventListener( 'click', function () {
		setOpen( 'true' !== toggle.getAttribute( 'aria-expanded' ) );
	} );

	document.addEventListener( 'keydown', function ( event ) {
		if ( 'Escape' === event.key && nav.classList.contains( 'is-open' ) ) {
			setOpen( false );
			toggle.focus();
		}
	} );

	// Close the panel after choosing an in-page anchor such as #servicios.
	nav.addEventListener( 'click', function ( event ) {
		if ( event.target.closest( 'a[href*="#"]' ) ) {
			setOpen( false );
		}
	} );
}() );
