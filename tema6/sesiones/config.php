<?php

include("parametros.php");
$cadenaCorreccion ="";
if(isset($_POST["submit"])){
    if(isset($_POST["bgColor"])){
        $color = $_POST["bgColor"];
        $_SESSION["bgColor"]= $color;
    }
    if(isset($_POST["fColor"])){
        $font = $_POST["fColor"];
        $_SESSION["fColor"]=$font;
    }
    if(isset($_POST["nombre"])){
        $usuario = $_POST["nombre"];
        $_SESSION["nombre"]=$usuario;
    }
    if(isset($_POST["numero"])){
        $numero =  (int)$_POST["numero"];
        if($numero==$adivinar){
            $adivinar=random_int(0,10);
            $aciertos++;
            $intentos++;
            $cadenaCorreccion = "<p>El numero ".$numero." correcto!</p>";
        }else {
            $intentos--;
            $pista = ($numero<$adivinar)?"El numero a adivinar es mayor":"El numero a adivinar es menor";
            $cadenaCorreccion = "<p class='adivinar'>El numero ".$numero." no es correcto ".$pista.".</p>";
        }
    }
    $_SESSION["adivinar"]=$adivinar;
    $_SESSION["intentos"]=$intentos;
    $_SESSION["aciertos"]=$aciertos;
}
$mostrarAdivinar=($intentos==0)?"none":"static";
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
        *{
            color:<?php echo $font ?>
        }
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
        .adivinar{
            display:<?=$mostrarAdivinar?>;
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
                <p class="adivinar">Numero a adivinar</p>
                <input type="number" placeholder="adivinar" value="<?= $numero?>" name="numero" class="adivinar">
                <?= $cadenaCorreccion ?>
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