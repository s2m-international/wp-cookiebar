<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

function wpcbs2m_show_cookiebar_container() {
  ?>
  <script>
      jQuery(function () {
          // get s2m_cc cookie
          // Call api to get latest cookie version and check if the s2m_cc cookie is still valid
          getLatestCookieVersion('en').done(function(result) {
            checkCookie(result);
          });
      });

      function checkCookie(result) {
          var cookiebarElm = document.getElementById('s2mCookieBar')
          var s2m_cc = getCookie('s2m_cc')
          if (s2m_cc !== 'undefined' && s2m_cc !== '') {
              var ccObj = JSON.parse(s2m_cc)

              if (ccObj.Version !== result.Version) {
                  // Show cookie bar
                  renderBar();
              }
          } else {
              // Show cookie bar
              renderBar();
          }
      }

      function getLatestCookieVersion(language) {
            var url = 'https://www.seats2meet.com/api/cookies/latest'

            if (language !== '') {
                url = url + '?cs=' + language
            }

            return jQuery.ajax({
                type: 'GET',
                url: url,
                contentType: "application/json; charset=utf-8",
                headers: { 'token': '<?php echo get_option('wpcbs2m_apikey'); ?>' },
                dataType: 'json',
            });
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
        div_desktopCookieText.setAttribute('class', 'text desktopText hide-mobile')
        div_desktopCookieText.innerHTML = getDesktopText();

        var div_mobileCookietText = document.createElement('div');
        div_mobileCookietText.setAttribute('class', 'text mobileText show-mobile')
        div_mobileCookietText.innerHTML = getMobileText();

        var div_button = document.createElement('div');
        div_button.setAttribute('class', 'buttonContainer');

        var button_cookieSettings = document.createElement('a');
        button_cookieSettings.setAttribute('href', 'https://cookies.seats2meet.com/');
        button_cookieSettings.setAttribute('class', 'cookieButton is-success');
        button_cookieSettings.innerText = 'Cookie settings';
        div_button.appendChild(button_cookieSettings);

        var button_hideCookieSettings = document.createElement('a');
        button_hideCookieSettings.setAttribute('href', 'javascript:');
        button_hideCookieSettings.setAttribute('onclick', 'hideS2MCookieBar()');
        button_hideCookieSettings.setAttribute('class', 'closeButton');
        button_hideCookieSettings.innerHTML = '<svg aria-hidden="true" data-prefix="fas" data-icon="times" class="svg-inline--fa fa-times fa-w-11" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg>';

        div_container.appendChild(div_desktopCookieText);
        div_container.appendChild(div_mobileCookietText);
        div_container.appendChild(div_button);
        div_container.appendChild(button_hideCookieSettings);

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

      function hideS2MCookieBar() {
          var elm = document.getElementById('s2mCookieBar');
          if(elm !== null) {
              elm.style.display = 'none';
          }
      }
  </script>
  <style type="text/css">
    #s2mCookieBar {
        background-color: white;
        border-bottom: 1px solid #d3d3d3;
        bottom: 0;
        font-size: 12px;
        left: 0;
        overflow: hidden;
        padding: 30px 15px;
        position: fixed;
        width: 100%;
        z-index: 1000;
		border-top: 1px solid #CCCCCC;
    }
    
    .container {
		display: -ms-flexbox;
		display: -webkit-flex;
		display: flex;
        flex-direction: row;
        align-content: flex-start;
		-ms-flex-align: center;
		-webkit-align-items: center;
		-webkit-box-align: center;
		align-items: center;
	}
    
    .closeButton {
        cursor: pointer;
        display: inline-block;
        box-sizing: border-box;
        padding: 0;
        color: #cccccc;
        border: none;
        background-color: white;
        position: absolute;
        right: 5px;
        top: 5px;
        width: 40px;
		background: transparent;
		text-align: center;
    }

    .closeButton svg {
        width: 14px;
		background: transparent;
		text-align: center;
    }

    .text {
        padding-right: 15px;
    }

    .buttonContainer {
        width: 150px;
    }

    .cookieButton {
        cursor: pointer;
        display: inline-block;
        box-sizing: border-box;
        padding: 8px 6px;
        height: 38px;
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
    
	@media screen and (max-width: 768px) {
		.cookieButton {
			margin-top: 0px;
			height: auto;
			padding: 4px;
		}
	}

    .cookieButton:hover {
        color: #95c11e;
        border-color: #95c11e;
        background-color: #fff;
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
