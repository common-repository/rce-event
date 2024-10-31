<?php

/**
 * Create a single Column Element populated with data.
 * @param $event the event array with the data to display
 * @param $now
 * @param $eventDate the Date of the Event
 * @param $eventStartTime the start Date of the Event
 * @param $detailLink the link to the event site
 * @param $urlProtocol the preferred $urlProtocol
 * @param $no_img_url the link to the "no_image" file
 * @param $uploadData the upload data
 * @param $limit the limit of shown rows - it cames from shorcode
 */
function rce_event_layout_columns($event, $now, $eventDate, $eventStartTime, $detailLink, $urlProtocol, $no_img_url, $uploadData, $limit) {

    $func_output = "";

    $col = 4;
    if ((int)$limit === 2) {
        $col = 6;
    }
    if ((int)($limit % 4) === 0) {
        $col = 3;
    }
    $func_output .= '<div class="col-md-'. $col .' col-sm-6 col-xs-12"><div class="event-box">';

    // = START IMAGE
    if (isset($uploadData) && is_array($uploadData) && count($uploadData) > 0) {
        $func_output .= '<div class="imageContainer"><a href="' . esc_url( $detailLink ) . '" title="' . esc_attr( htmlspecialchars( $event['NAME'], ENT_QUOTES, 'utf-8' ) ) . '" style="background-image:url(' . esc_url( 'https://www.rce-event.de/includes/rcethumb/phpThumb.php?q=85&w=450&h=295&zc=C&src=' . urlencode( $uploadData['URL'] ) ) . ');"></a></div>';
    } else {
        $func_output .= '<div class="imageContainer noImage"><a href="' . esc_url( $detailLink ) . '" title="' . esc_attr( htmlspecialchars( $event['NAME'], ENT_QUOTES, 'utf-8' ) ) . '" style="background-image:url(' . esc_url( $no_img_url ) . ');"></a></div>';
    }
    // = END IMAGE

    // = START CONTENT
    $func_output .= '<div class="contentContainer">';
    $func_output .= '<div class="title"><a href="' . esc_url( $detailLink ) . '" title="' . esc_attr( htmlspecialchars( $event['NAME'], ENT_QUOTES, 'utf-8' ) ) . '">' . esc_html( $event['NAME'] ) . '</a></div>';

    if ( $now->format('Y') == $eventDate->format('Y') ) {
        $outputDate = $eventDate->format('d.m.');
    } else {
        $outputDate = $eventDate->format('d.m.Y');
    }

    $outputDateTime = '<span class="outputDate">' . esc_html( $outputDate ) . '</span>';
    if ( $eventStartTime->format('H:i:s') != '00:00:00' ) {
        $outputDateTime .= '<span class="outputTime"> ab ' . esc_html( $eventStartTime->format('H:i') ) . ' Uhr</span>';
    }

    $locCity = '';
    if ( isset( $event['LOCATION']['NAME'] ) && $event['LOCATION']['NAME'] != '' && !is_array( $event['LOCATION']['NAME'] ) ) {
        $locCity = '<span class="locName">' . esc_html( $event['LOCATION']['NAME'] ) . '</span>';
    }
    if ( isset( $event['LOCATION']['CITY'] ) && $event['LOCATION']['CITY'] != '' && !is_array( $event['LOCATION']['CITY'] ) ) {
        if ( trim( $locCity ) != '') {
            $locCity .= '<span class="locComma">, </span><span class="locCity">'. esc_html( $event['LOCATION']['CITY'] ) . '</span>';
        } else {
            $locCity = '<span class="locCity">' . esc_html( $event['LOCATION']['CITY'] ) . '</span>';
        }
    }

    $func_output .= '<div class="dateTime">' . $outputDateTime . '</div>';
    $func_output .= '<div class="locationCity">' . $locCity . '</div>';

    $func_output .= '</div></div></div>';
    // = END CONTENT

    return $func_output;
}
