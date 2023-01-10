<?php
session_start();
include("./varPaginaAnterior.php");
include("./funcionLimpiar.php");
include("./clases/PostForo.php");
include("./clases/PostForoDetalle.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";

$id="";
if(isset($_GET["ID_POST"])&& $_GET["ID_POST"]!=""){
    $id = $_GET["ID_POST"];
}else{
    header("Location: index.php");
    die();
}

function pintarPostComentarios($id){
    include("./accesoBD.php");
    $consulta = $mbd->prepare("SELECT * FROM POST WHERE ID_POST = :ID_POST");
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->bindValue(":ID_POST", $id);
    $consulta->execute();
    $consulta = $consulta->fetch();
    $objeto = new PostForoDetalle($consulta["ID_POST"], $consulta["CONTENIDO"], $consulta["TITULO"], $consulta["TEMA_NOMBRE"], $consulta["USERNAME"]);
    $objeto->pintarObjetos();
    $objeto->pintarComentarios();
}

//seccion de la inserccion
$contenido = (isset($_POST["add_contenido"]))? $_POST["add_contenido"]:"";
if(isset($_POST["submit"])){
    $contenido = clean_input($contenido);
    if($contenido!="" ){
        $objeto->insertarComentario($contenido, $username);
        //resetear valores y el POST.
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
            <h1>Comentarios</h1>
        </header>
        <div class="posts">
            <?php 
                pintarPostComentarios($id);
                
            ?>
            <div class="comment add">
                <h3>Añadir comentario al post</h3>
                <?php if($username!="" && isset($username)){ ?>
                    <form method="post">
                    Contenido<textarea name="add_contenido" id="area" cols="20" rows="5" value="<?= $contenido?>"></textarea>
                        <input type="submit" value="enviar" name="submit">
                    </form>
                <?php } else {?>
                    <p>Debes registrarte para añadir un comentario</p>
                    <a href="login.php">login</a>
                <?php }?>
            </div>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>