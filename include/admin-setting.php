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
  $menu_slug = 'testsettings';
  $function = 'add_settings_page';
  add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function);
}

function wpcbs2m_add_settings_page() {
  echo "<h1>Settings for ".PLUGIN_LONG."</h1>";
  ?>
  <form method="post" action="options.php" novalidate="novalidate">
  <input type='hidden' name='option_page' value='general' /><input type="hidden" name="action" value="update" /><input type="hidden" id="_wpnonce" name="_wpnonce" value="8269e62b1b" /><input type="hidden" name="_wp_http_referer" value="/wp-admin/options-general.php" />
  <table class="form-table">

  <tr>
  <th scope="row"><label for="blogname">Sitetitel</label></th>
  <td><input name="blogname" type="text" id="blogname" value="Seats2meet.com For hosts" class="regular-text" /></td>
  </tr>

  <tr>
  <th scope="row"><label for="blogdescription">Ondertitel</label></th>
  <td><input name="blogdescription" type="text" id="blogdescription" aria-describedby="tagline-description" value="Become part of the growing international S2M network where people share knowledge on their way to success." class="regular-text" />
  <p class="description" id="tagline-description">Geef met enkele woorden aan wat de inhoud van je site is.</p></td>
  </tr>


  <tr>
  <th scope="row"><label for="siteurl">WordPress-adres (URL)</label></th>
  <td><input name="siteurl" type="url" id="siteurl" value="http://s2mhost.dev.vertizio.eu" class="regular-text code" /></td>
  </tr>
</table>
  <?php
}


// Hook for adding admin menus
add_action('admin_menu', 'wpcbs2m_add_settings_menu');

?>
