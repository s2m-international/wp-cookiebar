# Cookie bar

> Cookie naam: s2m_cc

> API voor het ophalen van de laatste cookie versie
> https://www.seats2meet.com/api/cookies/latest \
> API header = headers: { 'token': 62296866 },

## Script check na het ophalen van data

```javascript
var s2m_cc = GetCookie('s2m_cc')
if (s2m_cc !== 'undefined' && s2m_cc !== '') {
  var ccObj = JSON.parse(s2m_cc)

  if (ccObj.Version !== api - result.Version()) {
    // Show cookie bar
  }
} else {
  // Show cookie bar
}
```

## Get cookie data function

```javascript
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
```

## ToDo

```bash
> DONE - HTML template maken
> DONE - Cookie bar maken met daarin de teksten + knop
> DONE - GetCookie script copieren van ander project
> DONE - Cookie bar staat standaard verbergen
> Styling maken voor cookie bar
> WP plugin structuur maken
```
