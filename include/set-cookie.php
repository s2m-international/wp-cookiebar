<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

function wpcbs2m_set_cookie() {
  add_action('init', function() {
      if (!isset($_COOKIE['s2m_cc'])) {
          setcookie('s2m_cc', 'some default value', strtotime('+1 day'));
      }
  });
}

function wpcbs2m_cookiescript_into_head() {
  wp_enqueue_script ( 'wpcbs2m-script', WPCBS2M_PATH . 'assets/cookiescript.min.js' );
}

//add_action( 'wp_enqueue_scripts', 'wpcbs2m_cookiescript_into_head' );

?>
