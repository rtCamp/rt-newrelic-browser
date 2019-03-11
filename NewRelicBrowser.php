<?php
/**
 * New Relic Browser Plugin developed by rtCamp
 *
 * @package     NewRelicBrowser
 * @author      rtCamp
 * @license     GPL-2.0+
 *
 * Plugin Name: New Relic Browser
 * Plugin URI:  https://www.rtcamp.com
 * Description: New Relic Browser Monitoring plugin.
 * Version:     1.0.5
 * Author:      rtCamp
 * Author URI:  https://www.rtcamp.com
 * License:     MIT
 * License URI: https://opensource.org/licenses/mit-license.html
 * Text Domain: rt-new-relic
 */

if ( ! defined( 'RTP_NEW_RELIC_API_KEY' ) ) {
	define( 'RTP_NEW_RELIC_API_KEY', '6155aee398970036405f017b9f788801ed32f23e208f2d4' );
}

if ( ! defined( 'RTP_NEW_RELIC_API_URL' ) ) {
	define( 'RTP_NEW_RELIC_API_URL', 'https://rpm.newrelic.com/api/v2/partners/857/accounts' );
}

if ( ! defined( 'RTP_NEW_RELIC_BROWSER_URL' ) ) {
	define( 'RTP_NEW_RELIC_BROWSER_URL', 'https://api.newrelic.com/v2/browser_applications.json' );
}

