
<?php

try {
    $mbd = new PDO('mysql:host=localhost;dbname=mi_primer_db', "franco", "1234");

    // Utilizar la conexión aquí
    $resultado = $mbd->query('SELECT * FROM Ciclistas');
    echo "<div class='padre'>";
    $primeraFila =true;
    foreach ($resultado as $fila){
      foreach ($fila as $clave => $valor){
        if($primeraFila) foreach ($fila as $key => $value)if(!is_numeric($key)) echo "<div>".$key."</div>";
        if(!is_numeric($clave))echo "<div> " . $valor . "</div>";
        $numeroFilas = count($fila);
        $primeraFila=false;
        }
    }  
    echo "</div>";
    // Ya se ha terminado; se cierra
    $resultado = null;
    $mbd = null;

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "\n";
    die();
}

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
            padding:0px;
            margin:0px;
        }
        .padre{
            width:100vw;
            height:100vh;
            display:grid;
            grid-template-columns: repeat(<?php echo $numeroFilas/2?>, 1fr);
        }
        .padre>div{
            border:1px solid black;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:20px;
        }
        .padre div:nth-child(1), .padre div:nth-child(2), .padre div:nth-child(3){
            background-color:grey;

        }
    </style>
</head>
<body>
    
</body>
</html>