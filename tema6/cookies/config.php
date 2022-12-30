<?php

include("parametros.php");

if(isset($_POST["submit"])){
    if(isset($_POST["bgColor"])){
        $color = $_POST["bgColor"];
        setcookie("bgColor", $color);
    }
    if(isset($_POST["fColor"])){
        $font = $_POST["fColor"];
        setcookie("fColor", $font);
    }
    if(isset($_POST["nombre"])){
        $usuario = $_POST["nombre"];
        setcookie("nombre", $usuario);
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
    <link rel="stylesheet" href="estilo.css">
    <style>
        .formulario, form{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-flow:column;
            gap:10px;
        }
        .color{
            background-color:<?php echo $color ?>;
        }
        *{
            color:<?php echo $font ?>
        }
    </style>
</head>
<body>
    <main class="main">
        <div class="formulario">
            <form action="" method="post">
                Background<input type="color" value="<?=$color?>" name="bgColor" id="">
                Font<input type="color" name="fColor" value="<?=$font?>"  id="">
                Nombre usuario<input type="text" name="nombre" value="<?=$usuario?>" id="">
                <input type="submit" name="submit" value="ENVIAR">
            </form> 
        </div>
        <div class="color">
            <h1>Color: <?php echo $color?></h1>
        </div>
        <?php
        include("./menu.php");
        ?>
    </main> 
</body>
</html>