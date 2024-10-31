<?php
/**
 * Plugin Name: RCE Event
 * Author: RCE Medien
 * Author URI: https://www.rce.de/produkte/rce-event/uebersicht/
 * Version: 1.0.4
 * Description: Displays local Events from the RCE Event Database. Displays your Events if you have a contract with RCE Event. Language support for German only.
 * Requires at least: 6.5
 * PHP: 7.4
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if ( !defined( "WPINC" ) ) {
    die;
}

define( "RCE_EVENT_FILE", __FILE__ );

// Initialize the Database and the Settings Menu Page.
include "init.php";

// Include the helper functions.
include 'helper_functions/get_events_from_rce.php';
include 'helper_functions/get_events_by_zip_from_rce.php';
include 'helper_functions/is_assoc.php';
include 'helper_functions/get_detail_link.php';
include 'helper_functions/get_upload_data.php';


// Include the template functions.
include "templates/rows.php";
include "templates/columns.php";

// The central shortcode.
include "shortcode.php";

// Registers the shortcode.
include 'activate.php';

// Enqueue the styles.
wp_enqueue_style( "rce-event-style", plugins_url( "css/rce-event-style.css", __FILE__ ) );
wp_enqueue_style( "rce-event-bootstrap", "https://www.rce-event.de/includes/bootstrap/bootstrap_3.3.5/css/class_rce_bootstrap.css" );
