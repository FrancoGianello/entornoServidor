<?php

include("parametros.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilo.css">
    <style>
        .color{
            background-color:<?php echo $color ?>;
        }
        *{
            color:<?php echo $font ?>
        }
    </style>
</head>
<body>
    <main class="main">
        <div class="texto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam repellendus sed dicta tenetur blanditiis impedit voluptate repudiandae animi eveniet debitis!</div>
        <div class="color">
            <h1>Color: <?php echo $color?></h1>
        </div>
        <?php
        include("./menu.php");
        ?>
    </main>    
</body>
</html>