=== New Relic Browser by rtCamp ===
Contributors: rtcamp,newrelic,prasad-nevase,rakshit,rohanveer,brennenlb,snehapatil02
Donate Link:  http://rtcamp.com/donate
Tags: new relic browser for wordpress, new relic wordpress, new relic wordpress analytics, new relic wordpress multisite, new relic wordpress mu, javascript monitoring, javascript errors, browser monitoring
Requires at least: 3.0.1
Tested up to: 4.7
Stable tag: 1.0.5
License: MIT
License URI: http://opensource.org/licenses/mit-license.html

This plugin instantly adds free New Relic Browser monitoring to your website.

⚠️ **This plugin will be retired soon.**  
The New Relic PHP Agent now manages all functionalities without requiring this plugin. For continued performance tracking, configure the New Relic PHP Agent.

== Description ==

**New Notice:**  
The New Relic PHP Agent eliminates the need for this plugin by capturing and reporting key metrics directly to the APM dashboard.

= Previous Details (For Reference) =

This plugin instantly adds New Relic’s Browser monitoring javascript to your WordPress site. If you do not have a New Relic account, this plugin allows you to instantly create one. If you already have a New Relic account, you’ll be prompted for your New Relic API key to connect your Browser monitoring with your account. Either way, when you complete the super-simple configuration, the latest New Relic Browser monitoring javascript will be loaded automatically in `<head></head>` tag of your site without any manual effort.

New Relic Browser Lite is free for unlimited pageviews. Every new New Relic account includes a two-week free trial of Browser Pro, which offers [many more features](http://newrelic.com/browser-monitoring/pricing) - usage of Browser Pro beyond the trial period is a [paid upgrade](http://newrelic.com/browser-monitoring/pricing). If you don’t upgrade, your account will automatically revert to Browser Lite, for free, forever!

**Important Links**

* [GitHub](http://github.com/rtcamp/rt-newrelic-browser) - Please mention your wordpress.org username when sending pull requests.

== Installation ==

* Install the plugin from the 'Plugins' section in your dashboard (Go to `Plugins > Add New > Search` and search for 'New Relic Browser by rtCamp').
* Alternatively, you can [download](http://downloads.wordpress.org/plugin/rt-newrelic-browser.zip "Download New Relic Browser by rtCamp") the plugin from the repository. Unzip it and upload it to the plugins folder of your WordPress installation (`wp-content/plugins/` directory of your WordPress installation).
* Activate it through the 'Plugins' section.
* Access the settings page from WordPress backend under `Settings > New Relic Browser`.
* Once the plugin is configured, wait a minute or two, then login to your New Relic account to see Browser monitoring details.

== Frequently Asked Questions ==

= What’s changing with this plugin? =
This plugin is being retired because the New Relic PHP Agent now automatically captures and reports performance metrics directly.

= How do I continue to use New Relic Browser monitoring? =  
Configure the New Relic PHP Agent on your server following New Relic's official [documentation](https://docs.newrelic.com).

= Why is this plugin being retired? =
The New Relic PHP Agent now includes built-in support for browser monitoring, eliminating the need for a separate WordPress plugin. This ensures more efficient and reliable performance tracking at the server level.

= How can I continue to use New Relic Browser monitoring? =
To continue using New Relic Browser monitoring:
1. Configure the New Relic PHP Agent on your server.
2. Follow the official [New Relic Browser monitoring setup guide](https://docs.newrelic.com/docs/browser/new-relic-browser/getting-started/introduction-browser-monitoring/).

= What happens if I keep using this plugin? =
The plugin will no longer receive updates or support. While it may still function temporarily, future changes to WordPress or New Relic may cause compatibility issues.

= Where can I find help for configuring the New Relic PHP Agent? =
You can refer to the official [New Relic PHP Agent documentation](https://docs.newrelic.com/docs/agents/php-agent/) or contact New Relic support for assistance.

== Screenshots ==

1. Select whether or not you have a New Relic account.
2. If you have a New Relic account, then select an existing Browser Application, or create a new one.
3. Enter required details to create a New Relic account.
4. You’ll see this when you are done!

== Changelog ==

= 1.0 =
* First Public Release

= 1.0.1 =
* Added uninstall.php for clean uninstallation of plugin
* Updated plugin core file as per updates in New Relic script updates

= 1.0.2 =
* Replaced cURL request with WordPress HTTP API, thus removing server side package dependency for plugin users.

= 1.0.3 =
* Added constants for URL.
* Updated uninstall.php to support clean uninstallation on WordPress Multisite.

= 1.0.4 =
* Changed testing flag to false.

= 1.0.5 =
* Updated API Key Location in description.

= 1.0.6 =
* Deprecation notice added.
