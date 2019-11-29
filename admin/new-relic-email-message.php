<?php $activation_url = sprintf( 'https://rpm.newrelic.com/accounts/%u/browser/%s', esc_attr( $json_data->id ), esc_attr( $browser_app_details['relic_app_id'] ) ); ?>
<div style="font-size:15px;margin-top:20px;border:1px solid #666;padding:20px 50px;">
	<p><h1 style="color:#666;font-weight: 300;margin-top: 10px;"><?php esc_html_e( 'Welcome to New Relic Browser', 'rt-new-relic' ); ?></h1></p>
	<p><?php esc_html_e( 'Thanks for adding New Relic Browser monitoring of', 'rt-new-relic' ); ?> <?php echo esc_html( $relic_account_name ); ?>. <?php esc_html_e( 'Please', 'rt-new-relic' ); ?> <a href="<?php echo esc_url( $activation_url ); ?>"><?php esc_html_e( 'login', 'rt-new-relic' ); ?></a> <?php esc_html_e( 'to your New Relic account and change your temporary password below', 'rt-new-relic' ); ?>:</p>
	<div style="font-size:15px;margin:20px 0;display: inline-block;border:1px solid #666;padding: 15px;">
		<p style="margin:2px">
			<span><?php esc_html_e( 'Email', 'rt-new-relic' ); ?> : </span>
			<span><a href="mailto:<?php echo esc_html( $relic_user_mail ); ?>" target="_blank"><?php echo esc_html( $relic_user_mail ); ?></a></span>
		</p>
		<p style="margin:2px">
			<span><?php esc_html_e( 'Password', 'rt-new-relic' ); ?> : </span>
			<span><?php echo esc_html( $relic_password ); ?></span>
		</p>
	</div>
	<p style="margin-top:20px">
	<?php esc_html_e( 'For help on getting started with New Relic Browser, please visit', 'rt-new-relic' ); ?> <a href="https://docs.newrelic.com/docs/browser/new-relic-browser">https://docs.newrelic.com/docs/browser/new-relic-browser</a> <?php esc_html_e( 'and', 'rt-new-relic' ); ?> <a href="https://discuss.newrelic.com/c/browser">https://discuss.newrelic.com/c/browser</a>
	</p>
	<p style="margin-top:20px">
	<?php esc_html_e( 'Be sure to start your 14-day free trial of New Relic Browser Pro by clicking the "Activate" button on', 'rt-new-relic' ); ?> <a href="<?php echo esc_url( $activation_url ); ?>"><?php echo esc_html( $activation_url ); ?></a> <?php esc_html_e( 'After 15 days, if you choose to not upgrade to New Relic Browser Pro, your account will switch to Browser Lite, which you can use for free, forever!', 'rt-new-relic' ); ?>
	</p>
</div>
