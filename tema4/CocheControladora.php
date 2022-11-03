<?php

    require('./Coche.php');
    require('./CocheConRemolque.php');
    require('./CocheGrua.php');
    require('./Singleton.php');
    $coches = [];

    $coche1 = new Coche("1000", "BMW", 30);
    $coche2 = new CocheConRemolque("1001", "Renault", 30, 200);
    $coche3 = new Coche("1003", "Porche", 40);
    $coche4 = new CocheGrua("1004", "Renault", 20);
    $coche5 = new CocheGrua("1005", "Toyota", 20);
    $coche6 = new CocheGrua("1006", "Audi", 20);
    $coche7 = new CocheGrua("1007", "Deez", 80, $coche6);
    $coche4->cargar($coche3);
    $coche5->cargar($coche2);
    array_push($coches, $coche1, $coche2, $coche4, $coche5, $coche6, $coche7);
    array_walk($coches, function($value, $key){
        print "<div>".$value->pintarInformacion()."</div>";
    });

    $single = Unico::singleton();
    $single->setNombre("hola");
    echo $single->getNombre();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            padding:0;
            margin:0;
            box-sizing:border-box;
            font-size:1.2rem;
        }
        body{
            display:grid;
            grid-template-columns:repeat(2,1fr);

        }
        div{
            border:1px solid black;
            padding:10px;
            display:flex;
            align-items:center;
            justify-content:center;
        }
    </style>
</head>
<body>
    
</body>
</html>