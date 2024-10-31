<?php

/**
 * Create a single Row Element populated with data.
 * @param $event the event array with the data to display
 * @param $now
 * @param $eventDate the Date of the Event
 * @param $eventStartTime the start Date of the Event
 * @param $detailLink the link to the event site
 * @param $no_img_url the link to the "no_image" file
 * @param $uploadData th upload data
 */
function rce_event_layout_rows($event, $now, $eventDate, $eventStartTime, $detailLink, $no_img_url, $uploadData) {

    $func_output = "";


    $func_output .= '<div class="row eventlist_row"><div class="col-md-12 col-sm-12 col-xs-12">';

    // = START IMAGE
    $func_output .= '<div class="row"><div class="col-md-2 col-sm-2 hidden-xs">';

    if (isset($uploadData) && is_array($uploadData) && count($uploadData) > 0) {
        $func_output .= '<a href="' . esc_url( $detailLink ) . '" title="' . esc_attr( htmlspecialchars($event['NAME'], ENT_QUOTES, 'utf-8') ) . '"><img src="' . esc_url( 'https://www.rce-event.de/includes/rcethumb/phpThumb.php?q=85&w=200&h=200&zc=C&src=' . $uploadData['URL'] ) . '" class="img-responsive" /></a>';
    } else {
        $func_output .= '<a href="' . esc_url( $detailLink ) . '" title="' . esc_attr( htmlspecialchars($event['NAME'], ENT_QUOTES, 'utf-8') ) . '"><img src="' . esc_url( $no_img_url ) . '" class="img-responsive" /></a>';
    }

    $func_output .= '</div>';
    // = END IMAGE

    // = START INFO
    $func_output .= '<div class="col-md-10 col-sm-10 col-xs-12 text-col">';

    // the title.
    $func_output .= '<h5 class="title"><a href="' . esc_url( $detailLink ) . '" title="' . esc_attr( htmlspecialchars($event['NAME'], ENT_QUOTES, 'utf-8') ) . '">' . esc_html( $event['NAME'] ) . '</a></h5>';

    // the description
    if ( isset( $event['DESCRIPTION'] ) && !is_array( $event['DESCRIPTION'] ) && trim( $event['DESCRIPTION'] ) != '' ) {
        $func_output .= '<div class="row"><div class="col-xs-12"><div class="event-desc">' . esc_html( mb_strimwidth( trim( strip_tags( $event['DESCRIPTION'] ) ), 0, 200, '...') ) . '</div></div></div>';
    }

    // the detailed info
    if ( $now->format('Y') == $eventDate->format('Y') ) {
        $outputDate = $eventDate->format('d.m.');
    } else {
        $outputDate = $eventDate->format('d.m.Y');
    }

    $func_output .= '<div class="row"><div class="col-md-12 col-sm-12 col-xs-12 eventinfo_container"><ul class="eventinfo">';
    $func_output .= '<li><div class="eventinfo-title">Datum</div><div class="eventinfo-value">' . esc_html( $outputDate ) . '</div></li>';

    if ($eventStartTime->format('H:i:s') != '00:00:00') {
        $func_output .= '<li><div class="eventinfo-title">Beginn</div><div class="eventinfo-value">' . esc_html( $eventStartTime->format('H:i') ) . '</div></li>';
    }
    if ( isset($event['LOCATION']['CITY']) && (string)$event['LOCATION']['CITY'] != '' ) {
        $func_output .= '<li><div class="eventinfo-title">Ort</div><div class="eventinfo-value">' . esc_html( $event['LOCATION']['CITY'] ) . '</div></li>';
    }

    if ( isset( $event['LOCATION']['NAME'] )) {
        $location = "";
        if ( is_array( $event['LOCATION']['NAME'] ) ) {
            if ( isset( $event['LOCATION']['NAME'][0] ) && !empty($event['LOCATION']['NAME'][0]) ) {
                $location = $event['LOCATION']['NAME'][0];
            }
        } elseif (!empty($event['LOCATION']['NAME'])) {
            $location = $event['LOCATION']['NAME'];
        }

        if ( $location != "" ) {
            $func_output .= '<li class="hidden-xs"><div class="eventinfo-title">Location</div><div class="eventinfo-value">' . esc_html( $location ) . '</div></li>';
        }
    }

    if ( isset( $event['THEME']['attributes']['name']) && !empty($event['THEME']['attributes']['name']) ) {
        $func_output .= '<li class="hidden-xs"><div class="eventinfo-title">Kategorie</div><div class="eventinfo-value">' . esc_html( $event['THEME']['attributes']['name'] ) . '</div></li>';
    }

    $func_output .= '</div></div>';
    // = END INFO

    // = START TICKET
    if ( isset( $event['TICKETLINK'] ) && !is_array( $event['TICKETLINK'] ) && trim( $event['TICKETLINK'] ) != '') {
        $func_output .= '<div class="row" style="margin-top:5px;"><div class="col-sm-12">';
        $func_output .= '<a href="' . esc_url( (string) trim($event['TICKETLINK']) ) . '" class="btn btn-xs btn-default btn-ticket" target="_blank"><i class="fa-icon-ticket fa-fw"></i> Tickets kaufen</a>';
        $func_output .= '</div></div>';
    }
    // = END TICKET

    $func_output .= '</div></div>';
    $func_output .= '</div></div>';


    return $func_output;
}
