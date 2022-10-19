<?php
function cargar(){
    for($i=0;$i<12;$i++){
        $num = rand(0,10);
        echo "<div class='cosa'>$num</div>";
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
    <link rel="stylesheet" href="./csss/cssBingo.css">
    <script src="./js/jsBingo.js" defer></script>
</head>
<body>
    <nav id="numero"></nav>
    <div class="pater">
        <?php cargar()?>
        <button onclick="comprobar()" >COMPROBAR</button>
        <?php cargar()?>
    </div>

</body>
</html>