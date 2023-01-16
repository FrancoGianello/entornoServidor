<?php
require("./src/init.php");
//variable de session
if( isset($username) &&$username!="") header("Location: perfil.php?username=".$username);
//variable para el post
$user="";
$pass ="";
$url ="";
$listaError=[];
if(isset($_POST["submit"])){
    if(isset($_POST["username"]) && isset($_POST["pass"])){
        //inicializar usuario
        $user = $_POST["username"];
        $user = clean_input($user);
        $pass = $_POST["pass"];
        $pass = clean_input($pass);
        //consulta con el usuario
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "SELECT * FROM USER WHERE USERNAME = ?",
            $user
        );
        $consulta = $DB->obtenDatoUnico();
        if($consulta!=""){
            if(password_verify($pass, $consulta['PASS'])){
                $_SESSION["user"]=$user;
                header("Location: ".$paginaAnterior);
            }
            else 
            $listaError["pass"] = "Contraseña incorrecta";
        }
        else  
        $listaError["usuario"] = "Usario no existe";
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
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <main class="main">
            <header>
                <h1>LOGIN</h1>
            </header>
            <div class="formulario">
                <form method="post">
                    <h2 class="titulos">USERNAME</h2>
                    <input type="text" name="username" id="username" value="<?= $user?>">
                    <?php if(isset($listaError["usuario"]))echo "<p>".$listaError["usuario"]."</p>";?>
                    <h2 class="titulos">PASSWORD</h2>
                    <input type="password" name="pass" id="pass" value="<?= $pass?>">
                    <?php if(isset($listaError["pass"])) echo "<p>".$listaError["pass"]."</p>";?>
                    <input type="submit" class="submit" value="enviar" name="submit">
                </form>
            </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>