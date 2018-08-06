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
                  renderBar();
              }
          } else {
              // Show cookie bar
              renderBar();
          }
      }

      function getDesktopText(){
        return "<strong>SEATS2MEET.COM USES COOKIES</strong>"
              + "<br/>These are categorized in functional, analytical, advertising, social media and experimental cookies."
              + "<br/>Advertising and social media cookies gather information about activities of individual users. Seats2meet uses"
              + "these to follow and improve the effectiveness of moments of contact with users outside of the platform.";
      }

      function getMobileText(){
        return "Seats2meet.com make use of cookies";
      }

      function renderBar() {
        var div_s2mCookieBar = document.createElement("div");
        div_s2mCookieBar.setAttribute('id', 's2mCookieBar')
        var div_container = document.createElement('div');
        div_container.setAttribute('class', 'container');

        var div_desktopCookieText = document.createElement('div');
        div_desktopCookieText.setAttribute('class', 'desktopText hide-mobile')
        div_desktopCookieText.innerHTML = getDesktopText();

        var div_mobileCookietText = document.createElement('div');
        div_mobileCookietText.setAttribute('class', 'mobileText show-mobile')
        div_mobileCookietText.innerHTML = getMobileText();

        var button_cookieSettings = document.createElement('a');
        button_cookieSettings.setAttribute('href', 'https://cookies.seats2meet.com/');
        button_cookieSettings.setAttribute('class', 'cookieButton is-success');

        div_container.appendChild(div_desktopCookieText);
        div_container.appendChild(div_mobileCookietText);
        div_container.appendChild(button_cookieSettings);

        div_s2mCookieBar.appendChild(div_container);

        document.body.insertBefore(div_s2mCookieBar, document.body.firstChild);
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
  .s2mCookieBar {
    padding: 30px 15px;
      border-bottom: 1px solid #d3d3d3;
  }

    .cookieButton {
        cursor: pointer;
        display: inline-block;
        box-sizing: border-box;
        padding: 8px 6px;
        height: 40px;
        font-size: 14px;
        font-weight: 600;
        white-space: normal;
        text-align: center;
        text-decoration: none;
        line-height: normal;
        text-transform: uppercase;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -moz-background-clip: padding;
        -webkit-background-clip: padding-box;
        background-clip: padding-box;
        color: #fff;
        border: 2px solid #95c11e;
        background-color: #95c11e;
        width: 150px;
    }

    .cookieButton:hover {
        color: #95c11e;
        border-color: #95c11e;
        background-color: #fff;
    }

.desktopText {
    float: left;
     padding-right: 30px;
    width: 80%;
}

.mobileText {
    margin-bottom: 15px;
}

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
<?php
}

add_action( 'wp_footer', 'wpcbs2m_show_cookiebar_container' );
?>
