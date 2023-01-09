<?php
session_start();
include("./varPaginaAnterior.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
$perfil ="";
if(isset($_GET["USERNAME"])&& $_GET["USERNAME"]!=""){
    $perfil = $_GET["USERNAME"];
}else{
    header("Location: index.php");
    die();
}
function contarNumeros($id){
    include("./accesoBD.php");
    $contarNumeros = $mbd->prepare("SELECT COUNT(*) as RESULTADO FROM COMMENT WHERE ID_POST = :ID");
    $contarNumeros->bindValue(":ID", $id);
    $contarNumeros->setFetchMode(PDO::FETCH_ASSOC);
    $contarNumeros->execute();
    $contarNumeros = $contarNumeros->fetch();
    return $contarNumeros["RESULTADO"];
}

function pintarPost($perfil){
    include("./accesoBD.php");
    $consulta = $mbd->prepare("SELECT * FROM POST WHERE USERNAME=:USERNAME");
    $consulta->bindValue(":USERNAME", $perfil);
    $consulta->execute();
    $cadena="";
    foreach ($consulta as $value) {
        $cadena .= "<div class='post'>";
        $cadena .= "<h2>".$value["TITULO"]."</h2>";
        $cadena .= "<h4>Tema: <a href='tema.php?TEMA_NOMBRE=".$value["TEMA_NOMBRE"]."' >".$value["TEMA_NOMBRE"]."</a></h4>";
        $cadena .= "<h4>id_post:".$value["ID_POST"]."</h4>";
        $cadena .= "<p>".$value["CONTENIDO"]."</p>";
        $cadena .= "<a href='post_detalle.php?ID_POST=".$value["ID_POST"]."' >Comentarios: ".contarNumeros($value["ID_POST"])."</a>";
        $cadena .= "</div>";
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