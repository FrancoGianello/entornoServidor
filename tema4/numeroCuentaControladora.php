<?php 
    require("./claseNumeroCuenta.php");
    $cosa = new NumeroCuenta("franco", 100);
    $hola = new NumeroCuenta();
    echo $cosa->mostrar();
    echo $hola->mostrar();
    echo "<hr>";
    $cosa->transferir($hola, 50);
    echo $cosa->getSaldo();
    echo "<br/>";
    echo $hola->getSaldo();
    $cosa->transferir($hola, 20);
    echo "<br/>";
    echo $cosa->getSaldo();
    echo "<br/>";
    echo $hola->getSaldo();
    echo "<hr/>";
    $hola->unir($cosa);
    echo $hola->mostrar();
    echo $cosa->mostrar();
?>
