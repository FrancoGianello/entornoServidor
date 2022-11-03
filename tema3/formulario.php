<?php
print_r($_SERVER);
echo "<hr>";
print_r($_GET);
echo "<hr>";
print_r($_POST);
echo "<hr>";
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
    <form action="" method="post">
        <input type="text" name="nombre"><br/>
        Sexo: <br/>
        Hombre: <input type="radio" name="sexo" value="H">
        Mujer:<input type="radio" name="sexo" value="M">
        Otros:<input type="radio" name="sexo" value="O">
        <br/>
        Color favorito: <input type="color" name="colorFavorito"><br/>
        <br/>
        <input type="number"><br/>
        <textarea name="area" id="" cols="30" rows="10"></textarea><br/>
        <input type="submit" name="submit" value="enviar">
    </form>
</body>
</html>