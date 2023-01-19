<?php
require("./src/init.php");
include("./clases/PostForo.php");
include("./clases/PostForoPerfil.php");

$perfil ="";
$pagina=(isset($_GET["PAGINA"]))?$_GET["PAGINA"]:0;

if(isset($_GET["USERNAME"])&& $_GET["USERNAME"]!=""){
    $perfil = $_GET["USERNAME"];
}else{
    header("Location: index.php");
    die();
}
function mostrarPosts($perfil, $pagina){
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta(
        "SELECT * FROM POST WHERE USERNAME=? ORDER BY ID_POST DESC LIMIT ?, ?",
        [$perfil, $pagina*DWESBaseDatos::PAGINACION, DWESBaseDatos::PAGINACION]
    );
    $consulta = $DB->obtenDatos();
    foreach ($consulta as $value) {
        $objeto = new PostForoPerfil($value["ID_POST"], $value["CONTENIDO"], $value["TITULO"], $value["TEMA_NOMBRE"]);
        $objeto->pintarObjetos();
    }
}
function pintarBotones($perfil, $pagina){
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta("SELECT COUNT(*) AS TOTAL FROM POST WHERE USERNAME = ?", $perfil);
    $consulta = $DB->obtenDatoUnico();
    $paginaFinal= ceil($consulta["TOTAL"]/DWESBaseDatos::PAGINACION);
    if($pagina!=0)
    echo "<a class='botones ' href='./perfil.php?USERNAME=".$perfil ."&PAGINA=".($pagina-1)."' >&#60;</a>";
    else echo "<p></p>";
    echo "<h3>Pagina ".($pagina)."</h3>";
    if($pagina+1<$paginaFinal)
    echo "<a class='botones ' href='./perfil.php?USERNAME=".$perfil ."&PAGINA=".($pagina+1)."' >&#62;</a>";
    else echo "<p></p>";
}
function pintarBiografia($perfil){
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta("SELECT PFP, DESCRIPCION FROM USER WHERE USERNAME = ?", $perfil);
    $consulta = $DB->obtenDatoUnico();
    echo "<h1>".$perfil."</h1>";
    echo "<img src='".$consulta['PFP']."' alt='error'>";
    echo "<p> ".$consulta["DESCRIPCION"]."</p>";
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
    <style>
        .biografia{
            background-color:grey;
        }
        .posts{
            width:60%;
            margin:0 auto;
            display: grid;
            grid-template-rows: 30% 70%;
            gap:3px;
        }
    </style>
</head>
<body>
    <main class="main">
        <header>
            <h1>Perfil</h1>
        </header>
        <div class="posts">
            <div class="post biografia">
                <?php pintarBiografia($perfil);?>
            </div>
            <div class="posts--contenedor">
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