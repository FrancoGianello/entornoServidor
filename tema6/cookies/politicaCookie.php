<?php


$mostrarMensaje = true;
if(isset($_GET["verificado"]) && $_GET["verificado"]=="true"){
    setcookie("verificado", "true");
    $mostrarMensaje = false;
}
if(isset($_COOKIE["verificado"]))
$mostrarMensaje=false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0;
            padding:0;
            text-align:center;
        }
        a{
            background-color:black;
            color:white;
            width:100px;
            height:25px;
        }
        .main{
            width:100vw;
            height:100vh;
            display:grid;
            grid-template-rows: 200px 200px;
        }
        .formulario, .enlace{
            width:100%;
            display:flex;
            justify-content:space-around;
            align-items:center;
        }
        .formulario{
            position:fixed;
            bottom:0;
            height:100px;
            background-color:grey;
            border-top:1px solid black;
        }
    </style>
</head>
<body>
    <main class="main">
        <h1>BIENVENIDO</h1>
        <div class="enlace">
            <a href="<?php echo (isset($_COOKIE["verificado"]))?"verifica.php":""; ?>">Acceso</a>
        </div>
        <?php
        if($mostrarMensaje){ 
        ?>
        <div class="formulario">
            <a href="politicaCookie.php?verificado=true" class="aceptar">Aceptar</a>
            <a href="" class="denegar">Denegar</a>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis animi velit iste deleniti reprehenderit accusamus architecto sint. Sapiente, reiciendis explicabo?</p>
        </div>
        <?php }?>
    </main>
</body>
</html>
