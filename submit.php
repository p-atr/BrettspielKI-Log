<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Submit - Brettspiel-KI</title>
  <link rel="icon" type="image/gif" href="favicon.gif">
  <link rel="stylesheet" type="text/css" href="timeline.css">
  <link rel="stylesheet" type="text/css" href="header.css">
</head>

<body>
  <div class="header" id="topHeader">
    <img style="float: left; margin-right: 1em;" height="80em" src="favicon.gif">
    <h1>Submit - Logbuch Brettspiel-KI</h1>
  </div>
    <div class="content" style="width:50%; margin:0 auto;">
  <form onsubmit="form_generate()" action="submit.php" method="post" id="form">
    <h3>Text:</h3>
    <textarea rows="10" cols="80" id="l_text"></textarea><br>
    <h3>Passwort:</h3>
    <input type="password" id="l_password">
    <input type="hidden" name="text" id="text">
    <input type="hidden" name="hmac" id="hmac"><br>
    <input type="submit">
  </form>

  <?php

  include ('secret.php');

  if (isset($_POST['text']) and isset($_POST['hmac'])) {
    sleep(5);
    $local_hmac = hash_hmac('sha512', $_POST['text'], $secret);
    //$text = base64_decode($_POST['text']);
    $text= str_replace('LSWISSA','ä',str_replace('USWISSA','Ä',str_replace('LSWISSO','ö',str_replace('USWISSO','Ö',
    str_replace('LSWISSU','ü',str_replace('USWISSU','Ü',base64_decode($_POST['text']))))))); //äöü-Fix
    file_put_contents('.htdatabase_log.txt', date('d.m.Y H:i:s').' [IP:'.$_SERVER['REMOTE_ADDR'].'] '.$text."\n", FILE_APPEND);

    if ($local_hmac == $_POST['hmac']) {
        echo('CORRECT QUERY -> CONTINUE');
        $file_data = date('d.m.Y').'¨'
        .str_replace('\n', '<br>', filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS))."\n";

        $file_data .= file_get_contents('database.txt');
        file_put_contents('database.txt', $file_data);
    }

    else {
      echo('INCORRECT QUERY -> ABORT!');
    }

  }

  else {
    echo('NO QUERY -> ABORT!');
  }

  ?>
</div>
  <script src="js/form_generate.js"></script>
  <script src="js/crypto-js-3.1.9-1/crypto-js.js"></script>
</body>

</html>
