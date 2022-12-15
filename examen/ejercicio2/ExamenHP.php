<?php

class ExamenHP extends Aexamen{
    const MINIMO = 4;
    const MAXIMO = 5;
    function obtenerNota():int{
        return rand(self::MINIMO, self::MAXIMO);
    }
}

?>