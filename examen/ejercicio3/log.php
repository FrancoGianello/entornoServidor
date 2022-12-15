<?php

require("./accesoBD.php");

$consulta = $mbd->prepare('SELECT * FROM Logs');
$consulta->setFetchMode(PDO::FETCH_ASSOC);
$consulta->execute();

function pintarDatos($consulta){
    $filaPrimera = true;
    foreach ($consulta as $clave => $fila) {
        if($filaPrimera){
            pintarPrimeraFila($fila);
            $filaPrimera=false;
        }
        echo "<tr>";
        array_walk($fila, function($key, $value){
            // if($value=="timestamp"){
            //     $key=date('d M y h:m:s', $key);
            // }
            echo "<td>".$key."</td>";
        });
        echo "</tr>";
    }
}

function pintarPrimeraFila($fila){
    $cabeceras = array_keys($fila);
    echo "<tr>";
    array_walk($fila, function($key, $value){
        echo "<td>".$value."</td>";
    });
    echo "</tr>";
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
    <main>
        <table>
            <?php 
                pintarDatos($consulta);
                $mbd=null;
                $consulta=null;
            ?>
        </table>
        <a href="index.php">Volver a introduccion de datos</a>
    </main>
</body>
</html>