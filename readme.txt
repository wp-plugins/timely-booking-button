=== Timely Booking Widgets ===

Contributors: TimelySystem

Tags: timely, appointments, booking, online booking, online bookings, booking system, scheduling, appointment scheduling, appointment system, calendar, calendar bookings, appointment booking
Requires at least: 3.0.1

Tested up to: 3.4

Stable tag: trunk

License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html



Adds a "Booking Widget" and/or a "Book Now" button for the Timely appointment management system to your WordPress site. More info: www.gettimely.com.



== Installation ==


1. Upload the `timely-booking-button` directory to the `/wp-content/plugins/` directory

2. Activate the plugin through the 'Plugins' menu in WordPress

3. Add the widget using one of the following methods. Note use only one method using multiple methods will cause conflicts with the widgets.

* Via the Appearance > Widgets admin menu

* Place <?php do_action('tbb_widget_output()'); ?> for the Booking Button or <?php do_action('tbw_widget_output()'); ?> for the Booking Widget in your templates

* To display the Timely Booking Button Use the shortcode [tbb-button] in your pages or posts

* To display the Timely Booking Widget Use the shortcode [tbw-widget] in your pages or posts

== Frequently Asked Questions ==

**What is Timely?**

Timely is an easy to use great looking appointment management system. It works on any device anywhere providing flexible scheduling for business owners and easy online booking for customers. More info: www.gettimely.com

**What is the Timely Booking Button?**

The Timely booking button allows you to display a button on your website labelled "Book Now". When the button is clicked the Timely online booking process opens for customers to make new bookings.

**What is the Timely Booking Widget?**

The Timely booking widget allows you to embed the Timely online booking process directly into your website. Customers can make new bookings without leaving your website.

== Screenshots ==

1. Administration settings

2. Booking button

3. Booking widget

== Changelog ==


= 0.1 = 
* First version of the plugin allows validated entry of account name and selection of button style
= 0.2 = 
* Updated path to Admin preview button image
= 0.3 =
* Added booking widget to the plugin. This allows adding of iframe based online booking process via widget or embedded shortcode
