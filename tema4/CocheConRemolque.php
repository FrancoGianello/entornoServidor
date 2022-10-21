<?php

    class CocheConRemolque extends Coche{
        private $capacidad_remolque;
        public function __construct($matricula, $marca, $carga,$capacidad_remolque=0){
            parent::__construct($matricula, $marca, $carga);
            $this->capacidad_remolque=$capacidad_remolque;
        }
        public function getCapacidad_remolque(){
            return $this->capacidad_remolque;
        }
        public function setCapacidad_remolque($capacidad_remolque){
            $this->capacidad_remolque=$capacidad_remolque;
        }
        public function pintarInformacion(){
           return parent::pintarInformacion()." remolque: ".$this->capacidad_remolque;
        }
    }

?>