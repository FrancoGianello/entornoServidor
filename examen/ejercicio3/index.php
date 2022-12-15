<?php
require("./accesoBD.php");
if(isset($_GET["generar"])){
    //coger el primer valor, que nos devuelve el navegador
    $arrayNavegador = explode(" ",$_SERVER["HTTP_USER_AGENT"]);
    $navegador = $arrayNavegador[0];
    $timeStamp = $_SERVER["REQUEST_TIME"];
    $consulta = $mbd->prepare('INSERT INTO Logs (navegador, timestamp) VALUES(:navegador, :timestamp)');
    $consulta->bindParam(":navegador", $navegador);
    $consulta->bindParam(":timestamp", $timeStamp);
    $consulta->execute();
}
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
    <h1>HOLA MUNDO</h1>
    <form action="get">
        <input type="submit" value="generar" name="generar">
    </form>
    <a href="log.php">Ver datos</a>
</body>
</html>