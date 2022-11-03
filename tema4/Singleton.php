<?php

    class Unico{
        public $nombre;
        private static $instance;
        public static function singleton(){
            if(!isset(self::$instance)){
                self::$instance = new Unico();
            }
            return self::$instance;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        private function __construct(){}
    }

?>