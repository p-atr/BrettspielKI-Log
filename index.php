<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Brettspiel-KI</title>
  <link rel="icon" type="image/gif" href="favicon.gif">
  <link rel="stylesheet" type="text/css" href="timeline.css">
  <link rel="stylesheet" type="text/css" href="header.css">
</head>

<body>
  <div class="header" id="topHeader">
    <img style="float: left; margin-right: 1em;" height="80em" src="favicon.gif">
    <h1>Logbuch Brettspiel-KI</h1>
  </div>
    <div class="timeline">

<?php
$content = file('database.txt');

foreach ($content as $line) {
    $data = explode("¨", $line);
    $date = new DateTime($data[0]);
    $position = $date->format("W")%2;
    echo '<div class="container '; if($position==0) {echo 'left';} else {echo 'right';} echo '">
      <div class="content">
        <h2>';
    echo $data[0];
    echo '</h2>
        <p>';
    echo $data[1];
    echo'</p>
      </div>
    </div>';
}
 ?>
  </div>

</body>
</html>
