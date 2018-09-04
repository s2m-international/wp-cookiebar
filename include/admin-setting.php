<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}


add_action('init','do_stuff');
function do_stuff(){
  if (isset($_POST['wpcbs2m_submit'])) {
    if($_POST['wpcbs2m_submit'] == 'Y') {
            //Form data sent
            if (current_user_can( 'manage_options' ) ) {
              update_option('wpcbs2m_apikey', $_POST['wpcbs2m_apikey']);
            }
        }
  }

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


function wpcbs2m_add_settings_page() {
  $wpcbs2m_apikey = get_option('wpcbs2m_apikey');
  echo "<h1>Settings for ".PLUGIN_LONG."</h1>";
  wp_nonce_field( basename( __FILE__ ), 'wpcbs2m_nonce' );
  ?>
  <p>Please enter below the API-key for accessing the cookies-server. If you don't have the API-key, please contact S2M.</p>
  <form method="post" action="/wp-admin/options-general.php?page=wpcbs2m_settings" novalidate="novalidate">

  <table class="form-table">

  <tr>
  <th scope="row"><label for="wpcbs2m_apikey">API passport.seats2meet.com</label></th>
  <td>
    <input name="wpcbs2m_apikey" type="text" id="wpcbs2m_apikey" value="<?php echo $wpcbs2m_apikey; ?>" class="regular-text" />
    <input name="wpcbs2m_submit" type="hidden" value="Y">
  </td>
  </tr>

 <tr><td><p class="submit"><input name="submit" id="submit" class="button button-primary" value="Save settings" type="submit"></p>
 </td></tr>
</table>

</form>

  <?php
}

// Hook for adding admin menus
add_action('admin_menu', 'wpcbs2m_add_settings_menu');


?>
