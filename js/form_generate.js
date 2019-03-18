function form_generate() {
  var l_text = document.getElementById("l_text").value;
  var l_password = document.getElementById("l_password").value;

  text64 = btoa(l_text.replace(/ä|ö|ü/gi, function (x) {
    if (x=='ö'){return 'LSWISSO';}
    if (x=='Ö'){return 'USWISSO';}
    if (x=='ä'){return 'LSWISSA';}
    if (x=='Ä'){return 'USWISSA';}
    if (x=='ü'){return 'LSWISSU';}
    if (x=='Ü'){return 'USWISSU';}
    else {return '!!!ENCODING ERROR!!!'}
})); //äöü-Fix

  var text = document.getElementById("text");
  var hmac = document.getElementById("hmac");
  text.value = text64;
  hmac.value = CryptoJS.HmacSHA512(text64, l_password).toString();

  return true;
}
