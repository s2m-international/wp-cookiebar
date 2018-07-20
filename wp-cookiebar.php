<?php
 /* Plugin Name: WP cookiebar for S2M sites
 * Version:     1.0.0
 * Plugin URI:
 * Description: WP Cookiebar plugin for S2M sites only
 * Author:      Sjoerd Blom and Dennis Vergeer
 * Author URI:
 * Text Domain: wp-cookiebar
 * Domain Path: /languages/
 * License:     GPL v3
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

//  Currently plugin version.
// Start at version 1.0.0 and use SemVer - https://semver.org
define ( 'WPCBS2M_VERSION', '1.0.0' );

// Define some constants
if ( ! defined( 'WPCBS2M_FILE' ) ) {
	define( 'WPCBS2M_FILE', __FILE__ );
}
if ( ! defined( 'WPCBS2M_PATH' ) ) {
	define( 'WPCBS2M_PATH', plugin_dir_path( WPCBS2M_FILE ) );
}




function wpcbs2m_activate() {
  //require_once WPCBS2M_PATH . 'plugin-update-checker/plugin-update-checker.php';
  require_once 'plugin-update-checker/plugin-update-checker.php';
  $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
  	'https://github.com/s2m-international/wp-cookiebar/',
  	__FILE__,
  	'unique-plugin-or-theme-slug'
  );

  // TODO: Set token in database instead of in file
  $myUpdateChecker->setAuthentication('your-token-here');

  //Optional: Set the branch that contains the stable release.
  $myUpdateChecker->setBranch('stable-branch-name');
}




// Showtime!!! Let's start
wpcbs2m_activate();
 ?>
