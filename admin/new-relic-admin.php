<div class="rtp-relic-settings-page">
    <h2>New Relic Browser</h2>
    <?php
    $option_name = 'rtp_relic_account_details';
    $app_option_name = 'rtp_relic_browser_details';
    /*$get_browser_curl = curl_init();
    curl_setopt_array( $get_browser_curl, array( CURLOPT_URL => 'https://staging-api.newrelic.com/v2/browser_applications.json?filter[ids]=73244',
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array( 'x-api-key:f7ee61de49de0060c9cab987808248f48c4ad8965377273', 'Content-Type:application/json' ),
    ) );
    $resp = curl_exec( $get_browser_curl );
    $decoded_data = json_decode( $resp );
    foreach ( $decoded_data->browser_applications as $key => $value ) {
	    print_r( $value->id );
    }
    curl_close( $get_browser_curl );*/
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
    	<form id="rtp-relic-add-account" action="options.php" method="POST" enctype="multipart/form-data">
		<?php
		settings_fields( 'relic_options_settings' );
		?>
    	    <table class="form-table">
    		<tbody>
    		    <tr>
    			<th scope="row"><label for="blogname">Account Name<span class="description"> (required)</span></label></th>
    			<td>
    			    <input type="text" name="relic-account-name" id="relic-account-name" class="regular-text" value="<?php echo $_SERVER['SERVER_NAME']; ?>">
    			    <span id="relic-account-name_error" class="form_error"></span>
    			</td>
    		    </tr>
    		    <tr>
    			<th scope="row"><label for="blogname">Email<span class="description"> (required)</span></label></th>
    			<td>
    			    <input type="text" name="relic-account-email" id="relic-account-email" class="regular-text" >
    			    <span id="relic-account-email_error" class="form_error"></span>
    			</td>
    		    </tr>
    		    <tr>
    			<th scope="row"><label for="blogname">First Name<span class="description"> (required)</span></label></th>
    			<td>
    			    <input type="text" name="relic-first-name" id="relic-first-name" class="regular-text">
    			    <span id="relic-first-name_error" class="form_error"></span>
    			</td>
    		    </tr>
    		    <tr>
    			<th scope="row"><label for="blogname">Last Name<span class="description"> (required)</span></label></th>
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
	if ( get_option( $option_name ) !== false ) {
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


