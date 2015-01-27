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
global $wpdb;
$option_name = 'rtp_relic_account_details';
$app_option_name = 'rtp_relic_browser_details';
$browser_app_list = 'rtp_relic_browser_list';
if ( ! is_multisite() ) {
	delete_option( $option_name );
	delete_option( $browser_app_list );
	delete_option( $app_option_name );
} else {
	$blog_ids = $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" );
	$original_blog_id = get_current_blog_id();

	foreach ( $blog_ids as $blog_id ) {
		switch_to_blog( $blog_id );
		delete_option( $option_name );
		delete_option( $browser_app_list );
		delete_option( $app_option_name );
	}

	switch_to_blog( $original_blog_id );
}
