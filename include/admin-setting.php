<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}


function wpcbs2m_add_settings_menu() {
  // Add a new submenu under Settings:
  $page_title = 'Settings for ' . PLUGIN_LONG;
  $menu_title = PLUGIN_SHORT;
  $capability = 'manage_options';
  $menu_slug = 'wpcbs2m_settings';
  $function = 'wpcbs2m_add_settings_page';
  add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
}


function wpcbs2m_add_settings_cb_page( $args ) {
 // get the value of the setting we've registered with register_setting()
 $options = get_option( 'wporg_options' );
 // output the field
 ?>
 <select id="<?php echo esc_attr( $args['label_for'] ); ?>"
 data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
 name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
 >
 <option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'red pill', 'wporg' ); ?>
 </option>
 <option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
 <?php esc_html_e( 'blue pill', 'wporg' ); ?>
 </option>
 </select>
 <p class="description">
 <?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
 </p>
 <p class="description">
 <?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
 </p>
 <?php
}


function wpcbs2m_add_settings_page() {
 // check user capabilities
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }

 // add error/update messages

 // check if the user have submitted the settings
 // wordpress will add the "settings-updated" $_GET parameter to the url
 if ( isset( $_GET['settings-updated'] ) ) {
 // add settings saved message with the class of "updated"
 add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
 }

 // show error/update messages
 settings_errors( 'wporg_messages' );
 ?>
 <div class="wrap">
   <h1>Settings for <?php echo PLUGIN_LONG; ?></h1>
 <form action="options.php" method="post">
 <?php
 // output security fields for the registered setting "wporg"
 settings_fields( 'wporg' );
 // output setting sections and their fields
 // (sections are registered for "wporg", each field is registered to a specific section)
 do_settings_sections( 'wporg' );
 // output save settings button
 submit_button( 'Save Settings' );
 ?>
 </form>
 </div>
 <?php
}

// function wpcbs2m_add_settings_page() {
//   echo "<h1>Settings for ".PLUGIN_LONG."</h1>";
//   wp_nonce_field( basename( __FILE__ ), 'wpcbs2m_nonce' );
//   ?>
<!-- //   <p>Please enter below the API-key for accessing the cookies-server. If you don't have the API-key, please contact S2M.</p>
//   <form method="post" action="admin-settings.php" novalidate="novalidate">
//
//   <table class="form-table">
//
//   <tr>
//   <th scope="row"><label for="wpcbs2m_apikey">API passport.seats2meet.com</label></th>
//   <td><input name="wpcbs2m_apikey" type="text" id="wpcbs2m_apikey" value="<?php get_option('wpcbs2m_apikey'); ?>" class="regular-text" /></td>
//   </tr>
//
//  <tr><td><p class="submit"><input name="submit" id="submit" class="button button-primary" value="Save settings" type="submit"></p>
//  </td></tr>
// </table>
//
// </form> -->
//
//   <?php
// }

// Hook for adding admin menus
add_action('admin_menu', 'wpcbs2m_add_settings_menu');

function wpcbs2m_save_settings() {
	/*
	 * Security checks
	 */
	// if ( !isset( $_POST['wpcbs2m_nonce'] ) || !wp_verify_nonce( $_POST['wpcbs2m_nonce'], basename( __FILE__ ) ) )
		// return;
	/*
	 * Check current user permissions
	 */
	if (current_user_can( 'manage_options' ) ) {

  if ($_POST['wpcbs2m_apikey'] == "" ) {
      update_option('wpcbs2m_apikey', 'API key missing');
    } else {
      update_option('wpcbs2m_apikey', $_POST['wpcbs2m_apikey']);
    }
}
}


?>
