<?php

function get_detail_link( $is_use_whitelabel, $whitelabel_base_url, $iFrame_base_url, $event ) {
    if ( $is_use_whitelabel ) {
        return $whitelabel_base_url . $event['attributes']['seo_name'];
    } else {
        return $iFrame_base_url . $event['DATELIST']['DATE']['attributes']['hid'];
    }
}
