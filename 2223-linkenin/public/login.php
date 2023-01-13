<?php
require("../src/init.php");


if(isset($_POST["submit"])){
    //Recoger los datos de post
    //consulta a bases de datos por el usuario
    //verificar la contraseña
    $nombre = $_POST["nombre"];
    $passwd = $_POST["passwd"];
    $recuerdame = $_POST["recuerdame"];
    $DB->ejecuta("SELECT id, nombre, passwd FROM usuarios where nombre=?", $_POST["nombre"]);
    $user = $DB->obtenDatos()[0];

    if(password_verify($_POST["passwd"], $user["passwd"])){
        $_SESSION["id"] = $user["id"];
        $_SESSION["nombre"] = $user["nombre"];

        //si ha pedido recuerdame
        if(isset($_POST["recuerdame"]) && $_POST["recuerdame"]=="on"){    
        $token = bin2hex(openssl_random_pseudo_bytes(LONG_TOKEN));
        $DB->ejecuta(
            "INSERT INTO tokens (id_usuario, valor) VALUES(?,?)",
            $_SESSION["id"],
            $token
        );
        setcookie(
            "recuerdame",
            $token,
            [
            "expires"=>time() +(7*24*60*60),
                //"secure"=>true,
            "httponly"=>true]
        );
        //generar token
        //guardar token
        //cookie con token

        }
    }else echo "mostrar error";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>login</h1>
    <form action="" method="post">
        user: <input type="text" name="nombre" id="" value="<?=$nombre ?>">
        password: <input type="password" name="passwd" value="<?=$passwd ?>" id="">
        recuerdame: <input type="checkbox" name="recuerdame" id="">
        <input type="submit" name="submit" value="enviar">
    </form>
</body>
</html>