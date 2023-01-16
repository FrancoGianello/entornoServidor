<?php
require("./src/init.php");
//variable de session

//variable para el post
$user ="";
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
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "SELECT * FROM USER WHERE USERNAME = ?",
            $user
        );
        $consulta = $DB->obtenDatoUnico();
        if($consulta==""){
            $DB->ejecuta(
                'INSERT INTO USER (USERNAME, PASS) VALUES(?, ?)',
                $user, password_hash($pass, PASSWORD_DEFAULT)
            );
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
                    <h2 class="titulos">USERNAME</h2>
                    <input type="text" name="username" id="username" value="<?= $user?>">
                    <?php if(isset($listaError["usuario"]))echo "<p>".$listaError["usuario"]."</p>";?>
                    <h2 class="titulos">PASSWORD</h2>
                    <input type="password" name="pass" id="pass" value="<?= $pass?>">
                    <input type="submit" class="submit" value="enviar" name="submit">
                </form>
            </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>