<?php 

    class NumeroCuenta{
        private static $contador=100001;
        private $numeroCuenta;
        private $nombre;
        private $saldo;
        public function __construct($nombre = "anonimo", $saldo=0){
            $this->numeroCuenta= self::$contador++;
            $this->nombre=$nombre;
            $this->saldo =$saldo;
        }
        public function getNombre(){
            return $this->nombre;
        }
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getNumeroCuenta(){
            return $this->numeroCuenta;
        }
        public function setNumeroCuenta($numeroCuenta){
            $this->numeroCuenta=$numeroCuenta;
        }
        public function getSaldo(){
            return $this->saldo;
        }
        public function setSaldo($saldo){
            $this->saldo = $saldo;
        }
        public function ingresar($valor){
            $this->saldo+=$valor;
        }
        public function retirar($valor){
            $this->saldo-=$valor;
        }
        public function mostrar(){
            return "<div><p>Saldo: ".$this->saldo ." Nombre: ".$this->nombre." Nº cuenta: ". $this->numeroCuenta ."</p></div>";
        }
        public function transferir($cuenta, $valor){
            $this->saldo-=$valor;
            $cuenta->ingresar($valor);
        }
        public function unir($cuenta){
            $this->saldo+=$cuenta->getSaldo();
            $cuenta->setSaldo(0);
            $cuenta->setNumeroCuenta(-1);
            self::$contador--;
        }
        public function bancarrota(){
            $this->saldo=0;
        }
    }

    

?>