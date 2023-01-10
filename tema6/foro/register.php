<?php
session_start();
include("./accesoBD.php");
include("./varPaginaAnterior.php");
include("./funcionLimpiar.php");

$user = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
$pass ="";
$listaError =[];
if(isset($_POST["submit"])){
    if(isset($_POST["username"]) && $_POST["pass"]!=""){
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
        if($consulta==""){
            $insertar = $mbd->prepare('INSERT INTO USER (USERNAME, PASS) VALUES(:USER, :PASS)');
            $insertar->bindParam(":USER", $user);
            $insertar->bindParam(":PASS", password_hash($pass, PASSWORD_DEFAULT));
            $insertar->execute();
            session_start();
            $_SESSION["user"]=$user;
            header("Location: ".$paginaAnterior);
        }
        else  
        $listaError["usuario"] ="Usuario ya existente";
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
                <h1>REGISTER</h1>
            </header>
            <div class="formulario">
                <form method="post">
                    USERNAME
                    <input type="text" name="username" id="username" value="<?= $user?>">
                    <p><?php if(isset($listaError["usuario"]))echo $listaError["usuario"];?></p>
                    PASSWORD
                    <input type="text" name="pass" id="pass" value="<?= $pass?>">
                    <input type="submit" value="enviar" name="submit">
                </form>
            </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>