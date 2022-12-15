<?php

class ExamenChungo extends Aexamen{
    const MINIMO = 0;
    const MAXIMO = 7;
    function obtenerNota():int{
        return rand(self::MINIMO, self::MAXIMO);
    }
}

?>