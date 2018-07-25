<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

function wpcbs2m_show_cookiebar_container() {
  ?>
  <script>
      window.onload = function () {
          // get s2m_cc cookie
          // Call api to get latest cookie version and check if the s2m_cc cookie is still valid
      }

      function checkCookie() {
          var cookiebarElm = document.getElementById('s2mCookieBar')
          var s2m_cc = GetCookie('s2m_cc')
          if (s2m_cc !== 'undefined' && s2m_cc !== '') {
              var ccObj = JSON.parse(s2m_cc)

              if (ccObj.Version !== api - result.Version()) {
                  // Show cookie bar
                  cookiebarElm.style.display = '';
              }
          } else {
              // Show cookie bar
              cookiebarElm.style.display = '';
          }
      }

      function getCookie(cName) {
          if (document.cookie.length > 0) {
              var arr = document.cookie.split(';')
              cName = cName + '='
              var value = ''
              for (var i = 0, arrLength = arr.length; i < arrLength; i++) {
                  value = arr[i].trim()
                  if (value.indexOf(cName) !== -1 && value.indexOf(cName) === 0) {
                      value = value.substr(cName.length)
                      break
                  }
                  value = ''
              }
              return value
          }
          return ''
      }
      function setCookie(cName, value, days = 1, isWildcard = false, reload = false) {
          var expires = ''
          var domain = ''
          if (typeof days === 'number') {
              var date = new Date()
              date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000)
              expires = ';expires=' + date.toUTCString()
          }

          // TODO: hier moet een extra conditional opgenomen worden tbv testdoeleinden, liefst
          // controle of we in debug-mode zijn. Dus if (domain=bla OR Var_Debug=true) then { doeiets }
          if (isWildcard === true && /seats2meet.com/.test(window.location.host) === true) {
              domain = ';domain=.seats2meet.com'
          }

          document.cookie = cName + '=' + value + expires + domain + ';path=/' // Refresh the page

          if (reload) {
              location.reload(true)
          }
          return true
      }
  </script>
  <style type="text/css">
      @media screen and (min-width: 769px) {
          .show-mobile {
              display: none;
          }
      }

      @media screen and (max-width: 768px) {
          .hide-mobile {
              display: none;
          }
      }
  </style>
  <!-- <div id="s2mCookieBar" class="padding" style="display:none;"> -->
  <div id="s2mCookieBar" class="padding" >
      <div class="container">
          <div class="hide-mobile">
              <strong>SEATS2MEET.COM USES COOKIES</strong>
              <br/>These are categorized in functional, analytical, advertising, social media and experimental cookies.
              <br/>Advertising and social media cookies gather information about activities of individual users. Seats2meet uses
              these to follow and improve the effectiveness of moments of contact with users outside of the platform.
          </div>
          <div class="show-mobile">
              Seats2meet.com make use of cookies
          </div>
          <div class="column is-2">
              <a class="button is-success" href="https://cookies.seats2meet.com/">Cookie settings</a>
          </div>
      </div>
  </div>
<?php
}

add_action( 'wp_footer', 'wpcbs2m_show_cookiebar_container' );
?>
