=== RCE Event ===
Contributors: rcemedien
Tags: events, api
Requires at least: 4.6
Tested up to: 6.5
Stable tag: 1.0.4
Requires PHP: 7.4 or higher
License: GPLv2 or later

Displays local Events from the RCE Event Database. Displays your Events if you have a contract with RCE Event. Language support for German only.

== Description ==
This Plugins gives easy and customizable access to the RCE Event Database for clients. Display your Events securely and customizable on your WordPress Page. If you are not (yet) a client of RCE Event, you can display local Events near you free of charge. Language support for German only.

== Installation ==
For the setup of the Plugin you will need your Template ID and Auth Code from your Contract with RCE. Additionally, you will need the base URL for the detail link to single Events. Add these informations in the settings page of this plugin (\"RCE Event\" in your admin panel).

If you are not a client of RCE Event, add up to three (3) postal codes in the settings page.

The Plugin will automatically connect to the correct API Endpoint. Call the Shortcode [rce_event] to display events on your Site.
Allowed Parameters:
layout: columns | rows -> Determines the layout of the displayed Events (Default is columns)
limit: (integer up to 20) -> Determines how many Events will be displayed
filterung: u=X -> u is for user and X for the ID of an existing user
