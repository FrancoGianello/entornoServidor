<?php

session_start();
print_r($_SESSION);
echo "<br>";
print_r($_COOKIE);

$intentos = isset($_SESSION["intentos"])? $_SESSION["intentos"]:4;
$intentos--;
$_SESSION["intentos"]=$intentos;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Te quedan: <?= $intentos ?> intentos</h1>
</body>
</html>