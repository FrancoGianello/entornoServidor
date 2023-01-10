<?php
session_start();
include("./accesoBD.php");
include("./varPaginaAnterior.php");
include("./funcionLimpiar.php");

$user = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
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
        $consulta = $mbd->prepare("SELECT * FROM USER WHERE USERNAME = :USERNAME");
        $consulta->bindValue(":USERNAME", $user);
        $consulta->execute();
        $consulta = $consulta->fetch();
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
                    USERNAME
                    <input type="text" name="username" id="username" value="<?= $user?>">
                    <p><?php if(isset($listaError["usuario"]))echo $listaError["usuario"];?></p>
                    PASSWORD
                    <input type="text" name="pass" id="pass" value="<?= $pass?>">
                    <p><?php if(isset($listaError["pass"]))echo $listaError["pass"];?></p>
                    <input type="submit" value="enviar" name="submit">
                </form>
            </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>