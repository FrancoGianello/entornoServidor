<?php

    class Coche{

        //atributos
        private $matricula;
        private $marca;
        private $carga;

        //constructor
        public function __construct($matricula="deez", $marca="inmarcao", $carga=0){
            $this->matricula=$matricula;
            $this->marca=$marca;
            $this->carga=$carga;
        }

        //metodos
        public function getMatricula(){
            return $this->matricula;
        }
        public function setMatricula($matricula){
            $this->matricula=$matricula;
        }
        public function getmarca(){
            return $this->marca;
        }
        public function setmarca(){
            $this->marca=$marca;
        }
        public function getCarga(){
            return $this->carga;
        }
        public function setCarga($carga){
            $this->carga=$carga;
        }
        public function pintarInformacion(){
            return "Matricula: ".$this->matricula."<br/>Marca: ".$this->marca."<br/>Carga: ".$this->carga."</br>";
        }
    }

?>