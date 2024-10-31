<?php

function get_events_from_rce( $t_id, $auth, $filterung, $limit ) {

    $filterung = htmlspecialchars_decode( $filterung );

    if ($filterung != '' && substr($filterung, 0 , 1) != '&') {
        $filterung = '&'.$filterung;
    }

    $feedURL = "https://www.rce-event.de/output.php?id=$t_id&mode=xml&auth=$auth&version=200&convertMode=json$filterung&zeilen=$limit";

    $response = wp_remote_get( $feedURL );
    $body = wp_remote_retrieve_body( $response );

    return json_decode($body, true);
}
