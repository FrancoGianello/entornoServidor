<?php
session_start();
include("./accesoBD.php");
include("./varPaginaAnterior.php");
include("./funcionLimpiar.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
$tema ="";

if(isset($_GET["TEMA_NOMBRE"])&& $_GET["TEMA_NOMBRE"]!=""){
    $tema = $_GET["TEMA_NOMBRE"];
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

function pintarPost($tema){
    include("./accesoBD.php");
    $consulta = $mbd->prepare("SELECT * FROM POST WHERE TEMA_NOMBRE = :TEMA_NOMBRE LIMIT 5");
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->bindValue(":TEMA_NOMBRE", $tema);
    $consulta->execute();
    $cadena="";
    foreach ($consulta as $value) {
        $cadena .= "<div class='post'>";
        $cadena .= "<h2>".$value["TITULO"]."</h2>";
        $cadena .= "<h4>Usuario: <a href='perfil.php?USERNAME=".$value["USERNAME"]."' >".$value["USERNAME"]."</a></h4>";
        $cadena .= "<h4>ID_post:".$value["ID_POST"]."</h4>";
        $cadena .= "<p>".$value["CONTENIDO"]."</p>";
        $cadena .= "<a href='post_detalle.php?ID_POST=".$value["ID_POST"]."' >Comentarios: ".contarNumeros($value["ID_POST"])."</a>";
        $cadena .= "</div>";
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
        $titulo = $_POST["add_titulo"];
        $contenido = $_POST["add_contenido"];
        $inserccion = $mbd->prepare("INSERT INTO POST(TEMA_NOMBRE, USERNAME, TITULO, CONTENIDO) VALUES(:TEMA_NOMBRE, :USERNAME, :TITULO, :CONTENIDO)");
        $inserccion->bindValue(":TEMA_NOMBRE", $tema);
        $inserccion->bindValue(":USERNAME", $username);
        $inserccion->bindValue(":TITULO", $titulo);
        $inserccion->bindValue(":CONTENIDO", $contenido);
        $inserccion->execute();
        //resetear valores y el POST. Pues ya se ha hecho un comentario satisfactorio, no necesito guardar los datos nuevamente en el formulario
        $titulo="";
        $contenido ="";
        $_POST=array();
    }
}
// insert into POST(TEMA_NOMBRE, USERNAME, TITULO, CONTENIDO) values("SHOWERLESS", "francis", "hola", "me gusta JJK");

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
                echo pintarPost($tema);
                
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