<?php
    require('./claseCirculo.php');
    $a = new Circulo();
    $a->setRadio(20);
    echo $a->getRadio();
    echo " ".$a->getArea();
?>