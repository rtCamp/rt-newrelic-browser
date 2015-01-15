<div class="rtp-relic-settings-page wrap">
    <h2>New Relic Browser</h2>
	<?php
	$option_name = 'rtp_relic_account_details';
	$app_option_name = 'rtp_relic_browser_details';
	$browser_app_list = 'rtp_relic_browser_list';
	global $current_user;
	if ( ( false == get_option( $option_name ) || false == get_option( $app_option_name ) ) ) {
		if ( false !== get_option( $browser_app_list ) ) {
			$new_relic_form = 'hidden';
		} else {
			$new_relic_form = '';
			?>
			<h3>Do you have a New Relic account?</h3>
			<div class="rtp-relic-checkbox">
				<input type="radio" class="rtp-relic-radio" name="rtp-relic-account-avaiable" id="rtp-relic-yes" value="yes" />
				<label for="rtp-relic-yes">Yes</label>
			</div>
			<div class="rtp-relic-checkbox">
				<input type="radio" class="rtp-relic-radio" name="rtp-relic-account-avaiable" id="rtp-relic-no" value="no" />
				<label for="rtp-relic-no">No</label>
			</div>    
			<?php
		}
		?>
		<div class="rtp-relic-form">
			<?php
			if ( false !== get_option( $browser_app_list ) && false == get_option( $app_option_name ) ) {
				$relic_browser_list = get_option( $browser_app_list );
				?>
				<h3>Select Browser Application :</h3>
				<div id="select-browser-app-checkbox">
					<?php
					settings_fields( 'relic_options_settings' );
					foreach ( $relic_browser_list as $key => $relic_browser_data ) {
						?>
						<input type="radio" class="rtp-select-browser-radio" value="<?php echo $relic_browser_data['browser_id']; ?>" name="rtp-relic-browser-id" id="browser_<?php echo $relic_browser_data['browser_id']; ?>">
						<label for="browser_<?php echo $relic_browser_data['browser_id']; ?>"><?php echo $relic_browser_data['browser_name']; ?></label><br>
						<?php
					}
					?>
					<p style="padding-left:70px;"><b>- OR -</b></p>
					<input type="radio" class="rtp-select-browser-radio" id="create-browser-radio" value="create-account" name="rtp-relic-browser-id" >
					<label for="create-browser-radio">Create a new application</label>
				</div>
				<form id="rtp-relic-create-browser" class="<?php echo $new_relic_form; ?>" action="options.php" method="POST" enctype="multipart/form-data">
					<?php
					settings_fields( 'relic_options_settings' );
					?>
					<table class="form-table">
						<tbody>
							<tr>
								<th scope="row"><label for="rtp-relic-browser-name">Application Name<span class="description"> (required)</span></label></th>
								<td>
									<input type="text" name="rtp-relic-browser-name" id="rtp-relic-browser-name" class="regular-text">
									<span id="rtp-relic-browser-name_error" class="form_error"></span>
								</td>
							</tr>
						</tbody></table>
					<input type="hidden" value="rtp-create-browser" name="rtp-relic-form-name">
					<p class="submit">
						<input class="button-primary" type="submit" value="Submit" name="rtp-relic-get-browser-submit">
					</p>
				</form>
				<form id="rtp-relic-select-browser" class="<?php echo $new_relic_form; ?>" action="options.php" method="POST" enctype="multipart/form-data">
					<?php
					settings_fields( 'relic_options_settings' );
					?>
					<p class="submit">
						<input type="hidden" value="rtp-select-browser" name="rtp-relic-form-name">
						<input type="hidden" name="rtp-selected-browser-id" value="" id="rtp-selected-browser-id">
						<input class="button-primary" type="submit" value="Select" name="rtp-relic-select-browser-submit">
					</p>
				</form>
			<?php }
			?>
			<form id="rtp-relic-get-browser" class="<?php echo $new_relic_form; ?>" action="options.php" method="POST" enctype="multipart/form-data">
				<?php
				settings_fields( 'relic_options_settings' );
				?>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="rtp-user-api-key">Account API Key<span class="description"> (required)</span></label></th>
							<td>
								<input type="text" name="rtp-user-api-key" id="rtp-user-api-key" class="regular-text">
								<p class="description">API key can be found in the "Data sharing" section of "Account settings".</p>
								<span id="rtp-user-api-key_error" class="form_error"></span>
							</td>
						</tr>
					</tbody></table>
				<input type="hidden" value="rtp-get-browser" name="rtp-relic-form-name">
				<p class="submit">
					<input class="button-primary" type="submit" value="Submit" name="rtp-relic-get-browser-submit">
				</p>
			</form>
			<form id="rtp-relic-add-account" class="<?php echo $new_relic_form; ?>" action="options.php" method="POST" enctype="multipart/form-data">
				<?php
				settings_fields( 'relic_options_settings' );
				?>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row"><label for="relic-account-name">Account Name<span class="description"> (required)</span></label></th>
							<td>
								<input type="text" name="relic-account-name" id="relic-account-name" class="regular-text" value="<?php echo $_SERVER['SERVER_NAME']; ?>">
								<span id="relic-account-name_error" class="form_error"></span>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="relic-account-email">Email<span class="description"> (required)</span></label></th>
							<td>
								<input type="text" name="relic-account-email" id="relic-account-email" class="regular-text" value="<?php echo $current_user->user_email ?>">
								<span id="relic-account-email_error" class="form_error"></span>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="relic-first-name">First Name<span class="description"> (required)</span></label></th>
							<td>
								<input type="text" name="relic-first-name" id="relic-first-name" class="regular-text" value="<?php echo $current_user->user_firstname ?>">
								<span id="relic-first-name_error" class="form_error"></span>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="relic-last-name">Last Name<span class="description"> (required)</span></label></th>
							<td>
								<input type="text" name="relic-last-name" id="relic-last-name" class="regular-text" value="<?php echo $current_user->user_lastname ?>">
								<span id="relic-last-name_error" class="form_error"></span>
							</td>
						</tr>
					</tbody></table>
				<input type="hidden" value="rtp-add-account" name="rtp-relic-form-name">
				<p class="submit">
					<input class="button-primary" type="submit" value="Submit" name="rtp-relic-form-submit">
				</p>
			</form> 
		</div>
	<?php } else { ?>
		<?php
		/* If browser list is present show the list */
		if ( false !== get_option( $option_name ) && false !== get_option( $app_option_name ) ) {
			$relic_options_data = get_option( $option_name );
			$relic_browser_options_data = get_option( $app_option_name );
			if ( array_key_exists( 'relic_id', $relic_options_data ) ) {
				$relic_login_url = 'https://rpm.newrelic.com/accounts/'.$relic_options_data['relic_id'].'/browser/'.$relic_browser_options_data['relic_app_id'];
				$relic_email_check_msg = __( ' Check your email for more details.','rt-new-relic' );
			} else {
				$relic_login_url = 'https://rpm.newrelic.com/login';
				$relic_email_check_msg = '';
			}
			?>
			<div class="rtp-relic-settings-page-details">
				<h3>Account details:</h3>
				<?php ?>
				<p><b><a href="<?php echo $relic_login_url ?>" target="_blank">Login to your New Relic Account.</a></b><?php echo $relic_email_check_msg; ?></p>
				<p> <b>Account API Key</b> = <?php echo $relic_options_data['relic_api_key']; ?></p>
				<p> <b>Browser App Name</b> = <?php echo $relic_browser_options_data['relic_app_name']; ?></p>
				<p> <b>Browser Monitoring Key</b> = <?php echo $relic_browser_options_data['relic_app_key']; ?></p>
				<p> <b>Browser App ID</b> = <?php echo $relic_browser_options_data['relic_app_id']; ?></p>
			</div>
			<div id="rtp-dialog-confirm" title="Remove Account" class="hidden">
				<p><b>Are you sure?</b></p>
			</div>
			<form id="rtp-relic-remove-account" action="options.php" method="POST" enctype="multipart/form-data">
				<?php
				settings_fields( 'relic_options_settings' );
				?>
				<input type="hidden" value="<?php echo $relic_options_data['relic_id']; ?>" name="rtp-relic-account-id">
				<input type="hidden" value="rtp-remove-account" name="rtp-relic-form-name">
				<p class="submit">
					<input class="button-primary" type="submit" value="Remove" name="rtp-remove-account-submit" id="rtp-remove-account-submit">
				</p>
			</form>
			<?php
		}
}
	?>
</div>
