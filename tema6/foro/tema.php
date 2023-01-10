<?php
session_start();
include("./varPaginaAnterior.php");
include("./funcionLimpiar.php");
include("./clases/PostForo.php");
include("./clases/PostForoTema.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
$tema ="";

if(isset($_GET["TEMA_NOMBRE"])&& $_GET["TEMA_NOMBRE"]!=""){
    $tema = $_GET["TEMA_NOMBRE"];
}else{
    header("Location: index.php");
    die();
}

function mostrarPosts($tema){
    include("./accesoBD.php");
    $consulta = $mbd->prepare("SELECT * FROM POST WHERE TEMA_NOMBRE = :TEMA_NOMBRE LIMIT 5");
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->bindValue(":TEMA_NOMBRE", $tema);
    $consulta->execute();
    $cadena="";
    foreach ($consulta as $value) {
        $post = new PostForoTema($value["ID_POST"], $value["CONTENIDO"], $value["TITULO"], $value["USERNAME"]);
        $post->pintarObjetos();
    }
    return $cadena;
}

//seccion inserccion
$titulo = (isset($_POST["add_titulo"]))? $_POST["add_titulo"]:"";
$contenido = (isset($_POST["add_contenido"]))? $_POST["add_contenido"]:"";
if(isset($_POST["submit"])){
    $contenido = clean_input($contenido);
    $titulo = clean_input($titulo);
    if( $titulo!="" && $contenido!="" ){
        //el parametro ID_post a null, porque en la inserccion se hace automaticamente (autoincrement)
        $inserccion = new PostForoTema(null, $username, $titulo, $contenido);
        $inserccion->insertarPost($tema);
        //resetear valores y el POST.
        //no funca lool
        $titulo="";
        $contenido ="";
        $_POST=array();
    }
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
            
            <?php 
                mostrarPosts($tema);
            ?>
            <div class="post add">
                <h3>Añadir post a <?= $tema?></h3>
                <?php if($username!="" && isset($username)){?>
                    <form method="post">
                        Titulo<input type="text" name="add_titulo" id="titulo" value="<?= $titulo?>">
                        Contenido<textarea name="add_contenido" id="area" cols="20" rows="5" value="<?= $contenido?>"></textarea>
                        <input type="submit" value="enviar" name="submit">
                    </form>
                <?php } else {?>
                    <p>Debes registrarte para añadir un post</p>
                    <a href="login.php">login</a>
                <?php }?>
            </div>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>