<?php
require("./src/init.php");
$listaError =[];

$user = (isset($_POST["username"]))? $_POST["username"]:"";
$pass =(isset($_POST["pass"]))? $_POST["pass"]:"";
$mail=(isset($_POST["mail"]))? $_POST["mail"]:"";

if(isset($_POST["submit"])){
    ($user=="")?$listaError["usuarioVacio"]="Usuario debe estar relleno":"";
    ($pass=="")?$listaError["passVacio"]="Contraseña debe estar rellena":"";
    ($mail=="")?$listaError["mailVacio"]="Correo debe estar relleno":"";
}
if(!count($listaError)>0 && isset($_POST["submit"])){
    //limpiar datos
    $user = clean_input($user);
    $pass = clean_input($pass);
    $mail = clean_input($mail);
    //consulta con el usuario
    $DB=DWESBaseDatos::obtenerInstancia();
    $DB->ejecuta(
        "SELECT * FROM USER WHERE USERNAME = ?",
        $user
    );
    $consulta = $DB->obtenDatoUnico();
    if($consulta==""){
        $DB->ejecuta(
            'INSERT INTO USER (USERNAME, PASS, EMAIL) VALUES(?, ?, ?)',
            $user, password_hash($pass, PASSWORD_DEFAULT), $mail
        );
        if($DB->getExecuted()){
            $_SESSION["user"]=$user;
            Mailer::sendEmail(
                $mail,
                "Bienvenido a gaming town",
                "Population: ++1 OHHHHHHHHH YESS" 
            );
            header("Location: ".$paginaAnterior);
        }
    }
    else  
    $listaError["usuario"] ="Usuario ya existente";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <main class="main">
            <header>
                <h1>REGISTER</h1>
            </header>
            <div class="formulario">
                <form method="post">
                    <h3 class="titulos">USERNAME</h3>
                    <input type="text" name="username" id="username" value="<?= $user?>">
                        <?php if(isset($listaError["usuario"]))echo "<p class='error'>".$listaError["usuario"]."</p>";?>
                        <?php if(isset($listaError["usuarioVacio"]))echo "<p class='error'>".$listaError["usuarioVacio"]."</p>";?>
                    <h3 class="titulos">PASSWORD</h3>
                    <input type="password" name="pass" id="pass" value="<?= $pass?>">
                        <?php if(isset($listaError["pass"]))echo "<p class='error'>".$listaError["pass"]."</p>";?>
                        <?php if(isset($listaError["passVacio"]))echo "<p class='error'>".$listaError["passVacio"]."</p>";?>
                    <h3 class="titulos">EMAIL</h3>
                    <input type="email" name="mail" id="mail" value="<?= $mail?>">
                        <?php if(isset($listaError["mail"]))echo "<p class='error'>".$listaError["mail"]."</p>";?>
                        <?php if(isset($listaError["mailVacio"]))echo "<p class='error'>".$listaError["mailVacio"]."</p>";?>
                    <input type="submit" class="submit" value="enviar" name="submit">
                </form>
            </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>