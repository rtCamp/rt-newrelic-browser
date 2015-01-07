/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

jQuery( document ).ready( function( ) {



	jQuery( '#rtp-remove-account-submit' ).click( function( e ) {
		jQuery( "#rtp-dialog-confirm" ).dialog( {
			resizable: false,
			dialogClass: "no-close",
			height: 150,
			modal: true,
			buttons: {
				"Yes": function() {
					jQuery( '#rtp-relic-remove-account' ).submit();
				},
				Cancel: function() {
					jQuery( this ).dialog( "close" );
					e.preventDefault();
				}
			}
		} );
		e.preventDefault();
	} );

	jQuery( '.rtp-relic-radio' ).click( function() {

		var selectedValue = jQuery( this ).val();
		if ( 'no' === selectedValue ) {
			jQuery( '#rtp-relic-get-browser' ).css( 'display', 'none' );
			jQuery( '#rtp-relic-add-account' ).css( 'display', 'block' );
		} else {
			jQuery( '#rtp-relic-get-browser' ).css( 'display', 'block' );
			jQuery( '#rtp-relic-add-account' ).css( 'display', 'none' );
		}

	} );

	jQuery( '.rtp-select-browser-radio' ).click( function() {

		var selectedValue = jQuery( this ).val();
		if ( 'create-account' === selectedValue ) {
			jQuery( '#rtp-relic-create-browser' ).css( 'display', 'block' );
			jQuery( '#rtp-relic-select-browser' ).css( 'display', 'none' );
		} else {
			jQuery( '#rtp-selected-browser-id' ).val( selectedValue );
			jQuery( '#rtp-relic-create-browser' ).css( 'display', 'none' );
			jQuery( '#rtp-relic-select-browser' ).css( 'display', 'block' );
		}

	} );

	jQuery( "#rtp-relic-add-account" ).submit( function( e ) {
		var is_valid = validate_form( "#rtp-relic-add-account" );
		if ( !is_valid ) {
			e.preventDefault();
		}
	} );

	jQuery( "#rtp-relic-get-browser" ).submit( function( e ) {
		var is_valid = validate_form( "#rtp-relic-get-browser" );
		if ( !is_valid ) {
			e.preventDefault();
		}
	} );
	
	jQuery( "#rtp-relic-create-browser" ).submit( function( e ) {
		var is_valid = validate_form( "#rtp-relic-create-browser" );
		if ( !is_valid ) {
			e.preventDefault();
		}
	} );

	function validate_form( formid ) {
		var form_data = jQuery( formid ).serializeArray( );
		var valid = true;
		for ( var i = 0; i < form_data.length; i++ ) {
			var element = form_data[i];
			if ( element.name === 'relic-account-name' || element.name === 'relic-account-email' || element.name === 'relic-first-name' || element.name === 'relic-last-name' || element.name === 'rtp-user-api-id' || element.name === 'rtp-user-api-key' || element.name === 'rtp-relic-browser-name' ) {
				if ( element.value === '' ) {
					valid = false;
					jQuery( formid + ' #' + element.name + "_error" ).text( 'Cannot be blank' );
					jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'block' );
				} else if ( element.name === 'relic-first-name' || element.name === 'relic-last-name' ) {
					if ( !element.value.match( /^[A-Za-z]+$/ ) ) {
						valid = false;
						jQuery( formid + ' #' + element.name + "_error" ).text( 'Should contain characters only.' );
						jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'block' );
					} else {
						jQuery( formid + ' #' + element.name + "_error" ).css( 'display', 'none' );
					}
				} else if ( element.name === 'relic-account-email' ) {
					var email_valid_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
					if ( !email_valid_regex.test( element.value ) ) {
						valid = false;
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


