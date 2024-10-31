<?php

function rce_event_shortcodes_init() {
    add_shortcode('rce_event', 'rce_event_shortcode');
}
add_action('init', 'rce_event_shortcodes_init');
