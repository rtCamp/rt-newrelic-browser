<?php $activation_url = 'https://rpm.newrelic.com/accounts/' . esc_attr( $json_data->id ) . '/browser/' . esc_attr( $browser_app_details['relic_app_id'] ); ?>
<div style="font-size:15px;margin-top:20px;border:1px solid #666;padding:20px 50px;">
	<p><h1 style="color:#666;font-weight: 300;margin-top: 10px;">Welcome to New Relic Browser</h1></p>
	<p>Thanks for adding New Relic Browser monitoring of <?php echo esc_html( $relic_account_name ); ?>. Please <a href="<?php echo esc_url( $activation_url ); ?>">login</a> to your New Relic account and change your temporary password below:</p>
	<div style="font-size:15px;margin:20px 0;display: inline-block;border:1px solid #666;padding: 15px;">
		<p style="margin:2px">
			<span>Email : </span>
			<span><a href="mailto:<?php echo esc_html( $relic_user_mail ); ?>" target="_blank"><?php echo esc_html( $relic_user_mail ); ?></a></span>
		</p>
		<p style="margin:2px">
			<span>Password : </span>
			<span><?php echo esc_html( $relic_password ); ?></span>
		</p>
	</div>
	<p style="margin-top:20px">
	For help on getting started with New Relic Browser, please visit <a href="https://docs.newrelic.com/docs/browser/new-relic-browser">https://docs.newrelic.com/docs/browser/new-relic-browser</a> and <a href="https://discuss.newrelic.com/c/browser">https://discuss.newrelic.com/c/browser</a>
	</p>
	<p style="margin-top:20px">
	Be sure to start your 14-day free trial of New Relic Browser Pro by clicking the "Activate" button on <a href="<?php echo esc_url( $activation_url ); ?>"><?php echo esc_html( $activation_url ); ?></a> After 15 days, if you choose to not upgrade to New Relic Browser Pro, your account will switch to Browser Lite, which you can use for free, forever!
	</p>
</div>
