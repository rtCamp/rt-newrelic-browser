<?php
/**
 * New Relic Admin Settings form.
 *
 * @package NewRelicBrowser
 */

?>
<div class="rtp-relic-settings-page wrap">
	<h2><?php esc_html_e( 'New Relic Browser', 'rt-new-relic' ); ?></h2>

	<?php
	global $current_user;

	$option_name      = 'rtp_relic_account_details';
	$app_option_name  = 'rtp_relic_browser_details';
	$browser_app_list = 'rtp_relic_browser_list';

	$relic_options_data         = get_option( $option_name );
	$relic_browser_options_data = get_option( $app_option_name );
	$relic_browser_app_list     = get_option( $browser_app_list );

	if ( ( false === $relic_options_data
	|| false === $relic_browser_options_data ) ) {

		if ( false !== $relic_browser_app_list ) {
			$new_relic_form = 'hidden';
		} else {
			$new_relic_form = '';
			?>

			<h3><?php esc_html_e( 'Do you have a New Relic account?', 'rt-new-relic' ); ?></h3>
			<div class="rtp-relic-checkbox">
				<input type="radio" class="rtp-relic-radio" name="rtp-relic-account-avaiable" id="rtp-relic-yes" value="yes" />
				<label for="rtp-relic-yes"><?php esc_html_e( 'Yes', 'rt-new-relic' ); ?></label>
			</div>
			<div class="rtp-relic-checkbox">
				<input type="radio" class="rtp-relic-radio" name="rtp-relic-account-avaiable" id="rtp-relic-no" value="no" />
				<label for="rtp-relic-no"><?php esc_html_e( 'No', 'rt-new-relic' ); ?></label>
			</div>

			<?php
		}
		?>

		<div class="rtp-relic-form">

			<?php
			if ( false !== $relic_browser_app_list
			&& false === $relic_browser_options_data ) {
				?>

				<h3><?php esc_html_e( 'Select Browser Application', 'rt-new-relic' ); ?> :</h3>
				<div id="select-browser-app-checkbox">

					<?php
					settings_fields( 'relic_options_settings' );
					foreach ( $relic_browser_app_list as $key => $relic_browser_data ) {
						?>

						<input type="radio" class="rtp-select-browser-radio" value="<?php echo esc_attr( $relic_browser_data['browser_id'] ); ?>" name="rtp-relic-browser-id" id="browser_<?php echo esc_attr( $relic_browser_data['browser_id'] ); ?>">
						<label for="browser_<?php echo esc_attr( $relic_browser_data['browser_id'] ); ?>"><?php echo esc_html( $relic_browser_data['browser_name'] ); ?></label><br>

						<?php
					}
					?>

					<p style="padding-left:70px;"><b>- <?php esc_html_e( 'OR', 'rt-new-relic' ); ?> -</b></p>
					<input type="radio" class="rtp-select-browser-radio" id="create-browser-radio" value="create-account" name="rtp-relic-browser-id" >
					<label for="create-browser-radio"><?php esc_html_e( 'Create a new application', 'rt-new-relic' ); ?></label>
				</div>
				<form id="rtp-relic-create-browser" class="<?php echo esc_attr( $new_relic_form ); ?>" action="options.php" method="POST" enctype="multipart/form-data">

					<?php
					wp_nonce_field( 'relic_options_nonce_action', 'relic_options_nonce' );
					settings_fields( 'relic_options_settings' );
					?>

					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label for="rtp-relic-browser-name"><?php esc_html_e( 'Application Name', 'rt-new-relic' ); ?><span class="description"> (<?php esc_html_e( 'required', 'rt-new-relic' ); ?>)</span></label></th>
								<td>
									<input type="text" name="rtp-relic-browser-name" id="rtp-relic-browser-name" class="regular-text">
									<span id="rtp-relic-browser-name_error" class="form_error"></span>
								</td>
							</tr>
						</tbody>
					</table>
					<input type="hidden" value="rtp-create-browser" name="rtp-relic-form-name">
					<p class="submit">
						<input class="button-primary" type="submit" value="<?php esc_attr_e( 'Submit', 'rt-new-relic' ); ?>" name="rtp-relic-get-browser-submit">
					</p>
				</form>
				<form id="rtp-relic-select-browser" class="<?php echo esc_attr( $new_relic_form ); ?>" action="options.php" method="POST" enctype="multipart/form-data">

					<?php
					wp_nonce_field( 'relic_options_nonce_action', 'relic_options_nonce' );
					settings_fields( 'relic_options_settings' );
					?>

					<p class="submit">
						<input type="hidden" value="rtp-select-browser" name="rtp-relic-form-name">
						<input type="hidden" name="rtp-selected-browser-id" value="" id="rtp-selected-browser-id">
						<input class="button-primary" type="submit" value="<?php esc_attr_e( 'Submit', 'rt-new-relic' ); ?>" name="rtp-relic-select-browser-submit">
					</p>
				</form>

				<?php
			}
			?>

			<form id="rtp-relic-get-browser" class="<?php echo esc_attr( $new_relic_form ); ?>" action="options.php" method="POST" enctype="multipart/form-data">

				<?php
				wp_nonce_field( 'relic_options_nonce_action', 'relic_options_nonce' );
				settings_fields( 'relic_options_settings' );
				?>

				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="rtp-user-api-key"><?php esc_html_e( 'Account API Key', 'rt-new-relic' ); ?><span class="description"> (<?php esc_html_e( 'required', 'rt-new-relic' ); ?>)</span></label></th>
							<td>
								<input type="text" name="rtp-user-api-key" id="rtp-user-api-key" class="regular-text">
								<p class="description"><?php esc_html_e( 'API key can be found in the "API keys" section of "Account settings".', 'rt-new-relic' ); ?></p>
								<span id="rtp-user-api-key_error" class="form_error"></span>
							</td>
						</tr>
					</tbody></table>
				<input type="hidden" value="rtp-get-browser" name="rtp-relic-form-name">
				<p class="submit">
					<input class="button-primary" type="submit" value="<?php esc_attr_e( 'Submit', 'rt-new-relic' ); ?>" name="rtp-relic-get-browser-submit">
				</p>
			</form>
			<form id="rtp-relic-add-account" class="<?php echo esc_attr( $new_relic_form ); ?>" action="options.php" method="POST" enctype="multipart/form-data">

				<?php
				wp_nonce_field( 'relic_options_nonce_action', 'relic_options_nonce' );
				settings_fields( 'relic_options_settings' );

				$site_url = site_url();

				$disallowed = array( 'http://', 'https://' );
				foreach ( $disallowed as $d ) {
					if ( strpos( $site_url, $d ) === 0 ) {
						$site_url = str_replace( $d, '', $site_url );
					}
				}
				?>

				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="relic-account-name"><?php esc_html_e( 'Account Name', 'rt-new-relic' ); ?><span class="description"> (<?php esc_html_e( 'required', 'rt-new-relic' ); ?>)</span></label></th>
							<td>
								<input type="text" name="relic-account-name" id="relic-account-name" class="regular-text" value="<?php echo esc_attr( $site_url ); ?>">
								<span id="relic-account-name_error" class="form_error"></span>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="relic-account-email"><?php esc_html_e( 'Email', 'rt-new-relic' ); ?><span class="description"> (<?php esc_html_e( 'required', 'rt-new-relic' ); ?>)</span></label></th>
							<td>
								<input type="text" name="relic-account-email" id="relic-account-email" class="regular-text" value="<?php echo esc_attr( $current_user->user_email ); ?>">
								<span id="relic-account-email_error" class="form_error"></span>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="relic-first-name"><?php esc_html_e( 'First Name', 'rt-new-relic' ); ?><span class="description"> (<?php esc_html_e( 'required', 'rt-new-relic' ); ?>)</span></label></th>
							<td>
								<input type="text" name="relic-first-name" id="relic-first-name" class="regular-text" value="<?php echo esc_attr( $current_user->user_firstname ); ?>">
								<span id="relic-first-name_error" class="form_error"></span>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="relic-last-name"><?php esc_html_e( 'Last Name', 'rt-new-relic' ); ?><span class="description"> (<?php esc_html_e( 'required', 'rt-new-relic' ); ?>)</span></label></th>
							<td>
								<input type="text" name="relic-last-name" id="relic-last-name" class="regular-text" value="<?php echo esc_attr( $current_user->user_lastname ); ?>">
								<span id="relic-last-name_error" class="form_error"></span>
							</td>
						</tr>
					</tbody></table>
				<input type="hidden" value="rtp-add-account" name="rtp-relic-form-name">
				<p class="submit">
					<input class="button-primary" type="submit" value="<?php esc_attr_e( 'Submit', 'rt-new-relic' ); ?>" name="rtp-relic-form-submit">
				</p>
			</form> 
		</div>

		<?php
	} else {

		/* If browser list is present show the list */
		if ( false !== $relic_options_data
		&& false !== $relic_browser_options_data ) {

			if ( array_key_exists( 'relic_id', $relic_options_data ) ) {
				$relic_login_url = 'https://rpm.newrelic.com/accounts/' . $relic_options_data['relic_id'] . '/browser/' . $relic_browser_options_data['relic_app_id'];

				$relic_email_check_msg = esc_html__( ' Check your email for more details.', 'rt-new-relic' );
			} else {
				$relic_login_url = 'https://rpm.newrelic.com/login';

				$relic_email_check_msg = '';
			}
			?>

			<div class="rtp-relic-settings-page-details">
				<h3><?php esc_html_e( 'Account details', 'rt-new-relic' ); ?>:</h3>
				<p><b><a href="<?php echo esc_url( $relic_login_url ); ?>" target="_blank"><?php esc_html_e( 'Login to your New Relic Account.', 'rt-new-relic' ); ?></a></b><?php echo esc_html( $relic_email_check_msg ); ?></p>
				<p><b><?php esc_html_e( 'Account API Key', 'rt-new-relic' ); ?></b> = <?php echo esc_html( $relic_options_data['relic_api_key'] ); ?></p>
				<p><b><?php esc_html_e( 'Browser App Name', 'rt-new-relic' ); ?></b> = <?php echo esc_html( $relic_browser_options_data['relic_app_name'] ); ?></p>
				<p><b><?php esc_html_e( 'Browser Monitoring Key', 'rt-new-relic' ); ?></b> = <?php echo esc_html( $relic_browser_options_data['relic_app_key'] ); ?></p>
				<p><b><?php esc_html_e( 'Browser App ID', 'rt-new-relic' ); ?></b> = <?php echo esc_html( $relic_browser_options_data['relic_app_id'] ); ?></p>
			</div>
			<div id="rtp-dialog-confirm" title="<?php esc_html_e( 'Remove Account', 'rt-new-relic' ); ?>" class="hidden">
				<p><b><?php esc_html_e( 'Are you sure?', 'rt-new-relic' ); ?></b></p>
			</div>
			<form id="rtp-relic-remove-account" action="options.php" method="POST" enctype="multipart/form-data">

				<?php
				wp_nonce_field( 'relic_options_nonce_action', 'relic_options_nonce' );
				settings_fields( 'relic_options_settings' );
				?>

				<input type="hidden" value="<?php echo esc_attr( $relic_options_data['relic_id'] ); ?>" name="rtp-relic-account-id">
				<input type="hidden" value="rtp-remove-account" name="rtp-relic-form-name">
				<p class="submit">
					<input class="button-primary" type="submit" value="<?php esc_attr_e( 'Remove', 'rt-new-relic' ); ?>" name="rtp-remove-account-submit" id="rtp-remove-account-submit">
				</p>
			</form>

			<?php
		}
	}
	?>

</div>
