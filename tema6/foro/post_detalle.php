<?php
session_start();
include("./varPaginaAnterior.php");
include("./accesoBD.php");
include("./funcionLimpiar.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";

$id="";
if(isset($_GET["ID_POST"])&& $_GET["ID_POST"]!=""){
    $id = $_GET["ID_POST"];
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

function pintarPost($id){
    include("./accesoBD.php");
    $consulta = $mbd->prepare("SELECT * FROM POST WHERE ID_POST = :ID_POST");
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->bindValue(":ID_POST", $id);
    $consulta->execute();
    $cadena="";
    foreach ($consulta as $value) {
        $cadena .= "<div class='post'>";
        $cadena .= "<h2>".$value["TITULO"]."</h2>";
        $cadena .= "<h4>Usuario: <a href='perfil.php?USERNAME=".$value["USERNAME"]."' >".$value["USERNAME"]."</a></h4>";
        $cadena .= "<h4>ID_post:".$value["ID_POST"]."</h4>";
        $cadena .= "<h4>Tema: <a href='tema.php?TEMA_NOMBRE=".$value["TEMA_NOMBRE"]."' >".$value["TEMA_NOMBRE"]."</a></h4>";
        $cadena .= "<p>".$value["CONTENIDO"]."</p>";
        $cadena .= "<p>Comentarios: ".contarNumeros($value["ID_POST"])."</p>";
        $cadena .= "</div>";
    }
    return $cadena;
}

function pintarComentarios($id){
    include("./accesoBD.php");
    $consultaAux = $mbd->prepare("SELECT * FROM COMMENT WHERE ID_POST = :ID");
    $consultaAux->bindValue(":ID", $id);
    $consultaAux->setFetchMode(PDO::FETCH_ASSOC);
    $consultaAux->execute();
    $cadena ="";
    foreach ($consultaAux as $value) {
        $cadena .= "<div class='comment'>";
        $cadena .= "<h4>Usuario: <a href='perfil.php?USERNAME=".$value["USERNAME"]."' >".$value["USERNAME"]."</a></h4>";
        $cadena .= "<p>".$value["CONTENIDO"]."</p>";
        $cadena .= "</div>";
    }
    return $cadena;
}


//seccion de la inserccion
$contenido = (isset($_POST["add_contenido"]))? $_POST["add_contenido"]:"";
if(isset($_POST["submit"])){
    $contenido = clean_input($contenido);
    if($contenido!="" ){
        $inserccion = $mbd->prepare("INSERT INTO COMMENT(ID_POST, CONTENIDO, USERNAME) VALUES(:ID_POST, :CONTENIDO, :USERNAME)");
        $inserccion->bindValue(":ID_POST", $id);
        $inserccion->bindValue(":CONTENIDO", $contenido);
        $inserccion->bindValue(":USERNAME", $username);
        $inserccion->execute();
        //resetear valores y el POST. Pues ya se ha hecho un comentario satisfactorio, no necesito guardar los datos nuevamente en el formulario
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
                echo pintarPost($id);
                echo pintarComentarios($id);
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