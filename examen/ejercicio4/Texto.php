<?php

class Texto extends Campo{
    function __construct($name){
        $this->setName($name);
    }
    function pintar(){
        echo $this->getName().': <input type="text" name="'.$this->getName().'" id="" value="'.$this->getValorPost().'"></input>';
    }
}


?>