<?php

/*
* The central shortcode.
*/
function rce_event_shortcode( $atts = array() ) {

    // Get DB Contents
    $template_id = get_option( "rce_event_id" );
    $auth_code = get_option( "rce_event_auth" );
    $now = new DateTime( "NOW" );
    $no_img_url = plugins_url( "assets/no_image.png", __FILE__ );
    $whitelabel_base_url = get_option( "rce_event_url_whitelabel" );
    $iFrame_base_url = get_option( "rce_event_url_iframe" );
    $zip_code = get_option( "rce_event_basic_zip_code" );

    if ( (string)get_option( "rce_event_is_use_whitelabel") == "yes" ) {
        $is_use_whitelabel = true;
    } else {
        $is_use_whitelabel = false;
    }

    if ( ($template_id == "" || $auth_code == "") && $zip_code == "" ) {
        return "Bitte initializieren Sie das Plugin in den <a href='" . get_site_url() . "/wp-admin/admin.php?page=rce_event'>Einstellungen</a>";
    } else {


        // =============================================
        // ===== Sanitize and validate shortcode input.
        // =============================================
        $atts = shortcode_atts(
            array(
                'layout' => 'columns',
                'limit' => 9,
                'filterung' => ''
            ), $atts
        );

        // Validate $layout
        if ( $atts['layout'] == 'columns' ) {
            $layout = 'columns';
        } else if ( $atts['layout'] == 'rows' ) {
            $layout = 'rows';
        } else {
            $layout = 'columns';
        }

        // Validate $limit
        if ( is_numeric( $atts['limit'] ) ) {
            $limit = (int) $atts['limit'];

            if ( $limit > 20 ) {
                $limit = 20;
            }
        } else {
            $limit = 9;
        }

        // Sanitize $filterung
        $filterung = htmlspecialchars_decode( $atts['filterung'] );




        // =============================================
        // =============== Get Events from RCE API.
        // =============================================
        if ( $template_id != "" && $auth_code != "" ) {
            $results = get_events_from_rce( $template_id, $auth_code, $filterung, $limit );
        } else if ( $zip_code != "" ) {
            $results = get_events_by_zip_from_rce( $zip_code, $limit );

            $is_use_whitelabel = false;
            $iFrame_base_url = "https://www.rce-event.de/output.php?id=141&mode=DT&hid=";
        } else {
            return "Ein Fehler ist aufgetreten, der nicht hätte auftreten sollen. Bitte kontaktieren sie uns.";
        }

        // If the connection failed, abort.
        if ( is_null( $results ) ) {
            return "Die Verbindung zur RCE Datenbank ist fehlgeschlagen. Bitte überprüfen Sie ihren Auth Code und ihre Template ID. Entfernen Sie unsichere Parameter (Filterung) und kontaktieren Sie gegebenenfalls unseren Support.";
        }

        // Construct $eventlist
        $eventlist = array();
        if ( isset( $results['EVENTLIST']['EVENT'] ) && is_array ($results['EVENTLIST']['EVENT'] ) && count( $results['EVENTLIST']['EVENT'] ) > 0 ) {

            if ( !isset( $results['EVENTLIST']['EVENT'][0] ) ) {
                $eventlist[0] = $results['EVENTLIST']['EVENT'];
            } else {
                $eventlist = $results['EVENTLIST']['EVENT'];
            }
        }



        // =============================================
        // ========= Create HTML Output from Event Data.
        // =============================================
        $output = "<div class='widget_rce_event_startseite_widget'>";
        $output .= "<div class='rce_wrapper'>";


        if ( $layout == 'rows' ) {
            $output .= '<div class="rce_event_pagination_overlay"></div><div class="eventlist event_array" data-offset="0" data-limit="' . esc_attr( $limit ) . '" data-layout="rows">';

            foreach ($eventlist as $key => $event) {
                // Get the Event Info
                $eventDate = new DateTime($event['DATELIST']['DATE']['STARTDATE']);
                $eventStartTime = new DateTime($event['DATELIST']['DATE']['STARTTIME']);
                $detailLink = get_detail_link( $is_use_whitelabel, $whitelabel_base_url, $iFrame_base_url, $event );
                $uploadData = get_upload_data( $event );

                // Populate the template
                $output .= rce_event_layout_rows($event, $now, $eventDate, $eventStartTime, $detailLink, $no_img_url, $uploadData );
            }

            $output .= '</div>';



        } else if ( $layout == 'columns' ) {
            $output .= '<div class="rce_event_pagination_overlay"></div><div class="eventcolumns event_array" data-offset="0" data-limit="' . esc_attr( $limit ) . '" data-layout="columns">';

            foreach ($eventlist as $key => $event) {
                // Get the Event Info
                $eventDate = new DateTime($event['DATELIST']['DATE']['STARTDATE']);
                $eventStartTime = new DateTime($event['DATELIST']['DATE']['STARTTIME']);
                $detailLink = get_detail_link( $is_use_whitelabel, $whitelabel_base_url, $iFrame_base_url, $event );
                $uploadData = get_upload_data( $event );

                // Populate the template
                $output .= rce_event_layout_columns($event, $now, $eventDate, $eventStartTime, $detailLink, "https://", $no_img_url, $uploadData, $limit);
            }

            $output .= '</div>';
        }


        $output .= "</div></div>";




        // =============================================
        // =================== Display the Data.
        // =============================================
        if ( isset( $results['EVENTLIST']['EVENT'] ) && is_array ($results['EVENTLIST']['EVENT'] ) && count( $results['EVENTLIST']['EVENT'] ) > 0 ) {
            return $output;
        } else {
            return "Es wurden keine Events gefunden.";
        }
    }
}
