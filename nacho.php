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
$dias = [
    "lunes",
    "martes",
    "miercoles",
    "jueves",
    "viernes",
];
$cont=0;
function asignar($tareas, $minions){
    $array = [[6],[1]];
    for($i=0;$i<count($tareas);$i++){
        $array[$i][0]=$i;
        $array[$i][1]=array_rand($minions, 1);
    }
    return $array;
}

$asignados = asignar($tareas, $minions);

function generar($tareas, $asignados, $minions){
    global $cont, $dias;
    echo "<div class='".$dias[$cont]."'>".$dias[$cont]."</div>";
    for ($i=0; $i < count($tareas); $i++) { 
        $clase = "";
        if($minions[$asignados[$i][1]] == "Oto") $clase = "oto";
        if($minions[$asignados[$i][1]] == "Bru") $clase = "gah";
        if($minions[$asignados[$i][1]] == "Gah") $clase = "bru";
        echo "<div class='".$clase."'>".$tareas[$asignados[$i][0]]." le corresponde ".$minions[$asignados[$i][1]]. "</div> ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./csss/nacho.css">
    <title>Document</title>
</head>
<body>
    <div class="pater">
        <?php for ($i=0; $i < 5; $i++) { 
            
            $asignados = asignar($tareas, $minions);
            generar($tareas, $asignados, $minions);
            $cont++;
        }
        ?>
    </div>
</body>
</html>