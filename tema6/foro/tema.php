<?php
require("./src/init.php");
include("./clases/PostForo.php");
include("./clases/PostForoTema.php");

$tema ="";
$pagina=(isset($_GET["PAGINA"]))?$_GET["PAGINA"]:0;

if(isset($_GET["TEMA_NOMBRE"])&& $_GET["TEMA_NOMBRE"]!=""){
    $tema = $_GET["TEMA_NOMBRE"];
}else{
    header("Location: index.php");
    die();
}

function mostrarPosts($tema, $pagina){
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta(
        "SELECT * FROM POST WHERE TEMA_NOMBRE = ? ORDER BY ID_POST DESC LIMIT ?, ?", 
        [$tema, $pagina*DWESBaseDatos::PAGINACION, DWESBaseDatos::PAGINACION]
    );
    $consulta = $DB->obtenDatos();
    foreach ($consulta as $value) {
        $post = new PostForoTema($value["ID_POST"], $value["CONTENIDO"], $value["TITULO"], $value["USERNAME"]);
        $post->pintarObjetos();
    }
}

//seccion inserccion
$titulo = (isset($_POST["add_titulo"]))? $_POST["add_titulo"]:"";
$contenido = (isset($_POST["add_contenido"]))? $_POST["add_contenido"]:"";
if(isset($_POST["submit"])){
    $contenido = clean_input($contenido);
    $titulo = clean_input($titulo);
    if( $titulo!="" && $contenido!="" ){
        //el parametro ID_post a null, porque en la inserccion se hace automaticamente (autoincrement)
        $inserccion = new PostForoTema(null, $contenido, $titulo, $username);
        $inserccion->insertarPost($tema);
        //resetear valores y el POST.
        //no funca lool
        $titulo="";
        $contenido ="";
        $_POST=array();
    }
}

function pintarBotones($tema, $pagina){
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta("SELECT COUNT(*) AS TOTAL FROM POST WHERE TEMA_NOMBRE = ?", $tema);
    $consulta = $DB->obtenDatoUnico();
    $paginaFinal= ceil($consulta["TOTAL"]/DWESBaseDatos::PAGINACION);
    if($pagina!=0)
    echo "<a class='botones ' href='./tema.php?TEMA_NOMBRE=".$tema ."&PAGINA=".($pagina-1)."' >&#60;</a>";
    else echo "<p></p>";
    echo "<h3>Pagina ".($pagina)."</h3>";
    if($pagina+1<$paginaFinal)
    echo "<a class='botones ' href='./tema.php?TEMA_NOMBRE=".$tema ."&PAGINA=".($pagina+1)."' >&#62;</a>";
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
            <?="<h1>".$tema."</h1>";?>
        </header>
        <div class="posts">
            <div class="contenedor">
                <?php 
                    mostrarPosts($tema, $pagina);
                ?>
                </div>
            <div class="contenedor">
                <div class="paginacion">
                    <?php pintarBotones($tema, $pagina); ?>
                </div>
                <div class="post add">
                    <h3>Añadir post a <?= $tema?></h3>
                    <?php if($username!="" && isset($username)){?>
                        <form method="post">
                            Titulo<input type="text" name="add_titulo" id="titulo" value="<?= $titulo?>">
                            Contenido<textarea name="add_contenido" id="area" cols="20" rows="3" value="<?= $contenido?>"></textarea>
                            <input type="submit" value="enviar" name="submit">
                        </form>
                    <?php } else {?>
                        <p>Debes registrarte para añadir un post</p>
                        <a href="login.php">login</a>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>