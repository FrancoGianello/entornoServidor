<?php

abstract class Campo{
    private $valorPost;
    private $error;
    private $name;
    abstract function pintar();
    function validarVacio(){
        $vacio = false;
        if(empty($this->valorPost)){
            $this->error = '<p class="error">está vacío</p><br/>';
            $vacio= true;
        }
        return $vacio;
    }
    //gets y sets
    function getValorPost(){
        return $this->valorPost;
    }
    function setValorPost($valorPost){
        $this->valorPost=$valorPost;
    }
    function getError(){
        return $this->error;
    }
    function setError($error){
        $this->error=$error;
    }
    function getName(){
        return $this->name;
    }
    function setName($name){
        $this->name=$name;
    }
}

?>