<?php
require("./src/init.php");
include("./clases/PostForo.php");
include("./clases/PostForoDetalle.php");

$pagina=(isset($_GET["PAGINA"]))?$_GET["PAGINA"]:0;

$id="";
if(isset($_GET["ID_POST"])&& $_GET["ID_POST"]!=""){
    $id = $_GET["ID_POST"];
}else{
    header("Location: index.php");
    die();
}
//inicializar el objeto
$objeto = PostForoDetalle::crearObjetoPost($id);
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
            <div class="contenedor">
                <?php 
                    $objeto->pintarObjetos();
                    $objeto->pintarComentarios($pagina);
                ?>
            </div>
            <div class="contenedor">
                <div class="paginacion">
                    <?php
                        PostForoDetalle::pintarBotones($id, $pagina);
                    ?>
                </div>
                <div class="comment add">
                    <h3>Añadir comentario al post</h3>
                    <?php if($username!="" && isset($username)){ ?>
                        <form method="post">
                            Contenido
                            <textarea maxlength="500" name="add_contenido" id="area" cols="20" rows="5" value="<?= $contenido?>"></textarea>
                            <input type="submit" value="enviar" name="submit">
                        </form>
                    <?php } else {?>
                        <p>Debes registrarte para añadir un comentario</p>
                        <a href="login.php">login</a>
                    <?php }?>
                </div>
            </div>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>