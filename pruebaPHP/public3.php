<?php
    require("src/init.php");

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
        if($usuario!="")
        echo "<h1>".$usuario."</h1>";
        else
        echo "<h1>Anonimo</h1>";
    ?>
    <h2>Para toos</h2>
    <h3>EL jugador en 3</h3>
</body>
</html>