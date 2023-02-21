<?php
    require("src/init.php");
    $db->ejecuta("SELECT * FROM usuarios");
    $usuarios = ($db->obtenDatos());

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
    <h1>ESTE ES EL INDEX SIUUUUUUUUU</h1>
    
    <?php
        if($usuario!="")
        echo "<h1>".$usuario."</h1>";
        else
        echo "<h1>Anonimo</h1>";
    ?>
    <nav>
        <a href="public.php"> public </a>
        <a href="public2.php"> public2 </a>
        <a href="public3.php"> public3</a>
        <a href="private1.php"> private1 </a>
        <a href="login.php"> login </a>
        <a href="register.php">register</a>
    </nav>
    <br>
    <?php
        foreach ($usuarios as $key => $value) {
            echo "<p>Nombre del usuario: ".$value["nombre"]."</p>";
            echo "<p>Email: ".$value["correo"]."</p><br>";
        }


    ?>
</body>
</html>