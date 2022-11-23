<?php

$temazo ="";
$hora = date("h");
$minuto = date("i");

$opcionesMinuto = [0,15,30,45];


$mayores = array_filter($opcionesMinuto, function($m){
    global $minuto;
    return $m > $minuto;
});

print_r($mayores);
if(empty($mayores)){
    $minuto=0;
    $hora++;
}else $minuto = array_shift($mayores);

//comprobar si envia la info

$errores = [];
if(isset($_POST['enviar'])){
    if(isset($_POST['temazo']) && $_POST['temazo']!=""){
        $temazo = $_POST['temazo'];
    }else{
        $errores['temazo'] = 'NO puede estar vacío';
    }
    if(isset($_POST['hora']) && $_POST['hora']!=""){
        $hora = $_POST['hora'];
    }else{
        $errores['hora'] = 'NO puede estar vacío';
    }
    if(isset($_POST['minuto']) && $_POST['minuto']!=""){
        $minuto = $_POST['minuto'];
    }else{
        $errores['minuto'] = 'NO puede estar vacío';
    }
    if(count($errores)==0){
        //guardar info
        file_put_contents(
            "temazos.csv",
            "$temazo;$hora;$minuto \n",
            FILE_APPEND
        );
        //redirect
        header("Location: listado.php");
        exit();
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
    <style>
        .error{
            color:red;
            margin-bottom:10px;
        }
        input{
            margin-bottom:10px;
        }
    </style>
</head>
<body>
    <h1>Never ending party</h1>
    <form action="" method="post">
        Tema musical:<input type="text" name="temazo" id="cancion" value="<?= $temazo?>" placeholder="pon tu temazo"><br/>
        <?php
            if(count($errores)>0){
                print "<div class='error'>";
                print '<span>'.$errores['temazo']. '</span><br/>';
                print "</div>";
            }
        ?>
        <br/>
        Hora:<input type="number" max="23" min="0" name="hora" id="cancion" value="<?= $hora?>">
        Minutos:
        <select name="minuto" id="">
            <?php

            array_walk(
                $opcionesMinuto, function($op, $k, $d){
                $sel = ($op==$d)? 'selected':"";
                print "<option  value= '$op ' $sel>$op</option>";
            },$minuto);

            ?>
        </select><br/>
        <input type="submit" value="enviar" name="enviar">
    </form>
</body>
</html>