<?php

function get_upload_data( $event ) {

    $uploadData = array();
    if ( isset( $event['UPLOADLIST'] ) && isset( $event['UPLOADLIST']['UPLOAD'] ) ) {
        if ( !isAssoc( $event['UPLOADLIST']['UPLOAD'] ) ) {
            $counter = 0;
            foreach ( $event['UPLOADLIST']['UPLOAD'] as $key => $upload ) {
                if ( isset( $upload['URL'] ) && trim( $upload['URL'] ) != '' ) {
                    return $upload;
                }
            }
        } else {
            return $event['UPLOADLIST']['UPLOAD'];
        }
    }
    return $uploadData;
}
