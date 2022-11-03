<?php

    require('./Usuario.php');
    $jugador1 = new Usuario("Juan", "Gomez", "furbo", "Ordinario");
    $jugador1->introducirResultado('W');
    $jugador1->introducirResultado('W');
    $jugador1->introducirResultado('W');
    $jugador1->introducirResultado('W');
    $jugador1->introducirResultado('W');
    $jugador1->introducirResultado('W');
    
    $jugador1->introducirResultado('W');

    $jugador1->mostrarDatosUsuario();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/usuario.css">
</head>
<body>
    
</body>
</html>