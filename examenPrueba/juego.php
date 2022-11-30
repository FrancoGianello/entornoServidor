<?php
    function obtenerDatos(){
        if(empty($_POST)){
            file_put_contents("serializado.csv", '"*","*","*";"*","*","*";"*","*","*";');
        }
        $leer = file_get_contents("serializado.csv");
        $filas = explode(";", $leer);
        $tabla =[];
        for ($i=0; $i < count($filas)-1; $i++) { 
            $casillas = explode(",", $filas[$i]);
            array_push($tabla, $casillas);
        }
        return $tabla;
    }
    function actualizarDatos(array $tabla){
        $cadena ="";
        for ($i=0; $i < count($tabla); $i++) { 
            $cadena .= implode(",", $tabla[$i]).";";
        }
        file_put_contents("serializado.csv", $cadena);
    }
    function pintarTabla(){
        $tabla = obtenerDatos();
        if(isset($_POST["posx"]) &&isset($_POST["posy"])){
            $ejeX= $_POST["posx"]-1;
            $ejeY=$_POST["posy"]-1;
            if($tabla[$ejeX][$ejeY]=='"*"'){
                $tabla[$ejeX][$ejeY]=$_POST["turno"];
            }
            actualizarDatos($tabla);
        }
        for ($i=0; $i < count($tabla); $i++) { 
            echo "<tr>";
            for ($j=0; $j < count($tabla[$i]); $j++) { 
                echo "<td>".$tabla[$i][$j]."</td>";
            }
            echo "</tr>";
        }
    }
    function comprobar(array $tabla){
        $ganado = false;
        for ($i=0; $i < count($tabla); $i++) { 
            for ($j=0; $j < count($tabla[$i]); $j++) { 
                if($)
            }
        }
    }
?>

<html>
<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css">
  <title>3 en Raya</title>
</head>
<body>
  <h1>3 en raya</h1>
  <table>
    <?php
        pintarTabla();
    ?>  
  </table>
  <div class="error">
    Esto es un texto de error
  </div>
  <div class="error">
    Jugador AAA ha ganado
    <a href="">Juego nuevo</a>
  </div>
  <form action="" method="post">
      turno:
      <select name="turno">
        <option value="X">X</option>
        <option value="O">O</option>
      </select>
      <br>
      x: <input type="text" name="posx" value=""><br>
      y: <input type="text" name="posy" value=""><br>
      <input type="hidden" name="tablero" value="TODO_PONER_VALOR"><br>
      <button type="submit" name="submit">Jugar</button>
  </form>
</body>
</html>
