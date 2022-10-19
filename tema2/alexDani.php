<?php 

//inicializacion
$array = [];
for ($i=0; $i < 20; $i++) { 
    $cosa = rand(0,100);
    array_push($array, $cosa);
    
}
//primera muestra
function mostrar($array){
    foreach($array as $Valor){
        echo "<div>$Valor </div>";
    }
}
function mostrarCortado($array){
    $cosa2 = array_slice( $array,count($array)/2);
    $cosa = array_slice( $array,0,count($array)/2);
    mostrar($cosa2);
    mostrar($cosa);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./csss/dani.css">
</head>
<body>
    <div class="pater">
        <?php 
        mostrar($array); 
        sort($array);
        mostrar($array);
        mostrarCortado($array);
        ?>
        
    </div>
</body>
</html>