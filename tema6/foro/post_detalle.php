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

function crearObjetoPost($id){
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta("SELECT * FROM POST WHERE ID_POST = ?", $id);
    //de [0] porque es un fetchall, cambiar en otro momento
    $consulta = $DB->obtenDatoUnico();
    $objeto = new PostForoDetalle(
        $consulta["ID_POST"], 
        $consulta["CONTENIDO"], 
        $consulta["TITULO"], 
        $consulta["TEMA_NOMBRE"], 
        $consulta["USERNAME"]
    );
    return $objeto;
}
//inicializar el objeto
$objeto = crearObjetoPost($id);
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
function pintarBotones($id, $pagina){
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta("SELECT COUNT(*) AS TOTAL FROM COMMENT WHERE ID_POST = ?", $id);
    $consulta = $DB->obtenDatoUnico();
    $paginaFinal= ceil($consulta["TOTAL"]/DWESBaseDatos::PAGINACION);
    if($pagina!=0)
    echo "<a class='botones ' href='./post_detalle.php?ID_POST=".$id ."&PAGINA=".($pagina-1)."' >&#60;</a>";
    else echo "<p></p>";
    echo "<h3>Pagina ".($pagina)."</h3>";
    if($pagina+1<$paginaFinal)
    echo "<a class='botones ' href='./post_detalle.php?ID_POST=".$id ."&PAGINA=".($pagina+1)."' >&#62;</a>";
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
                        pintarBotones($id, $pagina);
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