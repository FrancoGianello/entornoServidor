<?php
    require("src/init.php");
    
    $error="";
    if(isset($_POST["enviar"])){
        if(isset($_POST["nombre"]) && $_POST["nombre"]!="" && isset($_POST["pass"]) && isset($_POST["correo"])){
            $nombre = $_POST["nombre"];
            $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
            $correo = $_POST["correo"];
            $db->ejecuta(
                "INSERT INTO usuarios (nombre, passwd, img, correo, descripcion) values(?, ?, null, ?, null)",
                $nombre, $pass, $correo
            );
            if($db->getExecuted()){
                $db->ejecuta(
                    "SELECT * FROM usuarios WHERE nombre=?",
                    $nombre
                );
                $consulta = $db->obtenDatoUnico();
                $_SESSION["nombre"] = $nombre;
                $_SESSION["id"] = $consulta["id"];
                $_SESSION["correo"] = $consulta["correo"];
                header("Location: ".$paginaAnterior);
                die();
            }
            else{
                $error = "HA HABIDO ALGUN ERROR. oops";
            }
            
        }
        $error="falta algun campo creo";
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
<?= $error?>
    <?php
        if($usuario!="")
        echo "<h1>".$usuario."</h1>";
        else
        echo "<h1>Anonimo</h1>";
    ?>
    <h2>Registro</h2>
    <form action="" method="post">
        Nombre
        <input type="text" name="nombre" id="">
        Password
        <input type="text" name="pass" id="">
        correo
        <input type="text" name="correo">
        <input type="submit" value="enviar" name="enviar">
    </form>
</body>
</html>