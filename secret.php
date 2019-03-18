<?php

$secret = 'YOUR_SECRET_HERE!';

//HIDE THIS PHP FILE!
http_response_code(404);
echo ('<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL /secret.php was not found on this server.</p>
</body></html>
');
?>
