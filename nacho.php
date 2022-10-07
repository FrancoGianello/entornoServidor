<?php 
$tareas = [
    'Pelar mandarinas',
    'Comer comida',
    'Beber bebida',
    'Recoger título',
    'Cobrar salario',
    'Barrer casa',
    'Fregar casa',
    // Añade más
];
  
$minions = [
   'Oto',
   'Gah',
   'Bru',
   // Opcional
];
function walkear($tareas){
    array_walk($tareas, "asignar");
}
function asignar($tareas){
    $array = [[6],[1]];
    for($i;$i<count($tareas);$i++){
        $array[$i][0]=array_rand($tareas);
        $array[$i][1]=array_rand($minions);
    }
    return $array;
}
$asignados = asignar($tareas);
for ($i=0; $i < count($asignados); $i++) { 
    for ($i=0; $i < count($asginados.[$i]); $i++) { 
        
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
    
</body>
</html>