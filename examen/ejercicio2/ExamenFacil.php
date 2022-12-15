<?php

class ExamenFacil extends Aexamen{
    const MINIMO = 5;
    const MAXIMO = 10;
    function obtenerNota():int{
        return (rand(self::MINIMO, self::MAXIMO));
    }
}

?>