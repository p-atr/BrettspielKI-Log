<html>
<body>
<?php
$name = filter_input (INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); ?>
Welcome <?php echo $name; ?>


<?php
$file_data = "Stuff you want to add\n";
$file_data .= file_get_contents('database.txt');
file_put_contents('database.txt', $file_data);
?>

</body>
</html>
