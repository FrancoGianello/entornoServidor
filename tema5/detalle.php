<?php
    require("./accesoBD.php");
    if(isset($_GET["id"])){
        $id= $_GET["id"];
        $detalleCiclista = $mbd->prepare("SELECT * FROM Ciclistas where id=:id");
        $detalleCiclista->bindParam(':id' , $id);
        $detalleCiclista->execute();
        $datos = $detalleCiclista->fetch(PDO::FETCH_OBJ);
        if(!empty($datos)){
            echo "Detalle del ciclista de id " .$datos->id.": <br/>Nombre: ".$datos->nombre."<br/>Nº trofeos: ".$datos->num_trofeos." ";
            for ($i=0; $i < $datos->num_trofeos; $i++) 
                echo  "<i class='fa-solid fa-trophy'></i>";
        }else echo 'ERROR 404 data not found <i class="fa-solid fa-book-skull"></i>';
    }else{
        echo 'Esta página solo muestra el detalle <i class="fa-solid fa-skull-crossbones"></i>';
    }// Ya se ha terminado; se cierra
    $resultado = null;
    $mbd = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        *{
            font-size:40px;
            text-align:center;
        }
    </style>
</head>
<body>
    
</body>
</html>