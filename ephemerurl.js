// inserts a message box at the top of the page asking the user to share only the ephemeral URL that was originally provided
// Requires: jQuery, ephemerurl: https://github.com/npdoty/ephemerurl

// h/t http://stackoverflow.com/questions/5448545/how-to-retrieve-get-parameters-from-javascript
function getQueryStringParameter(val) {
    var result = false,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === val) result = decodeURIComponent(tmp[1]);
    }
    return result;
}

var redirectUrl = getQueryStringParameter("ephemeral_redirect");
if (redirectUrl) {
  $(document).ready(function() {
    $("body").prepend($('<div class="ephemerurl" style="max-width: 600px; margin: 10px auto 10px auto; padding: 0px 30px 5px 30px; border: 3px solid orange; background-color: #ffee00; font-size: 18px; color: black;"></div>').html('<p>This page may not be generally accessible. Please use the following, ephemeral URL if you want to temporarily share this page:</p><p><span style="padding: 10px 0px 0px 20px; font-family: monospace; font-weight: bold;">'+redirectUrl+'</span><address style="text-align: right; color: gray; font-style: normal; margin-bottom: 8px;">This service is provided by <a href="https://github.com/npdoty/ephemerurl">ephemerurl</a>.</address>'));
  });
}