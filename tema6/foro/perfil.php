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
if(isset($_POST["actualizar"])){
    actualizarDatos();
}

function actualizarDatos(){
    if(isset($_POST["descripcion"]) && $_POST["descripcion"]!=""){
        $DB = DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "UPDATE USER SET DESCRIPCION = ? WHERE ID_USER=?",
            [$_POST["descripcion"], $_SESSION["id"]]
        );
    }
    if(isset($_FILES["imagen"])){
        $nombreTmp = $_FILES["imagen"]["tmp_name"];
        $nombre = $_FILES["imagen"]["name"];
        $tipo = $_FILES["imagen"]["type"];
        if($tipo == "image/png" || $tipo == "image/jpeg"){
            if($_FILES["imagen"]["error"]==0){
                move_uploaded_file($nombreTmp,"images/100.png");
                $DB = DWESBaseDatos::obtenerInstancia();
                $DB->ejecuta(
                    "UPDATE USER SET PFP = ? WHERE ID_USER=?",
                    ["images/100.png", $_SESSION["id"]]
                );
            }
        }
    }
}
$edicion ="";
if(isset($_SESSION["user"])){
    if($perfil == $_SESSION["user"])
    $edicion = true;
    else 
    $edicion=false;
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
                <?php 
                    PostForoPerfil::pintarBiografia($perfil);

                    if($edicion){
                ?>
                <form action="" method="post" class="edicion" enctype="multipart/form-data">
                    Editar imagen
                    <label class="fileUpload">
                        <input type="file" name="imagen" id="">
                    </label>
                    <textarea name="descripcion" id=""></textarea>
                    <input type="submit" value="actualizar" name="actualizar">
                </form>
                <?php }?>
            </div>
            <div class="posts--contenedor">
                <?php 
                    PostForoPerfil::mostrarPosts($perfil, $pagina);
                ?>
                <div class="paginacion">
                    <?php
                        PostForoPerfil::pintarBotones($perfil, $pagina);
                    ?>
                </div>
            </div>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>