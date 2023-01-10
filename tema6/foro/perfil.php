<?php
session_start();
include("./varPaginaAnterior.php");
include("./clases/PostForo.php");
include("./clases/PostForoPerfil.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
$perfil ="";
if(isset($_GET["USERNAME"])&& $_GET["USERNAME"]!=""){
    $perfil = $_GET["USERNAME"];
}else{
    header("Location: index.php");
    die();
}
function pintarPost($perfil){
    include("./accesoBD.php");
    $consulta = $mbd->prepare("SELECT * FROM POST WHERE USERNAME=:USERNAME");
    $consulta->bindValue(":USERNAME", $perfil);
    $consulta->execute();
    $cadena="";
    foreach ($consulta as $value) {
        $objeto = new PostForoPerfil($value["ID_POST"], $value["CONTENIDO"], $value["TITULO"], $value["TEMA_NOMBRE"]);
        $objeto->pintarObjetos();
    }
    return $cadena;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/tema_perfil.css">
</head>
<body>
    <main class="main">
        <header>
            <?="<h1>".$perfil."</h1>";?>
        </header>
        <div class="posts">
            <?php 
                echo pintarPost($perfil);
            ?>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>