<?php

$cabeza = ["lunes", "martes", "miercoles", "jueves", "viernes"];

$datos =[];
const NUMEROdatos = 11;

//meter datos en el array
for ($i=0; $i < count($cabeza); $i++) { 
    array_push($datos, "hola".$i);
}

function pintaCabecera($array){
    $cadena = "<tr>";
    foreach ($array as $key => $value) {
        $cadena .= "<th>".$value."</th>";
    }
    $cadena .="</tr>";
    return $cadena;
}
function pintaContenido($array){
    $cadena = "<tr>";
    foreach ($array as $key => $value) {
        $cadena .= "<td>".$value."</td>";
    }
    $cadena .="</tr>";
    return $cadena;
}
function pintaVacioHorario($dias, $horas){
    pintaCabecera($dias);
    for ($i=0; $i < NUMEROHORAS; $i++) { 
        pintaContenido($horas);
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
</head>
<body>
    <table>
        <?php
        echo pintaCabecera($cabeza);
        echo pintaContenido($datos);
        echo pintaContenido($datos);
        echo pintaContenido($datos);
        
        ?>
    </table>
</body>
</html>