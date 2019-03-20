<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Submit - Brettspiel-KI</title>
  <link rel="icon" type="image/gif" href="favicon.gif">
  <link rel="stylesheet" type="text/css" href="timeline.css">
  <link rel="stylesheet" type="text/css" href="header.css">
  <link rel="stylesheet" media="only screen and (max-width: 999px)" href="mobile.css" />
  <link rel="stylesheet" media="only screen and (min-width: 1000px)" href="desktop.css" />
</head>

<body>
  <div class="header" id="topHeader">
    <img class="icon" src="favicon.gif">
    <h1>Submit - Logbuch Brettspiel-KI</h1>
  </div>
    <div class="content submit">
  <form onsubmit="form_generate()" action="submit.php" method="post" id="form">
    <h2>Text:</h2>
    <textarea id="l_text"></textarea><br>
    <h2>Passwort:</h2>
    <input class="password" type="password" id="l_password">
    <input type="hidden" name="text" id="text">
    <input type="hidden" name="hmac" id="hmac"><br>
    <input type="submit">
  </form>

  <?php
  ob_start();
  require('secret.php');
  $useless = ob_get_clean();

  if (isset($_POST['text']) and isset($_POST['hmac'])) {
    $local_hmac = hash_hmac('sha512', $_POST['text'], $secret);
    //$text = base64_decode($_POST['text']);
    $text= str_replace('LSWISSA','ä',str_replace('USWISSA','Ä',str_replace('LSWISSO','ö',str_replace('USWISSO','Ö',
    str_replace('LSWISSU','ü',str_replace('USWISSU','Ü',base64_decode($_POST['text']))))))); //äöü-Fix
    file_put_contents('.ht_database_log.txt', date('d.m.Y H:i:s').' [IP:'.$_SERVER['REMOTE_ADDR'].'] '.trim(preg_replace('/\s+/', ' ', $text))."\n", FILE_APPEND);
    usleep(rand(4500, 5500)*1000);

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
