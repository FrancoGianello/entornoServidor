<?php
require("./src/init.php");
//variable de session
if( isset($username) &&$username!="") header("Location: perfil.php?username=".$username);
//variable para el post
$listaError =[];

$user = (isset($_POST["username"]))? $_POST["username"]:"";
$pass =(isset($_POST["pass"]))? $_POST["pass"]:"";

if(isset($_POST["submit"])){
    ($user=="")?$listaError["usuarioVacio"]="Usuario debe estar relleno":"";
    ($pass=="")?$listaError["passVacio"]="Contraseña debe estar rellena":"";
}
if(!count($listaError)>0 && isset($_POST["submit"])){
    //limpiar datos
    $user = clean_input($user);
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
            $_SESSION["id"]=$consulta["ID_USER"];
             //si ha pedido recuerdame
            if(isset($_POST["recuerdame"]) && $_POST["recuerdame"]=="on"){    
            $token = bin2hex(random_bytes(32));
            $DB->ejecuta(
                "INSERT INTO TOKEN (ID_USER, VALOR) VALUES(?,?)",
                $_SESSION["id"],
                $token
            );
            setcookie(
                "recuerdame",
                $token,
                [
                    "expires"=>time() +(7*24*60*60),
                    //"secure"=>true,
                    "httponly"=>true
                ]
            );
            //generar token
            //guardar token
            //cookie con token
    
            }
            header("Location: ".$paginaAnterior);
        }
        else 
        $listaError["pass"] = "Contraseña incorrecta";
    }
    else  
    $listaError["usuario"] = "Usario no existe";
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
                        <?php if(isset($listaError["usuario"]))echo "<p class='error'>".$listaError["usuario"]."</p>";?>
                        <?php if(isset($listaError["usuarioVacio"]))echo "<p class='error'>".$listaError["usuarioVacio"]."</p>";?>
                    <h2 class="titulos">PASSWORD</h2>
                    <input type="password" name="pass" id="pass" value="<?= $pass?>">
                        <?php if(isset($listaError["pass"])) echo "<p class='error'>".$listaError["pass"]."</p>";?>
                        <?php if(isset($listaError["passVacio"]))echo "<p class='error'>".$listaError["passVacio"]."</p>";?>
                    <div class="recuerdame">
                        <input type="checkbox" name="recuerdame" id="recuerdame">
                        <label for="recuerdame">Recuerdame</label>
                    </div>
                    <input type="submit" class="submit" value="enviar" name="submit">
                </form>
            </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>