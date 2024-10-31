<?php

function get_events_by_zip_from_rce( $zip_code, $limit ) {

    $zip = str_replace( " ", "", $zip_code );

    $feedURL = "https://www.rce-event.de/output.php?id=1195&mode=xml&auth=e6274857&version=200&convertMode=json&zeilen=$limit&plz=$zip";

    $response = wp_remote_get( $feedURL );
    $body = wp_remote_retrieve_body( $response );

    return json_decode($body, true);
}
