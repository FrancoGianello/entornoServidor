<?php 

    class CocheGrua extends Coche{
        private $cocheCargado;
        public function __construct($matricula, $marca, $carga,$cocheCargado=null){
            parent::__construct($matricula, $marca, $carga);
            $this->cocheCargado=$cocheCargado;
        }
        public function getCocheCargado()
        {
                return $this->cocheCargado;
        }
        public function setCocheCargado($cocheCargado)
        {
                $this->cocheCargado = $cocheCargado;

                return $this;
        }
        public function cargar($cocheCargado){
            $this->cocheCargado=$cocheCargado;
        }
        public function descargar(){
            $this->cocheCargado=null;
        }
        public function pintarInformacion(){
            $aux="";
            ($this->cocheCargado==null)? $aux="niguno" : $aux=$this->cocheCargado->pintarInformacion();
            return parent::pintarInformacion()." ------>Coche cargado: <br/>".$aux;
        }
    }

?>