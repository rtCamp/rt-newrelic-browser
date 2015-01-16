<?php

/**
 * WooCommerce Uninstall
 *
 * Uninstalling WooCommerce deletes user roles, options, tables, and pages.
 *
 * @author 		WooThemes
 * @category 	Core
 * @package 	WooCommerce/Uninstaller
 * @version     2.1.0
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

global $wpdb, $wp_roles;

$option_name = 'rtp_relic_account_details';
$app_option_name = 'rtp_relic_browser_details';
$browser_app_list = 'rtp_relic_browser_list';

if ( get_option( $option_name, false ) ) {
	delete_option( $option_name );
	delete_site_option( $option_name );
}
if ( get_option( $app_option_name, false ) ) {
	delete_option( $app_option_name );
	delete_site_option( $app_option_name );
}
if ( get_option( $browser_app_list, false ) ) {
	delete_option( $browser_app_list );
	delete_site_option( $browser_app_list );
}
