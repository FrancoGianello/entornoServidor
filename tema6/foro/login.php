<?php
session_start();
include("./accesoBD.php");
include("./varPaginaAnterior.php");
include("./funcionLimpiar.php");

$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
$pass ="";
$url ="";
$listaError=[];
if(isset($_POST["submit"])){
    if(isset($_POST["username"]) && isset($_POST["pass"])){
        //inicializar usuario
        $username = $_POST["username"];
        $username = clean_input($username);
        $pass = $_POST["pass"];
        $pass = clean_input($pass);
        //consulta con el usuario
        $consulta = $mbd->prepare("SELECT * FROM USER WHERE USERNAME = :USERNAME");
        $consulta->bindValue(":USERNAME", $username);
        $consulta->execute();
        $consulta = $consulta->fetch();
        if($consulta!=""){
            if(password_verify($pass, $consulta['PASS'])){
                $_SESSION["user"]=$username;
                header("Location: ".$paginaAnterior);
            }
            else 
            array_push($listaError, "Contraseña incorrecta");
        }
        else  
        array_push($listaError, "Usuario no existe");
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
                    USERNAME
                    <input type="text" name="username" id="username" value="<?= $username?>">
                    PASSWORD
                    <input type="text" name="pass" id="pass" value="<?= $pass?>">
                    <input type="submit" value="enviar" name="submit">
                </form>
            </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>