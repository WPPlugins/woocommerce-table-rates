==== WooCommerce - Table Rates ====
Contributors: rpletcher
Tags: woocommerce, fixed rates, shipping, domestic shipping, international shipping, table rate, cart total
Requires at least: 3.0
Tested up to: 4.5
Stable tag: 1.6.0
Donate link: https://wp-ronin.com/donate/
License: GPLv2 or later

Table Rates for WooCommerce allows you to setup a number of different price points for your store.

== Description ==

This plugin will allow you to create two tables of shipping rates ( one for domestic orders and one for international ).  These rates are based on the total order price in your cart.  You can specify which countries are local and which countries you want to be able to use this shipping method. 

I have also created a premium version of this plugin that ill allow you to choose any number of countries and allows a greater level of customization.  Find it at <a href="https://wp-ronin.com/downloads/woocommerce-premium-table-rate-shipping/">wp-ronin.com/downloads/woocommerce-premium-table-rate-shipping/</a>

= A big thanks to our Translators =
* Swedish: Emil @ <a href="http://profiles.wordpress.org/mr3k/" target="_blank">mr3k</a>
* French: Ben @ <a href="http://bpepermans.com" target="_blank">bpepermans.com</a>
* Spanish: Irving R

If you have an interest in translating this plugin please let me know.

== Installation ==

1. Install the WooCommerce Table Rates plugin
2. Activate the plugin
3. Go to the WooCommerce Settings Page 
4. Access Shipping Tab
5. Select "Table Rates"
6. Check the Enable/Disable Checkbox.
7. Enter the settings that you would like you to use

== Frequently Asked Questions ==
None at this time

== Changelog ==
= 1.6.0 =
* FIX: Adding columns to the table for shipping.

= 1.5.0 =
* ADD: Activation functions

= 1.4.0 =
* FIX: Issue with scripts not loading in admin page

= 1.3.0 =
* UPDATE: File Structure updated to singleton structure
* UPDATE: Table Creation and layout
* UPDATE: Admin Panel Functionality

= 1.2.2 =
* FIX: Error when discount is not left empty
* FIX: Fix multi sort error when saving table rates
* ADD: Ability to choose how to handle values over your max value

= 1.2.1 =
* FIX: Updated the way that the shipping caluclation works so that it works with different types of products.
* FIX: Formatted Code
* ADD: Ability to determine if the shipping caluclation will include the discounts or not.

= 1.2 =
* ADD: Swedish Translation
* ADD: French Translation
* ADD: Spanish Translation
* FIX: Updated some CSS issues with the new Wordpress version
* FIX: Corrected a spelling error

= 1.1.7 =
* FIX: Fixing issue to check for the minimum value you can use for this shipping method

= 1.1.6 =
* FIX: Fixing issue when a local country is not set.

= 1.1.5 =
* FIX: Attempted fix in calculating the shipping again.  This time I think I have it.

= 1.1.4 =
* FIX: Another error in calculating the shipping was fixed.

= 1.1.3 =
* FIX: Made the highest shipping value entered show for orders over the highest value in the table.

* FIX: Fixed issue with calling in_array() when calculating shipping.

= 1.1.2 =
* FIX: Fixed issue that prevented the International table rates from updating.

= 1.1.1 =
* FIX: Updated calculation of shipping to not include the any Virtual products.

* FIX: Spelling Errors.

= 1.1 =
* NEW: Sorts each table separately in order of smallest to largest based off of minimum cart total.

* NEW: Swap Min and Max amounts if the Max value is less than the Min Value.

= 1.0 =
* Initial Release

== Screenshots ==
1. What your customer will see -> screenshot-1.png
2. Set the options of who can use your table rates -> screenshot-2.png
3. Select the country that uses Domestic Rates and International -> screenshot-3.png
4. Customize the rates that you offer -> screenshot-4.png