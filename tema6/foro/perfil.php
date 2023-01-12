<?php
session_start();
require("./src/init.php");
include("./clases/PostForo.php");
include("./clases/PostForoPerfil.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
$perfil ="";
$pagina=(isset($_GET["PAGINA"]))?$_GET["PAGINA"]:0;

if(isset($_GET["USERNAME"])&& $_GET["USERNAME"]!=""){
    $perfil = $_GET["USERNAME"];
}else{
    header("Location: index.php");
    die();
}
function mostrarPosts($perfil, $pagina){
    require("./accesoBD.php");
    $consulta = $mbd->prepare("SELECT * FROM POST WHERE USERNAME=:USERNAME ORDER BY ID_POST DESC LIMIT :PAGINA, 4");
    $consulta->bindValue(":USERNAME", $perfil);
    $consulta->bindValue(":PAGINA", ($pagina*4), PDO::PARAM_INT);
    $consulta->execute();
    $cadena="";
    foreach ($consulta as $value) {
        $objeto = new PostForoPerfil($value["ID_POST"], $value["CONTENIDO"], $value["TITULO"], $value["TEMA_NOMBRE"]);
        $objeto->pintarObjetos();
    }
    return $cadena;
}
function pintarBotones($perfil, $pagina){
    if($pagina!=0)
    echo "<a class='botones ' href='./perfil.php?USERNAME=".$perfil ."&PAGINA=".($pagina-1)."' >&#60;</a>";
    else echo "<p></p>";
    echo "<h3>Pagina ".($pagina+1)."</h3>";
    if($pagina!=3)
    echo "<a class='botones ' href='./perfil.php?USERNAME=".$perfil ."&PAGINA=".($pagina+1)."' >&#62;</a>";
    else echo "<p></p>";
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
            <div class="contenedor">
                <?php 
                    mostrarPosts($perfil, $pagina);
                ?>
                <div class="paginacion">
                    <?php
                        pintarBotones($perfil, $pagina);
                    ?>
                </div>
            </div>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>