<?php

  // add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);

/**
 * custom option and settings
 */
function wpcbs2m_settings_init() {
 // register a new setting for "wpcbs2m" page
 register_setting( 'wpcbs2m', 'wpcbs2m_options' );

 // register a new section in the "wpcbs2m" page
 add_settings_section(
 'wpcbs2m_section_developers',
 '',
 'wpcbs2m_section_developers_cb',
 'wpcbs2m'
 );

 // register a new field in the "wpcbs2m_section_developers" section, inside the "wpcbs2m" page
 add_settings_field(
 'wpcbs2m_api', // as of WP 4.6 this value is used only internally
 // use $args' api_key to populate the id inside the callback
 __( 'API key', 'wpcbs2m' ),
 'wpcbs2m_api_cb',
 'wpcbs2m',
 'wpcbs2m_section_developers',
 [
 'api_key' => 'wpcbs2m_api',
 'class' => 'wpcbs2m_row',
 'wpcbs2m_custom_data' => 'custom',
 ]
 );
}

/**
 * register our wpcbs2m_settings_init to the admin_init action hook
 */
add_action( 'admin_init', 'wpcbs2m_settings_init' );

/**
 * custom option and settings:
 * callback functions
 */

// developers section cb

// section callbacks can accept an $args parameter, which is an array.
// $args have the following keys defined: title, id, callback.
// the values are defined at the add_settings_section() function.
function wpcbs2m_section_developers_cb( $args ) {
  // no callback this time
}

// pill field cb

// field callbacks can accept an $args parameter, which is an array.
// $args is defined at the add_settings_field() function.
// wordpress has magic interaction with the following keys: api_key, class.
// the "api_key" key value is used for the "for" attribute of the <label>.
// the "class" key value is used for the "class" attribute of the <tr> containing the field.
// you can add custom key value pairs to be used inside your callbacks.
function wpcbs2m_api_cb( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'wpcbs2m_options' );
 // output the field
 ?>

<input name="<?php echo esc_attr( $args['api_key'] ); ?>" type="text" id="wpcbs2m" value="<?php echo $options[ $args['api_key'] ]; ?>" class="regular-text" />
<!--
 <select id="<?php echo esc_attr( $args['api_key'] ); ?>"
 data-custom="<?php echo esc_attr( $args['wpcbs2m_custom_data'] ); ?>"
 name="wpcbs2m_options[<?php echo esc_attr( $args['api_key'] ); ?>]"
 >
 <option value="red" <?php echo isset( $options[ $args['api_key'] ] ) ? ( selected( $options[ $args['api_key'] ], 'red', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'red pill', 'wpcbs2m' ); ?>
 </option>
 <option value="blue" <?php echo isset( $options[ $args['api_key'] ] ) ? ( selected( $options[ $args['api_key'] ], 'blue', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'blue pill', 'wpcbs2m' ); ?>
 </option>
 </select>
-->
 <?php
}

/**
 * top level menu
 */
function wpcbs2m_options_page() {
  $page_title = 'Settings for ' . PLUGIN_LONG;
  $menu_title = PLUGIN_SHORT;
  $capability = 'manage_options';
  $menu_slug = 'wpcbs2m';
  $function = 'wpcbs2m_options_page_html';

 // add top level menu page
 add_menu_page(
 $page_title,
 $menu_title,
 $capability,
 $menu_slug,
 $function
 );
}

/**
 * register our wpcbs2m_options_page to the admin_menu action hook
 */
add_action( 'admin_menu', 'wpcbs2m_options_page' );

/**
 * top level menu:
 * callback functions
 */
function wpcbs2m_options_page_html() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }

 // add error/update messages

 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'wpcbs2m_messages', 'wpcbs2m_message', __( 'Settings Saved', 'wpcbs2m' ), 'updated' );
 }

 // show error/update messages
 settings_errors( 'wpcbs2m_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "wpcbs2m"
 settings_fields( 'wpcbs2m' );
 // output setting sections and their fields
 // (sections are registered for "wpcbs2m", each field is registered to a specific section)
 do_settings_sections( 'wpcbs2m' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}
