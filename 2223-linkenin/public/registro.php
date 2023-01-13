<?php
require("../src/init.php");

$insertado = false;
if(isset($_POST["submit"])){
    $DB->ejecuta(
        "INSERT INTO usuarios(nombre, passwd, correo) VALUES (?,?,?)",
        $_POST["user"],
       password_hash($_POST["password"], PASSWORD_DEFAULT),
        $_POST["correo"]
    );
    $insertado = $DB->getExecuted();
}
if($insertado){
    Mailer::sendEmail(
        $_POST["correo"],
        "NUEVO GAMER",
        "contenido contenido"
    );
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
    <?php
        if(!$insertado) {?>
        <h1>Registro</h1>
        <form action="registro.php" method="post">
            Nombre:<input type="text" name="user" id="">
            Contraseña<input type="password" name="password" id="">
            email<input type="email" name="correo" id="">
            <input type="submit" name="submit" value="enviar">
        </form>
    <?php } 
        else echo "<h2>mola</h2>";
    ?>
</body>
</html>