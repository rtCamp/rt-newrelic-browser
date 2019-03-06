<?php
/**
 * Rt newrelic browser Uninstall
 *
 * Uninstalling rt-newrelic-browser deletes options.
 *
 * @author      rtCamp
 * @category    Core
 * @package     NewRelicBrowser
 * @version     1.0.5
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$option_name      = 'rtp_relic_account_details';
$app_option_name  = 'rtp_relic_browser_details';
$browser_app_list = 'rtp_relic_browser_list';

if ( ! is_multisite() ) {
	delete_option( $option_name );
	delete_option( $browser_app_list );
	delete_option( $app_option_name );
} else {
	$blog_sites = get_sites();

	$original_blog_id = get_current_blog_id();

	foreach ( $blog_sites as $blog_site ) {
		switch_to_blog( $blog_site->blog_id );
		delete_option( $option_name );
		delete_option( $browser_app_list );
		delete_option( $app_option_name );
	}

	switch_to_blog( $original_blog_id );
}
