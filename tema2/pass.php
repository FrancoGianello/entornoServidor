<?php
$usuarios = [
	"jorge" => "1234",
	"amparo" => "admin",
	"mary" => "",
];


function walkear($valor, $llave){
    echo "Usuario: $llave ";
    if($valor!="") echo "password: $valor";
    else echo "passwd: error";
    echo "<br/>";
}
function mostrar($array){
    array_walk($array, "walkear");
}

$array2 = array_map("mapeado", $usuarios);
function mapeado($cosa){
    $devolver = password_hash($cosa, PASSWORD_DEFAULT);
    return $devolver;
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
    <div class="pater">
        <?php 
        mostrar($usuarios);
        mostrar($array2);
        ?> 
    </div>
</body>
</html>