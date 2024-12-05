![alt text](https://plugins.svn.wordpress.org/rt-newrelic-browser//assets/banner-772x250.jpg)

# New Relic Browser by rtCamp #

> **⚠️ This plugin will be retired soon.**  
> New Relic PHP Agent now handles PHP Agent Integration Performance tracking directly on the server. The New Relic PHP Agent captures and reports key metrics automatically to the New Relic APM dashboard, eliminating the need for this plugin.

---

* **Contributors:** [rtcamp] (http://profiles.wordpress.org/rtcamp), [newrelic](http://profiles.wordpress.org/newrelic), [prasad-nevase](http://profiles.wordpress.org/prasad-nevase), [rakshit](http://profiles.wordpress.org/rakshit), [rohanveer](http://profiles.wordpress.org/rohanveer), [brennenlb](http://profiles.wordpress.org/brennenlb), [snehapatil02](https://profiles.wordpress.org/snehapatil02/)

* **License:** [GPL v2 or later](http://opensource.org/licenses/mit-license.html)

* **Donate Link:**  [rtCamp Donate](http://rtcamp.com/donate)

This plugin instantly adds free New Relic Browser monitoring to your website.

## Description

[New Relic Browser](http://newrelic.com/browser-monitoring) provides deep visibility and actionable insights into real users' experiences on your website.

### **New Notice:**
With the New Relic PHP Agent's updated functionality, monitoring is now automatic, requiring no custom plugin. We encourage users to switch to server-level integration for better performance and efficiency.

#### Previous Details (For Reference)

This plugin instantly adds New Relic’s Browser monitoring javascript to your WordPress site. If you do not have a New Relic account, this plugin allows you to instantly create one. If you already have a New Relic account, you’ll be prompted for your New Relic API key to connect your Browser monitoring with your account. Either way, when you complete the super-simple configuration, the latest New Relic Browser monitoring javascript will be loaded automatically in `<head></head>` tag of your site without any manual effort.

New Relic Browser Lite is free for unlimited pageviews. Every new New Relic account includes a two-week free trial of Browser Pro, which offers [many more features](http://newrelic.com/browser-monitoring/pricing) - usage of Browser Pro beyond the trial period is a [paid upgrade](http://newrelic.com/browser-monitoring/pricing). If you don’t upgrade, your account will automatically revert to Browser Lite, for free, forever!

### Frequently Asked Questions

### Q: What’s changing with this plugin? ###  
A: This plugin is being retired because the New Relic PHP Agent now automatically captures and reports performance metrics directly.

### Q: How do I continue to use New Relic Browser monitoring? ###  
A: Configure the New Relic PHP Agent on your server following New Relic's official [documentation](https://docs.newrelic.com).

### Q: Why is this plugin being retired? ###
A: The New Relic PHP Agent now includes built-in support for browser monitoring, eliminating the need for a separate WordPress plugin. This ensures more efficient and reliable performance tracking at the server level.

### Q: How can I continue to use New Relic Browser monitoring? ###
A: To continue using New Relic Browser monitoring:
1. Configure the New Relic PHP Agent on your server.
2. Follow the official [New Relic Browser monitoring setup guide](https://docs.newrelic.com/docs/browser/new-relic-browser/getting-started/introduction-browser-monitoring/).

### Q: What happens if I keep using this plugin? ###
A: The plugin will no longer receive updates or support. While it may still function temporarily, future changes to WordPress or New Relic may cause compatibility issues.

### Q: Where can I find help for configuring the New Relic PHP Agent? ###
A: You can refer to the official [New Relic PHP Agent documentation](https://docs.newrelic.com/docs/agents/php-agent/) or contact New Relic support for assistance.

## Changelog ##

#### 1.0 ####
* First Public Release

#### 1.0.1 ####
* Added uninstall.php for clean uninstallation of plugin
* Updated plugin core file as per updates in New Relic script updates

#### 1.0.2 ####
* Replaced cURL request with WordPress HTTP API, thus removing server side package dependency for plugin users.

#### 1.0.3 ####
* Added constants for URL.
* Updated uninstall.php to support clean uninstallation on WordPress Multisite.

#### 1.0.4 ####
* Changed testing flag to false.

#### 1.0.5 ####
* Updated API Key Location in description.

#### 1.0.6  
* **New:** Deprecation notice added.

<a href="https://rtcamp.com/"><img src="https://rtcamp.com/wp-content/uploads/2019/04/github-banner@2x.png" alt="Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions"></a>
