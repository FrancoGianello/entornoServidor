<?php

spl_autoload_register(function($class) {
    $path = "./";
    $file = str_replace("\\", "/", $class);
    require("$path${file}.php");
});

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
    <?php
        $examen1 = new ExamenFacil();
        $examen1->setFecha("hoy");
        echo "Soy muy facil! nota: ". $examen1->obtenerNota()." a fecha de: ".$examen1->getFecha(). "</br>";
        $examen2 = new ExamenChungo();
        $examen2->setFecha("ayer");
        echo "Soy chungo! nota: ". $examen2->obtenerNota()." a fecha de: ".$examen2->getFecha(). "</br>";
        $examen3 = new ExamenHP();
        $examen3->setFecha("siempre");
        echo "Tengo muchos padres! nota: ". $examen3->obtenerNota()." a fecha de: ".$examen3->getFecha(). "</br>";
    ?>
</body>
</html>