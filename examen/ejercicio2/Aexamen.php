<?php


abstract class Aexamen implements IExamen{
    use TieneFecha;
    private $nombre;
    function intentar($nombre){
        $this->nombre = $nombre;
    }
}

?>