<?php
session_start();
require("./src/init.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";

function pintarTemas($DB){
    $DB->ejecuta('SELECT * FROM TEMA');
    $consulta=$DB->obtenDatos();
    foreach ($consulta as $value){
        echo "<div style=' background-image: url"."(./images/".$value["TEMA_NOMBRE"].".jpg)"."' class='tema ".$value['TEMA_NOMBRE']."'>";
        echo "<div class='texto'>";
        echo "<h2 ><a class='titulo ' href='tema.php?TEMA_NOMBRE=".$value['TEMA_NOMBRE']."'>". $value['TEMA_NOMBRE']."</a></h2>";
        echo "<p>".$value['DESCRIPCION']."</p>";
        echo "</div>";
        echo "</div>";
    }
}

$bienvenida = ($username!="")? $username:"ANONIMO";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <main class="main">
        <header class="encabezado">
            <h1>BIENVENIDO <?=$bienvenida ?></h1>
        </header>
        <div class="temas">
            <?php 
                pintarTemas($DB);
            ?>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>