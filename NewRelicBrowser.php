<?php

/**
 * Plugin Name: New Relic Browser
 * Plugin URI: http://www.rtcamp.com
 * Description: New Relic Browser Monitoring plugin.
 * Version: 1.0
 * Author: rtCamp
 * Author URI: http://www.rtcamp.com
 * License:  rt-newrelic-browser
 */
function rtp_relic_register_settings() {
    register_setting( 'relic_options_settings', 'relic_options', 'rtp_relic_options_validate' );
}

function rtp_relic_option_page() {
    $rtp_new_relic_setting_page = add_options_page( 'New Relic Options', 'New Relic Browser', 'manage_options', 'new-relic-browser', 'new_relic_options' );
    add_action( 'load-' . $rtp_new_relic_setting_page, 'rtp_relic_page_help' );
}

function rtp_relic_page_help() {
    $screen = get_current_screen();

    $screen->add_help_tab( array(
	'id' => 'rtp_relic_page_overview_tab',
	'title' => __( 'Overview' ),
	'content' => '<p>' . __( 'This page will allow you to integrate your New Relic Browser app with your website. 
				If do not have New Relic account, then just select "No" and provide required details. The New Relic script will be loaded automatically in <head> tag of your site without any manual effort.
				' ) . '</p>',
				) );

    $screen->add_help_tab( array(
	'id' => 'rtp_relic_page_about_tab',
	'title' => __( 'New Relic Browser' ),
	'content' => '<p>' . __( 'New Relic Browser provides deep visibility and actionable insights into real users experiences on your website. With standard page load timing (sometimes referred to as real user monitoring or RUM), New Relic measures the overall time to load the entire webpage. However, New Relic Browser goes beyond RUM to also help you monitor the performance of individual sessions, AJAX requests, and JavaScript errors—extending the monitoring throughout the entire life cycle of the page.' ) . '</p>',
    ) );
}

function new_relic_options() {
    include('admin/new-relic-admin.php');
}

function rtp_relic_load_js() {
    wp_enqueue_script( 'rtp_relic_js', plugins_url( '/js/rtp-relic.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_style( 'rtp_relic_css', plugins_url( '/css/rtp-new-relic.css', __FILE__ ) );
}

/**
 * validate user form
 * @param type $relic_user_data array
 * @return array
 */
function rtp_relic_validate_form( $relic_user_data ) {
    $relic_valid = TRUE;
    $relic_error_message = "";

    if ( ( "" == $relic_user_data['relic-account-email']) || ( "" == $relic_user_data['relic-first-name']) || ( "" == $relic_user_data['relic-last-name']) || ( "" == $relic_user_data['relic-account-name']) ) {
	$relic_valid = FALSE;
	$relic_error_message = "All fields are required.";
    } else if ( !filter_var( $relic_user_data['relic-account-email'], FILTER_VALIDATE_EMAIL ) ) {
	$relic_valid = FALSE;
	$relic_error_message = "Not a valid email address";
    } else if ( (!preg_match( "/^[a-zA-Z ]*$/", $relic_user_data['relic-first-name'] )) || (!preg_match( "/^[a-zA-Z ]*$/", $relic_user_data['relic-last-name'] )) ) {
	$relic_valid = FALSE;
	$relic_error_message = "Name should contain letters only";
    }

    $error_array = array(
	'valid' => $relic_valid,
	'message' => $relic_error_message
    );

    return $error_array;
}

function rtp_relic_options_validate( $input ) {

    /* validate form if js not worked */

    $rtp_relic_form_validated = rtp_relic_validate_form( $_POST );

    if ( !$rtp_relic_form_validated['valid'] ) {
	add_settings_error( 'relic_options', 'relic_options_error', $rtp_relic_form_validated['message'] );
    } else {

	/* set password to new account */
	$relic_password = wp_generate_password( 6 );
	$option_name = 'rtp_relic_account_details';
	$app_option_name = 'rtp_relic_browser_details';

	/* if the account data is already stored then delete the account */

	if ( get_option( $option_name ) !== false ) {
	    /* curl request to remove account */
	    if ( isset( $_POST['rtp-relic-account-id'] ) ) {
		$account_id = $_POST['rtp-relic-account-id'];
		$delete_curl = curl_init();
		curl_setopt_array( $delete_curl, array( CURLOPT_URL => 'https://staging.newrelic.com/api/v2/partners/191/accounts/' . $account_id,
		    CURLOPT_CUSTOMREQUEST => "DELETE",
		    CURLOPT_HTTPHEADER => array( 'x-api-key:0118286cc87aca4eef6723d567a94b3916167fc4cf91177', 'Content-Type:application/json' )
		) );
		curl_exec( $delete_curl );
		curl_close( $delete_curl );

		/* delete the stored data */

		delete_option( $option_name );
		delete_option( $app_option_name );
	    }
	} else {

	    /* always set allow_api_access to true while creating account
	      start of API 1 */

	    $data = array(
		account => array(
		    "name" => $_POST['relic-account-name'],
		    "allow_api_access" => true,
		    "users" => array(
			array(
			    "email" => $_POST['relic-account-email'],
			    "password" => $relic_password,
			    "first_name" => $_POST['relic-first-name'],
			    "last_name" => $_POST['relic-last-name'],
			    "role" => "admin",
			    "owner" => "true"
			)
		    )
		)
	    );

	    /* for this api data is to be pass in json */

	    $dataString = json_encode( $data );
	    $curl = curl_init();
	    curl_setopt_array( $curl, array( CURLOPT_URL => 'https://staging.newrelic.com/api/v2/partners/191/accounts',
		CURLOPT_POST => 1,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_HTTPHEADER => array( 'x-api-key:0118286cc87aca4eef6723d567a94b3916167fc4cf91177', 'Content-Type:application/json' ),
		CURLOPT_POSTFIELDS => $dataString
	    ) );

	    $response = curl_exec( $curl );
	    curl_close( $curl );
	    $json_data = json_decode( $response );
	    if ( $json_data->error != '' ) {
		add_settings_error( 'relic_options', 'relic_options_error', $json_data->error );
	    } else {

		/* mail the details to user */
		$relic_headers = "MIME-Version: 1.0\r\n";
		$relic_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$relic_email_message = '<div style="font-size:15px;margin-top:20px;border:1px solid #6bffb2;border-radius:10px;padding:20px"><p>Your New Relic account details are given below :</p>
	    <div style="font-size:15px;margin-top:20px;">
					<p style="margin:2px">
						<span>Email : </span>
						<span>' . $_POST['relic-account-email'] . '</span>
					</p>
					<p style="margin:2px">
						<span>Password : </span>
						<span>' . $relic_password . '</span>
					</p>
				</div>
				<p style="margin-top:10px">
					<a href="https://dev-login.newrelic.com/">Click here</a> to login to your New Relic account.
				</p></div>';
		wp_mail( $_POST['relic-account-email'], 'New Relic Details', $relic_email_message, $relic_headers );

		/* store the received data */

		$deprecated = null;
		$autoload = 'no';
		$main_array = array(
		    'relic_account_name' => $json_data->name,
		    'relic_api_key' => $json_data->api_key,
		    'relic_id' => $json_data->id,
		    'relic_password' => $relic_password
		);
		add_option( $option_name, $main_array, $deprecated, $autoload );

		/* end of API 1
		  Now create the browser app */

		$app_data = array(
		    browser_application => array(
			"name" => $_POST['relic-account-name']
		    )
		);
		$app_dataString = json_encode( $app_data );
		$app_curl = curl_init();
		curl_setopt_array( $app_curl, array( CURLOPT_URL => 'https://staging-api.newrelic.com/v2/browser_applications.json',
		    CURLOPT_POST => 1,
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_HTTPHEADER => array( 'x-api-key:' . $json_data->api_key, 'Content-Type:application/json' ),
		    CURLOPT_POSTFIELDS => $app_dataString
		) );

		$app_response = curl_exec( $app_curl );
		curl_close( $app_curl );
		$app_json_data = json_decode( $app_response );
		if ( empty( $app_json_data->browser_application->loader_script ) ) {
		    add_settings_error( 'relic_options', 'relic_options_error', $app_json_data->error->title );
		} else {

		    /* stored the received data */

		    $deprecated = null;
		    $autoload = 'no';
		    $main_array = array(
			'relic_app_name' => $app_json_data->browser_application->name,
			'relic_app_key' => $app_json_data->browser_application->browser_monitoring_key,
			'relic_app_id' => $app_json_data->browser_application->id,
			'relic_app_script' => $app_json_data->browser_application->loader_script
		    );
		    add_option( $app_option_name, $main_array, $deprecated, $autoload );
		}
	    }
	}
    }
    return $input;
}

function insert_relic_script() {

    /* fetched the script stored in metadata and insert in head */

    $app_option_name = 'rtp_relic_browser_details';
    if ( get_option( $app_option_name ) !== false ) {
	$relic_browser_options_data = get_option( $app_option_name );
	$output = $relic_browser_options_data['relic_app_script'];
	echo $output;
    }
}

add_action( 'wp_head', 'insert_relic_script', 1 );
add_action( 'admin_enqueue_scripts', 'rtp_relic_load_js' );
add_action( 'admin_menu', 'rtp_relic_option_page' );
add_action( 'admin_init', 'rtp_relic_register_settings' );