if ( ! defined( 'RTP_PLUGIN_PATH' ) ) {
	define( 'RTP_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! class_exists( 'Rt_Newrelic' ) ) {

	/**
	 * Rt_Newrelic Class Doc Comment
	 *
	 * Rt_Newrelic class used to intialize plugin configuration.
	 *
	 * @category Class
	 * @package  NewRelicBrowser
	 */
	class Rt_Newrelic {

		/**
		 * Init actions.
		 *
		 * @return void
		 */
		public function __construct() {
			add_action( 'wp_head', array( $this, 'insert_relic_script' ), 1 );
			add_action( 'admin_enqueue_scripts', array( $this, 'rtp_relic_load_js' ) );
			add_action( 'admin_menu', array( $this, 'rtp_relic_option_page' ) );
			add_action( 'admin_init', array( $this, 'rtp_relic_register_settings' ) );
		}

		/**
		 * Get file modified time.
		 *
		 * @param string $file_path File path.
		 *
		 * @return mixed
		 */
		public function get_file_modified_time( $file_path ) {
			if ( empty( $file_path ) ) {
				return null;
			}
			return filemtime( $file_path );
		}

		/**
		 * Register relic options settings.
		 *
		 * @return void
		 */
		public function rtp_relic_register_settings() {
			register_setting( 'relic_options_settings', 'relic_options', array( $this, 'rtp_relic_options_validate' ) );
		}

		/**
		 * Add options page
		 *
		 * @return void
		 */
		public function rtp_relic_option_page() {
			$rtp_new_relic_setting_page = add_options_page( esc_html__( 'New Relic Options', 'rt-new-relic' ), esc_html__( 'New Relic Browser', 'rt-new-relic' ), 'manage_options', 'new-relic-browser', array( $this, 'new_relic_options' ) );
			add_action( 'load-' . $rtp_new_relic_setting_page, array( $this, 'rtp_relic_page_help' ) );
		}

		/**
		 * Add help tab
		 *
		 * @return void
		 */
		public function rtp_relic_page_help() {
			$overview_content  = esc_html__( 'This page will allow you to integrate your New Relic Browser app with your website. If you do not have New Relic account, then just select "No" and provide required details. The New Relic script will be loaded automatically in &lt;head&gt; tag of your site without any manual effort.', 'rt-new-relic' );
			$new_relic_content = esc_html__( 'New Relic Browser provides deep visibility and actionable insights into real users experiences on your website. With standard page load timing (sometimes referred to as real user monitoring or RUM), New Relic measures the overall time to load the entire webpage. However, New Relic Browser goes beyond RUM to also help you monitor the performance of individual sessions, AJAX requests, and JavaScript errors—extending the monitoring throughout the entire life cycle of the page.', 'rt-new-relic' );

			$screen = get_current_screen();
			$screen->add_help_tab(
				array(
					'id'      => 'rtp_relic_page_overview_tab',
					'title'   => esc_html__( 'Overview', 'rt-new-relic' ),
					'content' => sprintf( '<p>%s</p>', $overview_content ),
				)
			);
			$screen->add_help_tab(
				array(
					'id'      => 'rtp_relic_page_about_tab',
					'title'   => esc_html__( 'New Relic Browser', 'rt-new-relic' ),
					'content' => sprintf( '<p>%s</p>', $new_relic_content ),
				)
			);
		}

		/**
		 * Add settings page
		 *
		 * @return void
		 */
		public function new_relic_options() {
			include 'admin/new-relic-admin.php';
		}

		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		public function rtp_relic_load_js() {
			wp_enqueue_script( 'rtp_relic_js', plugins_url( '/js/rtp-relic.js', __FILE__ ), array( 'jquery' ), $this->get_file_modified_time( RTP_PLUGIN_PATH . 'js/rtp-relic.js' ), true );
			wp_enqueue_script( 'jquery-ui-dialog' );

			wp_enqueue_style( 'rtp_relic_css', plugins_url( '/css/rtp-new-relic.css', __FILE__ ), array(), $this->get_file_modified_time( RTP_PLUGIN_PATH . 'css/rtp-new-relic.css' ) );
			wp_enqueue_style( 'rtp_relic_ui_css', plugins_url( '/css/jquery-ui.css', __FILE__ ), array(), $this->get_file_modified_time( RTP_PLUGIN_PATH . 'css/jquery-ui.css' ) );
		}

		/**
		 * Validate user form.
		 *
		 * @param array $relic_user_data Relic User Data.
		 *
		 * @return array
		 */
		public function rtp_relic_validate_form( $relic_user_data ) {
			$relic_valid         = true;
			$relic_error_message = '';

			if ( ! empty( $relic_user_data['rtp-relic-form-name'] ) ) {
				$form_name = sanitize_text_field( $relic_user_data['rtp-relic-form-name'] );
			}

			if ( 'rtp-get-browser' === $form_name ) {

				/* get browser list form */
				if ( empty( $relic_user_data['rtp-user-api-key'] ) ) {
					$relic_valid         = false;
					$relic_error_message = esc_html__( 'All fields are required.', 'rt-new-relic' );
				}
			} elseif ( 'rtp-select-browser' === $form_name ) {

				/* select browser application form */
				if ( empty( $relic_user_data['rtp-selected-browser-id'] ) ) {
					$relic_valid         = false;
					$relic_error_message = esc_html__( 'Select atleast one application.', 'rt-new-relic' );
				}
			} elseif ( 'rtp-add-account' === $form_name ) {

				/* add new user account form */
				if ( empty( $relic_user_data['relic-account-email'] )
				|| empty( $relic_user_data['relic-first-name'] )
				|| empty( $relic_user_data['relic-last-name'] )
				|| empty( $relic_user_data['relic-account-name'] ) ) {
					$relic_valid         = false;
					$relic_error_message = esc_html__( 'All fields are required.', 'rt-new-relic' );
				} elseif ( ! filter_var( $relic_user_data['relic-account-email'], FILTER_VALIDATE_EMAIL ) ) {
					$relic_valid         = false;
					$relic_error_message = esc_html__( 'Not a valid email address', 'rt-new-relic' );
				} elseif ( ( ! preg_match( '/^[a-zA-Z ]*$/', $relic_user_data['relic-first-name'] ) )
				|| ( ! preg_match( '/^[a-zA-Z ]*$/', $relic_user_data['relic-last-name'] ) ) ) {
					$relic_valid         = false;
					$relic_error_message = esc_html__( 'Name should contain letters only', 'rt-new-relic' );
				}
			}

			$error_array = array(
				'valid'   => $relic_valid,
				'message' => $relic_error_message,
			);

			return $error_array;
		}

		/**
		 * Create a browser app.
		 *
		 * @param string $app_name name of the app.
		 * @param string $account_api_key api key of the account.
		 *
		 * @return boolean
		 */
		public function rtp_create_browser_app( $app_name, $account_api_key ) {

			$app_data = array(
				browser_application => array(
					'name' => $app_name,
				),
			);

			$app_datastring = wp_json_encode( $app_data );

			/* send request to create a browser app */
			$app_response = wp_remote_post(
				RTP_NEW_RELIC_BROWSER_URL,
				array(
					'timeout' => 100,
					'method'  => 'POST',
					'headers' => array(
						'x-api-key'    => $account_api_key,
						'Content-Type' => 'application/json',
					),
					'body'    => $app_datastring,
				)
			);

			/* get the response code */
			$app_response_code = wp_remote_retrieve_response_code( $app_response );

			$app_json_data = json_decode( $app_response['body'] );

			if ( 201 !== $app_response_code ) {
				add_settings_error( 'relic_options', 'relic_options_error', $app_json_data->error->title, 'error' );
				return false;
			} else {

				/* stored the received browser application data */
				$browser_details_array = array(
					'relic_app_name'   => $app_json_data->browser_application->name,
					'relic_app_key'    => $app_json_data->browser_application->browser_monitoring_key,
					'relic_app_id'     => $app_json_data->browser_application->id,
					'relic_app_script' => $app_json_data->browser_application->loader_script,
				);

				update_option( 'rtp_relic_browser_details', $browser_details_array );
				return true;
			}
		}

		/**
		 * Relic options validate.
		 *
		 * @param string $input input parameter.
		 *
		 * @return string input.
		 */
		public function rtp_relic_options_validate( $input ) {

			if ( empty( $_POST['relic_options_nonce'] )
			|| ! wp_verify_nonce( sanitize_key( $_POST['relic_options_nonce'] ), 'relic_options_nonce_action' ) ) {
				return $input;
			}

			/* validate form if js not worked */
			$rtp_relic_form_validated = $this->rtp_relic_validate_form( $_POST );

			if ( ! $rtp_relic_form_validated['valid'] ) {

				/* form not validated throw an error */
				add_settings_error( 'relic_options', 'relic_options_error', $rtp_relic_form_validated['message'], 'error' );
			} else {

				/* form validated go ahead */
				$option_name             = 'rtp_relic_account_details';
				$app_option_name         = 'rtp_relic_browser_details';
				$browser_app_list_option = 'rtp_relic_browser_list';

				if ( ! empty( $_POST['rtp-relic-form-name'] )
				&& 'rtp-select-browser' === sanitize_text_field( wp_unslash( $_POST['rtp-relic-form-name'] ) ) ) {

					/* user has selected the application so fetch the browser script */
					$rtp_account_details = get_option( $option_name );

					if ( ! empty( $_POST['rtp-selected-browser-id'] ) ) {

						/* In this curl we are filtering browser applications by using browser id */
						$browser_list_response = wp_remote_get(
							RTP_NEW_RELIC_BROWSER_URL . '?filter[ids]=' . sanitize_text_field( wp_unslash( $_POST['rtp-selected-browser-id'] ) ),
							array(
								'timeout' => 100,
								'headers' => array(
									'x-api-key'    => $rtp_account_details['relic_api_key'],
									'Content-Type' => 'application/json',
								),
							)
						);

						$decoded_data = json_decode( $browser_list_response['body'] );
						$browser_list = $decoded_data->browser_applications;

						/* we have filtered the applications so go ahead and select the first application */
						$browser_script = $browser_list[0]->loader_script;

						/* store the browser application details */
						$browser_array = array(
							'relic_app_name'   => $browser_list[0]->name,
							'relic_app_key'    => $browser_list[0]->browser_monitoring_key,
							'relic_app_id'     => $browser_list[0]->id,
							'relic_app_script' => $browser_script,
						);

						update_option( $app_option_name, $browser_array );
						add_settings_error( 'relic_options', 'relic_options_error', esc_html__( 'New Relic Browser App integrated successfully', 'rt-new-relic' ), 'updated' );

						/* browser details saved so delete the browsers list from meta */
						delete_option( $browser_app_list_option );
					}
				} elseif ( 'rtp-create-browser' === $_POST['rtp-relic-form-name'] ) {

					/* We have api key. Create browser application. */
					$rtp_account_details = get_option( $option_name );

					$account_api_key = $rtp_account_details['relic_api_key'];

					if ( ! empty( $_POST['rtp-relic-browser-name'] ) ) {
						$browser_created = $this->rtp_create_browser_app( sanitize_text_field( wp_unslash( $_POST['rtp-relic-browser-name'] ) ), $account_api_key );
					}

					/* store the account details */
					if ( $browser_created ) {
						$account_details_array = array(
							'relic_api_key' => $account_api_key,
						);

						update_option( $option_name, $account_details_array );
						add_settings_error( 'relic_options', 'relic_options_error', esc_html__( 'New Relic Browser App integrated successfully', 'rt-new-relic' ), 'updated' );
					}
				} elseif ( 'rtp-get-browser' === $_POST['rtp-relic-form-name'] ) {

					/* check to see if option already exists */
					$is_get_browser_exists = get_option( 'rtp_relic_browser_list', false );

					if ( ! $is_get_browser_exists ) {

						/* get the list of browser apps */
						if ( ! empty( $_POST['rtp-user-api-key'] ) ) {
							$account_api_key = sanitize_text_field( wp_unslash( $_POST['rtp-user-api-key'] ) );
						}

						$get_browser_response = wp_remote_get(
							RTP_NEW_RELIC_BROWSER_URL,
							array(
								'timeout' => 100,
								'headers' => array(
									'x-api-key'    => $account_api_key,
									'Content-Type' => 'application/json',
								),
							)
						);

						$get_browser_response_code = wp_remote_retrieve_response_code( $get_browser_response );

						$browser_app_list = json_decode( $get_browser_response['body'] );

						if ( 200 === (int) $get_browser_response_code ) {

							if ( ! empty( $browser_app_list->browser_applications ) ) {
								$browser_app_array = array();

								foreach ( $browser_app_list->browser_applications as $key => $app_data ) {
									$app_data_array = array(
										'browser_id'   => $app_data->id,
										'browser_name' => $app_data->name,
									);
									array_push( $browser_app_array, $app_data_array );
								}

								/* store the browsers list */
								update_option( 'rtp_relic_browser_list', $browser_app_array );

								/* store the account details */
								$main_array = array(
									'relic_api_key' => $account_api_key,
								);

								update_option( $option_name, $main_array );
								add_settings_error( 'relic_options', 'relic_options_error', esc_html__( 'Select Browser Application', 'rt-new-relic' ), 'updated' );
							} else {

								/* create a browser app as the account doesn't contain any app */
								if ( ! empty( $_SERVER['SERVER_NAME'] ) ) {
									$browser_created = $this->rtp_create_browser_app( sanitize_text_field( wp_unslash( $_SERVER['SERVER_NAME'] ) ), $account_api_key );
								}

								/* store the account details */
								if ( $browser_created ) {
									$account_details_array = array(
										'relic_api_key' => $account_api_key,
									);

									update_option( $option_name, $account_details_array );
									add_settings_error( 'relic_options', 'relic_options_error', esc_html__( 'New Relic Browser App integrated successfully', 'rt-new-relic' ), 'updated' );
								}
							}
						} else {
							add_settings_error( 'relic_options', 'relic_options_error', $browser_app_list->error->title, 'error' );
						}
					}
				} elseif ( 'rtp-add-account' === $_POST['rtp-relic-form-name'] ) {

					/* check if option already exists */
					$rtp_account_details_duplicate = get_option( $option_name, false );

					if ( ! $rtp_account_details_duplicate ) {

						/* set password to new account */
						$relic_password = wp_generate_password( 8 );

						/**
						 * Always set allow_api_access to true while creating account
						 * start of API 1
						 */

						$relic_account_name  = ( ! empty( $_POST['relic-account-name'] ) ) ? esc_html( sanitize_text_field( wp_unslash( $_POST['relic-account-name'] ) ) ) : '';
						$relic_account_email = ( ! empty( $_POST['relic-account-email'] ) ) ? esc_html( sanitize_email( wp_unslash( $_POST['relic-account-email'] ) ) ) : '';
						$relic_first_name    = ( ! empty( $_POST['relic-first-name'] ) ) ? esc_html( sanitize_text_field( wp_unslash( $_POST['relic-first-name'] ) ) ) : '';
						$relic_last_name     = ( ! empty( $_POST['relic-last-name'] ) ) ? esc_html( sanitize_text_field( wp_unslash( $_POST['relic-last-name'] ) ) ) : '';

						$data = array(
							'account' => array(
								'name'             => $relic_account_name,
								'allow_api_access' => true,
								'testing'          => false,
								'users'            => array(
									array(
										'email'      => $relic_account_email,
										'password'   => $relic_password,
										'first_name' => $relic_first_name,
										'last_name'  => $relic_last_name,
										'role'       => 'admin',
										'owner'      => 'true',
									),
								),
								'subscriptions'    => array(),
							),
						);

						/* for this api data is to be pass in json */
						$datastring = wp_json_encode( $data );

						$create_browser_response = wp_remote_post(
							RTP_NEW_RELIC_API_URL,
							array(
								'timeout' => 100,
								'method'  => 'POST',
								'headers' => array(
									'x-api-key'    => RTP_NEW_RELIC_API_KEY,
									'Content-Type' => 'application/json',
								),
								'body'    => $datastring,
							)
						);

						$create_browser_response_code = wp_remote_retrieve_response_code( $create_browser_response );

						$json_data = json_decode( $create_browser_response['body'] );

						if ( 201 !== (int) $create_browser_response_code ) {
							add_settings_error( 'relic_options', 'relic_options_error', $json_data->error, 'error' );
						} elseif ( ! empty( $json_data->api_key ) ) {

							/* store the received data */
							$main_array = array(
								'relic_account_name' => $json_data->name,
								'relic_api_key'      => $json_data->api_key,
								'relic_id'           => $json_data->id,
								'relic_password'     => $relic_password,
							);

							update_option( $option_name, $main_array );

							/**
							 * End of API 1
							 * Now create the browser app
							 */
							if ( ! empty( $_POST['relic-account-name'] ) ) {
								$relic_account_name = sanitize_text_field( wp_unslash( $_POST['relic-account-name'] ) );
							}

							$browser_created = $this->rtp_create_browser_app( $relic_account_name, $json_data->api_key );

							if ( $browser_created ) {

								/* mail the account details to user */
								if ( ! empty( $_POST['relic-account-email'] ) ) {
									$relic_user_mail = sanitize_email( wp_unslash( $_POST['relic-account-email'] ) );

									$browser_app_details = get_option( 'rtp_relic_browser_details' );

									$relic_subject = 'Welcome to New Relic Browser monitoring of ' . $relic_account_name;

									$relic_headers  = "MIME-Version: 1.0\r\n";
									$relic_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

									ob_start();
									require_once 'admin/new-relic-email-message.php';
									$relic_email_message = ob_get_contents();
									ob_end_clean();

									wp_mail( $relic_user_mail, $relic_subject, $relic_email_message, $relic_headers );
								}
								add_settings_error( 'relic_options', 'relic_options_error', esc_html__( 'New Relic Browser App integrated successfully', 'rt-new-relic' ), 'updated' );
							}
						} else {
							add_settings_error( 'relic_options', 'relic_options_error', esc_html__( 'Error while creating account', 'rt-new-relic' ), 'error' );
						}
					} // end if
				} elseif ( 'rtp-remove-account' === $_POST['rtp-relic-form-name'] ) {

					/* delete the stored data */
					delete_option( $option_name );
					delete_option( $app_option_name );
					delete_option( $browser_app_list_option );

					add_settings_error( 'relic_options', 'relic_options_error', esc_html__( 'New Relic Browser App removed successfully', 'rt-new-relic' ), 'updated' );
				}
			}
			return $input;
		}

		/**
		 * Add script tag in head
		 *
		 * @return void
		 */
		public function insert_relic_script() {

			/* fetched the script stored in metadata and insert in head */
			$app_option_name = 'rtp_relic_browser_details';

			if ( false !== get_option( $app_option_name ) ) {
				$relic_browser_options_data = get_option( $app_option_name );

				$output = $relic_browser_options_data['relic_app_script'];

				$allowed_html = array( 'script' => array() );
				echo wp_kses( $output, $allowed_html );
			}
		}

	}

	$rt_new_relic_main_object = new Rt_Newrelic();
}
