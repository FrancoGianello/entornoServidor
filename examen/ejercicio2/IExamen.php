<?php

// Declare the interface 'Template'
interface IExamen
{
    public function intentar($nombre);
    public function obtenerNota():int;
}

?>