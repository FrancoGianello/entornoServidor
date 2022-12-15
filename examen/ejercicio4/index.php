<?php
spl_autoload_register(function($class) {
    $path = "./";
    $file = str_replace("\\", "/", $class);
    require("$path${file}.php");
});

print_r($_POST);
$texto1 = new Texto("nombre",);
$texto2 = new Texto("direccion");
$checkbox = new CheckBox("extras", ["Caja madera","Tarjeta regalo", "Envio urgente", "Panecillos"]);

$arrayObjetos=[];
array_push($arrayObjetos, $texto1);
array_push($arrayObjetos, $texto2);
array_push($arrayObjetos, $checkbox);
if(isset($_POST["generar"])){
    foreach ($arrayObjetos as $key => $value) {
        $value->setValorPost($_POST[$value->getName()]);
        $value->validarVacio();
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
        }
    </style>
</head>
<body>
    <main>
        <form action="" method="post">
            <?php
            $controlar = true;
                foreach ($arrayObjetos as $key => $value) {
                    $value->pintar();
                    echo "<br/>";
                    echo $value->getError();
                    if($controlar)
                    $controlar = $value->validarVacio();
                    
                }
                if(!$controlar) echo "MUCHAS GGRACIAS";
            ?>
            <input type="submit" value="generar" name="generar">
        </form>
    </main>
</body>
</html>