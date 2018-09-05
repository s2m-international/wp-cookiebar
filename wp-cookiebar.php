<?php
 /* Plugin Name: WP cookiebar for S2M sites
 * Version:     1.1.2
 * Plugin URI:
 * Description: WP Cookiebar plugin for S2M sites only. For automatic updates, the use of <a href="https://github.com/afragen/github-updater/releases">Github Updater</a> is strongly recommended. Follow link for download: ZIP only!
 * Author:      <a href="https://profiles.wordpress.org/vertizio/">Sjoerd Blom</a> from <a href="https://vertizio.nl">Vertizio</a> and Dennis Vergeer
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

// Plugin Prefix: wpcbs2m_


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

//  Currently plugin version.
// Start at version 1.0.0 and use SemVer - https://semver.org
define ( 'WPCBS2M_VERSION', '1.0.7' );

// Define some constants
if ( ! defined( 'WPCBS2M_FILE' ) ) {
	define( 'WPCBS2M_FILE', __FILE__ );
}
if ( ! defined( 'WPCBS2M_PATH' ) ) {
	define( 'WPCBS2M_PATH', plugin_dir_url( __FILE__ ) );
}

define ( 'PLUGIN_SHORT', 'WP cookiebar' );
define ( 'PLUGIN_LONG', 'WP cookiebar for S2M sites' );

require_once('assets/cookiebar-container.php');
require_once('include/set-cookie.php');
require_once('include/admin-setting.php');

global $wpcbs2m_apikey;
if (!isset($wpcbs2m_apikey)) {
  $wpcbs2m_apikey = get_option('wpcbs2m_apikey');
}

// Showtime!!! Let's start



?>
