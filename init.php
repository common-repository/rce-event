<?php

// When the admin menu is loaded, call the function RCE_Event_init to create the settings Pages.
add_action("admin_menu", "RCE_Event_init");
function RCE_Event_init() {

    // Creates a admin menu page.
    add_menu_page(
    // Title of the Page.
        "Einstellungen für RCE Event",
        // String in the admin menu sidebar.
        "RCE Event",
        // Lowest Role to see the page.
        "administrator",
        // Slug.
        "rce_event",
        // Callback that creates the HTML for the Page.
        "rce_event_markup_mainsettings",
        // Dashicon.
        "dashicons-schedule",
        // Position.
        12000
    );

    // Creates the Settings Section: Basic Settings.
    add_settings_section(
    // Slug of the Section.
        "rce_event_main_settings_section",
        // Title of the Section (Display).
        "Basiseinstellungen",
        // Callback for the Description.
        "rce_event_main_settings_section_callback",
        // The Slug of the Page, on which the section will be positioned.
        "rce_event"
    );

    /*
    * Creates a Settings Field.
    * The Zip Code for non-registered users.
    */
    add_settings_field(
    // Slug.
        "rce_event_basic_zip_code",
        // Display text (label).
        "Postleitzahl(en)",
        // Callback for the <input>.
        "rce_event_basic_zip_code_callback",
        // Slug of the page.
        "rce_event",
        // Slug of the section.
        "rce_event_main_settings_section"
    );

    // Registers the option "rce_event_basic_zip_code" into the option group "rce_event_settings".
    register_setting(
    // option group name.
        "rce_event_settings",
        // option.
        "rce_event_basic_zip_code",
        // additional arguments.
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );


    // Creates the Settings Section: Advanced Settings.
    add_settings_section(
    // Slug of the Section.
        "rce_event_advanced_settings_section",
        // Title of the Section (Display).
        "Erweiterte Einstellungen",
        // Callback for the Description.
        "rce_event_advanced_settings_section_callback",
        // The Slug of the Page, on which the section will be positioned.
        "rce_event"
    );

    /*
    * Creates a Settings Field.
    * The Template ID
    */
    add_settings_field(
    // Slug.
        "rce_event_id",
        // Display text (label).
        "Template ID",
        // Callback for the <input>.
        "rce_event_id_callback",
        // Slug of the page.
        "rce_event",
        // Slug of the section.
        "rce_event_advanced_settings_section"
    );

    // Registers the option "rce_event_id" into the option group "rce_event_settings".
    register_setting(
    // option group name.
        "rce_event_settings",
        // option.
        "rce_event_id",
        // additional arguments.
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    /*
    * Creates a Settings Field.
    * The Auth Code.
    */
    add_settings_field(
    // Slug.
        "rce_event_auth",
        // Display text (label).
        "Auth Code",
        // Callback for the <input>.
        "rce_event_auth_callback",
        // Slug of the page.
        "rce_event",
        // Slug of the section.
        "rce_event_advanced_settings_section"
    );

    // Registers the option "rce_event_auth" into the option group "rce_event_settings".
    register_setting(
    // option group name.
        "rce_event_settings",
        // option.
        "rce_event_auth",
        // additional arguments.
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    /*
    * Creates a Settings Field.
    * Checbox: Whitelabel or iFrame.
    */
    add_settings_field(
    // Slug.
        "rce_event_is_use_whitelabel",
        // Display text (label).
        "Integrationsart von RCE Event",
        // Callback for the <input>.
        "rce_event_is_use_whitelabel_callback",
        // Slug of the page.
        "rce_event",
        // Slug of the section.
        "rce_event_advanced_settings_section"
    );

    // Registers the option "rce_event_is_use_whitelabel" into the option group "rce_event_settings".
    register_setting(
    // option group name.
        "rce_event_settings",
        // option.
        "rce_event_is_use_whitelabel",
        // additional arguments.
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    /*
    * Creates a Settings Field.
    * The Detail URL for the whitelabel integration.
    */
    add_settings_field(
    // Slug.
        "rce_event_url_whitelabel",
        // Display text (label).
        "URL RCE-EVENT Veranstaltungskalender",
        // Callback for the <input>.
        "rce_event_url_whitelabel_callback",
        // Slug of the page.
        "rce_event",
        // Slug of the section.
        "rce_event_advanced_settings_section"
    );

    // Registers the option "rce_event_url_whitelabel" into the option group "rce_event_settings".
    register_setting(
    // option group name.
        "rce_event_settings",
        // option.
        "rce_event_url_whitelabel",
        // additional arguments.
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

    /*
    * Creates a Settings Field.
    * The Detail URL for the iFrame integration.
    */
    add_settings_field(
    // Slug.
        "rce_event_url_iframe",
        // Display text (label).
        "URL zu ihrem iFrame Veranstaltungskalender",
        // Callback for the <input>.
        "rce_event_url_iframe_callback",
        // Slug of the page.
        "rce_event",
        // Slug of the section.
        "rce_event_advanced_settings_section"
    );

    // Registers the option "rce_event_url_iframe" into the option group "rce_event_settings".
    register_setting(
    // option group name.
        "rce_event_settings",
        // option.
        "rce_event_url_iframe",
        // additional arguments.
        array( 'sanitize_callback' => 'sanitize_text_field' )
    );

}

/*
* The callback that creates the HTML for the Settings Page.
*/
function rce_event_markup_mainsettings() {
    ?>
    <h2><?php esc_html_e( get_admin_page_title() ); ?></h2>

    <form method="post" action="options.php">

        <!-- The option group which settings will be edited -->
        <?php settings_fields( "rce_event_settings" ); ?>

        <!-- Display the Settings Section -->
        <?php do_settings_sections( "rce_event" ); ?>

        <?php submit_button(); ?>

    </form>
    <div id="rce_event_ad" style="width: 80%; padding-left: 10%; padding-right: 10%; margin-top: 3rem; display: none;">
        <img src="<?php echo plugins_url( "assets/ad.jpg", __FILE__ ); ?>" alt="RCE EVENT WERBETEXT" style="width: 100%; height: auto;">
    </div>
    <?php
}

/*
* The callback for the description of the main settings.
*/
function rce_event_main_settings_section_callback() {
    ?>
    <p>Wenn Sie kein Kunde von RCE-Event sind, können Sie unverbindlich eine kleine Anzahl von lokalen Events, sofern verfügbar, kostenlos ausgeben lassen.</p>
    <?php
}

/*
* The callback for the description of the advanced settings.
*/
function rce_event_advanced_settings_section_callback() {
    ?>
    <p>Wenn Sie bereits Kunde von RCE Event sind, können Sie hier Ihre Integration verbinden. <b>Lassen Sie dazu das obrige Postleitzahl-feld frei.</b></p>
    <?php
}

/*
* The Callback that creates the <input> for rce_event_basic_zip_code.
*/
function rce_event_basic_zip_code_callback() {

    // Gets the option value for the setting to display it semantically.
    $rce_event_basic_zip_code = get_option( "rce_event_basic_zip_code" );

    // Sanitize the output.
    $custom_txt = "";
    if ( isset( $rce_event_basic_zip_code ) ) {
        $custom_txt = esc_html( $rce_event_basic_zip_code );
    }

    // name defines what option should be set.
    echo '<input type="text" name="rce_event_basic_zip_code" value="' . esc_attr( $custom_txt ) . '">
        <br>
        <p style="width: 70%;">
          Hier können Sie bis zu drei deutsche Postleitzahlen eingeben. Bei mehreren PLZ bitte kommagetrennt angeben. Z.B. 80331, 80337, 80539
        </p>';
}

/*
* The Callback that creates the <input> for rce_event_id.
*/
function rce_event_id_callback() {

    // Gets the option value for the setting to display it semantically.
    $rce_event_id = get_option( "rce_event_id" );

    // Sanitize the output.
    $custom_txt = "";
    if ( isset( $rce_event_id ) ) {
        $custom_txt = esc_html( $rce_event_id );
    }

    // name defines what option should be set.
    echo '<input type="text" name="rce_event_id" value="' . esc_attr( $custom_txt ) . '">
        <br>
        <p style="width: 70%;">
          Bitte geben Sie hier die von RCE ausgehändigte Template-ID an.
        </p>';
}

/*
* The Callback, that creates the <input> for rce_event_auth.
*/
function rce_event_auth_callback() {

    // Gets the option value for the setting to display it semantically.
    $rce_event_auth = get_option( "rce_event_auth" );

    // Sanitize the output.
    $custom_txt = "";
    if ( isset( $rce_event_auth ) ) {
        $custom_txt = esc_html( $rce_event_auth );
    }

    // name defines what option should be set.
    echo '<input type="text" name="rce_event_auth" value="' . esc_attr( $custom_txt ) . '">
        <br>
        <p style="width: 70%;">
          Bitte geben Sie hier den von RCE ausgehändigten Auth-Code an.
        </p>';
}

/*
* The Callback that creates the radio buttons to select which integration method is used.
*/
function rce_event_is_use_whitelabel_callback() {

    // Gets the option value for the setting to display it semantically.
    $rce_event_is_use_whitelabel = get_option( "rce_event_is_use_whitelabel" );

    // Sanitize the output.
    $custom_txt = "";
    if ( isset( $rce_event_is_use_whitelabel ) ) {
        $custom_txt = esc_html( $rce_event_is_use_whitelabel );
    }
    if ( $custom_txt == "yes" ) {
        $first_input = "checked";
        $second_input = "";
    } else if ( $custom_txt == "no" ) {
        $first_input = "";
        $second_input = "checked";
    } else {
        $first_input = "";
        $second_input = "";
    }

    // name defines what option will be set.
    echo '<input id="rce_event_is_use_whitelabel_yes" type="radio" name="rce_event_is_use_whitelabel" value="yes" ' . esc_attr( $first_input ) . '>
        <label style="margin-right: 1rem">Whitelabel</label>
        <input id="rce_event_is_use_whitelabel_no" type="radio" name="rce_event_is_use_whitelabel" value="no" ' . esc_attr( $second_input ) . '>
        <label>iFrame</label>
        <br>
        <p style="width: 70%;">
          Wählen Sie bitte die Art der Integration Ihres RCE-Event Veranstaltungskalenders auf Ihrer Webseite aus. Entweder ist das eine iframe Integration (mit einem iframe-include) oder eine Whitelabellösung mit einer eigenen Subdomain.
        </p>
        <script>
          document.addEventListener("DOMContentLoaded", () => {
            function rce_event_check_whitelabel_inputs() {
              document.querySelector("#rce_event_url_iframe").parentNode.parentNode.style.display = "table-row"
              document.querySelector("#rce_event_url_whitelabel").parentNode.parentNode.style.display = "table-row"

              if (document.querySelector("#rce_event_is_use_whitelabel_yes").checked) {
                document.querySelector("#rce_event_url_iframe").parentNode.parentNode.style.display = "none"
              }
              if (document.querySelector("#rce_event_is_use_whitelabel_no").checked) {
                document.querySelector("#rce_event_url_whitelabel").parentNode.parentNode.style.display = "none"
              }
            }


            rce_event_check_whitelabel_inputs()
            document.querySelector("#rce_event_is_use_whitelabel_yes").addEventListener("input", rce_event_check_whitelabel_inputs)
            document.querySelector("#rce_event_is_use_whitelabel_no").addEventListener("input", rce_event_check_whitelabel_inputs)
          })
        </script>';
}

/*
* The Callback, that creates the <input> for rce_event_url_whitelabel.
*/
function rce_event_url_whitelabel_callback() {

    // Gets the option value for the setting to display it semantically.
    $rce_event_url_whitelabel = get_option( "rce_event_url_whitelabel" );

    // Sanitize the output.
    $custom_txt = "";
    if ( isset( $rce_event_url_whitelabel ) ) {
        $custom_txt = esc_html( $rce_event_url_whitelabel );
    }

    // name defines what option should be set.
    echo '<input id="rce_event_url_whitelabel" type="text" name="rce_event_url_whitelabel" value="' . esc_attr( $custom_txt ) . '" placeholder="https://domain.com/events/" style="width: 90%">
        <br>
        <p style="width: 70%;">
          Bitte geben Sie hier die URL zu Ihrer Webseite an, auf der der RCE-Event Veranstaltungskalender öffentlich aufrufbar ist.
        </p>';
}

/*
* The Callback, that creates the <input> for rce_event_url_iframe.
*/
function rce_event_url_iframe_callback() {

    // Gets the option value for the setting to display it semantically.
    $rce_event_url_iframe = get_option( "rce_event_url_iframe" );

    // Sanitize the output.
    $custom_txt = "";
    if ( isset( $rce_event_url_iframe ) ) {
        $custom_txt = esc_html( $rce_event_url_iframe );
    }

    // name defines what option should be set.
    echo '<input id="rce_event_url_iframe" type="text" name="rce_event_url_iframe" value="' . esc_attr( $custom_txt ) . '" placeholder="https://domain.com/events.php?mode=DT&hid=" style="width: 90%">
        <br>
        <p style="width: 70%;">
          Bitte geben Sie hier die URL zu Ihrer Webseite an, auf der der RCE-Event Veranstaltungskalender öffentlich aufrufbar ist.
        </p>';
}


/* === END OF THE CODE THAT CREATES THE SETTINGS PAGE === */


// Creates the link in the plguins page that directs to the settings page.
add_filter( "plugin_action_links_RCE_Event/rce_event.php", "rce_event_add_settings_link" );
function rce_event_add_settings_link( $links ) {

    // The HTML link.
    $settings_link = '<a href="admin.php?page=rce_event">Einstellungen</a>';

    // Inserts the link at the end of all links.
    array_push( $links, $settings_link );
    return $links;
}

// Creates the meta link in the plguins page that directs to the documentation.
add_filter( "plugin_row_meta", "rce_event_add_meta_row_links", 10, 2 );
function rce_event_add_meta_row_links( $links, $plugin_file ) {

    // Checks if the plugin is RCE_Event.
    if ( "RCE_Event/rce_event.php" == $plugin_file ) {

        // Inserts the link at the end of all links.
        $settings_link = '<a href="' . plugins_url( "assets/RCE_Event-WP_Plugin-Doku.pdf", __FILE__ ) . '" target="_blank">Dokumentation</a>';
        array_push( $links, $settings_link );
    }

    return $links;
}

/* === END OF THE CODE THAT AFFECTS THE FRONTEND === */

/*
* BACKEND: When the Plugin is activated, the plugins Settings Options in the Database will be added (if they are not already).
*/
register_activation_hook( RCE_EVENT_FILE, 'rce_event_options_setup' );
function rce_event_options_setup() {
    add_option( "rce_event_id", "" );
    add_option( "rce_event_auth", "" );
    add_option( "rce_event_whitelabel", "" );
    add_option( "rce_event_url_whitelabel", "" );
    add_option( "rce_event_url_iframe", "" );
    add_option( "rce_event_is_use_whitelabel", "yes" );
    add_option( "rce_event_basic_zip_code", "");
}


/*
* BACKEND: When the Plugin is uninstalled, clean up the Database
*/
register_uninstall_hook( RCE_EVENT_FILE, 'rce_events_de_setup' );
function rce_events_de_setup() {
    delete_option( "rce_event_id" );
    delete_option( "rce_event_auth" );
    delete_option( "rce_event_whitelabel" );
    delete_option( "rce_event_url_whitelabel" );
    delete_option( "rce_event_url_iframe" );
    delete_option( "rce_event_is_use_whitelabel" );
    delete_option( "rce_event_basic_zip_code" );
}
