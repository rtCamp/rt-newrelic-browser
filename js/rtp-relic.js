/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery( document ).ready( function( ) {

	jQuery( '.rtp-relic-radio' ).click( function() {

		var selectedValue = jQuery( this ).val();
		if ( 'no' == selectedValue ) {
			jQuery( '#rtp-relic-add-account' ).css( 'display', 'block' );
		} else {
			jQuery( '#rtp-relic-add-account' ).css( 'display', 'none' );
		}

	} );

	jQuery( "#rtp-relic-add-account" ).submit( function() {
		var is_valid = validate_form( "#rtp-relic-add-account" );
		if ( !is_valid ) {
			event.preventDefault();
		}
		else {

		}
	} );

	function validate_form( formid ) {
		var form_data = jQuery( formid ).serializeArray( );
		var valid = true;
		for ( var i = 0; i < form_data.length; i++ ) {
			var element = form_data[i];
			if ( element.name == 'relic-account-name' || element.name == 'relic-account-email' || element.name == 'relic-first-name' || element.name == 'relic-last-name' ) {
				if ( element.value == '' ) {
					valid = false;
					jQuery( formid + ' #' + element.name + "_error" ).text( 'Cannot be blank' );
					jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'block' );
				} else if ( element.name == 'relic-first-name' || element.name == 'relic-last-name' ) {
					if ( !element.value.match( /^[A-Za-z]+$/ ) ) {
						jQuery( formid + ' #' + element.name + "_error" ).text( 'Should contain characters only.' );
						jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'block' );
					} else {
						jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'none' );
					}
				} else if ( element.name == 'relic-account-email' ) {
					var email_valid_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					if ( !email_valid_regex.test(element.value) ) {
						jQuery( formid + ' #' + element.name + "_error" ).text( 'Not a valid email address.' );
						jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'block' );
					} else {
						jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'none' );
					}

				} else {
					jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'none' );
				}
			}
		}
		return valid;
	}

} );


