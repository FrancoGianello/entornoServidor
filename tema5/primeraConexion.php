<?php
    require("./accesoBD.php");
    if(isset($_POST["crear"])){
        //Consulta auxiliar
        (comprobarSiIdExiste($mbd))? update($mbd): insertar($mbd);
    }
    // Utilizar la conexión aquí
    if(isset($_GET["ordenar"])){
        //Consulta auxiliar
        $resultadoAux = $mbd->query('SELECT * FROM Ciclistas');
        $resultadoAux->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($resultadoAux as $fila)$columna = array_search($_GET["ordenar"], array_keys($fila))+1;
        $resultado = $mbd->prepare('SELECT * FROM Ciclistas ORDER BY :orden ASC');
        // $resultado = $mbd->prepare('SELECT * FROM Ciclistas ORDER BY :orden :numerico');
        $resultado->bindValue(':orden', $columna, PDO::PARAM_INT);
        // if(is_numeric($_GET["ordenar"]))$resultado->bindValue(':numerico', "ASC");
    }
    else $resultado = $mbd->prepare('SELECT * FROM Ciclistas');
    $resultado->setFetchMode(PDO::FETCH_ASSOC);
    $resultado->execute();


    function comprobarSiIdExiste($mbd){
        $resultadoAux = $mbd->query('SELECT * FROM Ciclistas');
        $resultadoAux->setFetchMode(PDO::FETCH_ASSOC);
        $idExiste=false;
        foreach ($resultadoAux as $fila) {
            foreach ($fila as $key => $value) {
                if($key=="id" && $value==$_POST["id"]) $idExiste=true;
            }
        }
        return $idExiste;
    }
    function insertar($mbd){
        $insertar = $mbd->prepare('INSERT INTO Ciclistas (id, nombre, num_trofeos) VALUES(:id, :nombre, :trofeos)');
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $trofeos = $_POST['num_trofeos'];
        $insertar->bindParam(":id", $id);
        $insertar->bindParam(":nombre", $nombre);
        $insertar->bindParam(":trofeos", $trofeos);
        $insertar->execute();
    }
    function update($mbd){
        $cambiar = $mbd->prepare('UPDATE Ciclistas SET nombre=:nombre, num_trofeos=:trofeos WHERE id=:id');
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $trofeos = $_POST['num_trofeos'];
        $cambiar->bindParam(":id", $id);
        $cambiar->bindParam(":nombre", $nombre);
        $cambiar->bindParam(":trofeos", $trofeos);
        $cambiar->execute();
    }
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
            padding:0px;
            margin:0px;
        }
        .padre{
            width:100vw;
            height:100vh;
            display:grid;
            grid-template-columns: repeat(2 ,1fr);
        }
        .padre>div{
            border:1px solid black;
            display:flex;
            justify-content:center;
            align-items:center;
            font-size:20px;
        }
        .cabeza{
            background-color:grey;
        }
        .añadir{
            grid-column: 1 / 3;
            display:flex;
            gap:20px;
        }
    </style>
</head>
<body>
    <div class="padre">
        <?php
        $primeraFila =true;
        foreach ($resultado as $fila){
            if($primeraFila) foreach ($fila as $key => $value)if($key!="id")echo '<div class="cabeza"><p>'.$key.' </p><form method="GET"action="" ><input type="submit" value="'.$key.'" name="ordenar"></form></div>';
            $primeraFila=false;
            $numeroFilas = count($fila)-1;
            $id=$fila["id"];
            if($key!="id"){
                echo '<div> <a href="detalle.php?id='.$id.'">'.$fila["nombre"].'</a></div>';
                echo '<div>';
                for ($i=0; $i < $fila["num_trofeos"]; $i++) { 
                    echo  "<i class='fa-solid fa-trophy'></i>";
                }
                echo "(".$fila["num_trofeos"].')</div>';
                }
            }
            // Ya se ha terminado; se cierra
            $resultado = null;
            $mbd = null;
        ?>
        <div class="añadir">
            <p>AÑADIR CICLISTA: </p>
            <form action="" method="POST">
                ID<input type="number" required name="id" id="idCiclista">
                Nombre<input type="text" required name="nombre" id="nombreCiclista">
                Trofeos<input type="number"required  name="num_trofeos" id="trofeosCiclista">
                <input type="submit" value="crear" name="crear">
            </form>
        </div>
    </div>
</body>
</html>