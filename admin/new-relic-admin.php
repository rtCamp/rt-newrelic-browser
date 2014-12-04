<div class="rtp-relic-settings-page">
    <h2>New Relic Browser</h2>
    <?php
    $option_name = 'rtp_relic_account_details';
    $app_option_name = 'rtp_relic_browser_details';
    $browser_app_list = 'rtp_relic_browser_list';
    global $current_user;
    if ( get_option( $option_name ) == false ) {
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
        <div class="rtp-relic-form">
    	<form id="rtp-relic-get-browser" action="options.php" method="POST" enctype="multipart/form-data">
		<?php
		settings_fields( 'relic_options_settings' );
		?>
    	    <table class="form-table">
    		<tbody>
    		    <tr>
    			<th scope="row"><label for="rtp-user-api-key">Account API Key<span class="description"> (required)</span></label></th>
    			<td>
    			    <input type="text" name="rtp-user-api-key" id="rtp-user-api-key" class="regular-text">
    			    <span id="rtp-user-api-key_error" class="form_error"></span>
    			</td>
    		    </tr>
    		    <tr>
    			<th scope="row"><label for="rtp-user-api-id">Account API ID<span class="description"> (required)</span></label></th>
    			<td>
    			    <input type="text" name="rtp-user-api-id" id="rtp-user-api-id" class="regular-text">
    			    <span id="rtp-user-api-id_error" class="form_error"></span>
    			</td>
    		    </tr>
    		</tbody></table>
    	    <p class="submit">
    		<input class="button-primary" type="submit" value="Submit" name="rtp-relic-get-browser-submit">
    	    </p>
    	</form>
    	<form id="rtp-relic-add-account" action="options.php" method="POST" enctype="multipart/form-data">
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
    			    <input type="text" name="relic-first-name" id="relic-first-name" class="regular-text">
    			    <span id="relic-first-name_error" class="form_error"></span>
    			</td>
    		    </tr>
    		    <tr>
    			<th scope="row"><label for="relic-last-name">Last Name<span class="description"> (required)</span></label></th>
    			<td>
    			    <input type="text" name="relic-last-name" id="relic-last-name" class="regular-text">
    			    <span id="relic-last-name_error" class="form_error"></span>
    			</td>
    		    </tr>
    		</tbody></table>
    	    <p class="submit">
    		<input class="button-primary" type="submit" value="Submit" name="rtp-relic-form-submit">
    	    </p>
    	</form>
        </div>
    <?php } else { ?>
	<?php
	/* If browser list is present show the list */
	if ( get_option( $browser_app_list ) !== false && get_option( $app_option_name ) == false ) {
	    $relic_browser_list = get_option( $browser_app_list );
	    ?>
	    <h3>Select Browser Application :</h3>
	    <form id="rtp-relic-select-browser" action="options.php" method="POST" enctype="multipart/form-data">
		<?php
		settings_fields( 'relic_options_settings' );
		foreach ( $relic_browser_list as $key => $relic_browser_data ) {
		    ?>
	    	<input type="radio" value="<?php echo $relic_browser_data['browser_id']; ?>" name="rtp-relic-browser-id" id="browser_<?php echo $relic_browser_data['browser_id']; ?>">
	    	<label for="browser_<?php echo $relic_browser_data['browser_id']; ?>"><?php echo $relic_browser_data['browser_name']; ?></label><br>
		    <?php
		}
		?>
		<p class="submit">
		    <input class="button-primary" type="submit" value="Select" name="rtp-relic-select-browser-submit">
		</p>
	    </form>
	    <?php
	} else if ( get_option( $option_name ) !== false && get_option( $app_option_name ) !== false ) {
	    $relic_options_data = get_option( $option_name );
	    $relic_browser_options_data = get_option( $app_option_name );
	    ?>
	    <div class="rtp-relic-settings-page-details">
		<h3>Account details:</h3>
		<?php ?>
		<p> <b>Account API Key</b> = <?php echo $relic_options_data['relic_api_key']; ?></p>	
		<p> <b>Account API ID</b> = <?php echo $relic_options_data['relic_id']; ?></p>
		<p> <b>Browser API Key</b> = <?php echo $relic_browser_options_data['relic_app_key']; ?></p>	
		<p> <b>Browser API ID</b> = <?php echo $relic_browser_options_data['relic_app_id']; ?></p>
	    </div>
	    <form id="rtp-relic-remove-account" action="options.php" method="POST" enctype="multipart/form-data">
		<?php
		settings_fields( 'relic_options_settings' );
		?>
		<input type="hidden" value="<?php echo $relic_options_data['relic_id']; ?>" name="rtp-relic-account-id">
		<p class="submit">
		    <input class="button-primary" type="submit" value="Remove">
		</p>
	    </form>
	    <?php
	}
    }
    ?>
</div>


