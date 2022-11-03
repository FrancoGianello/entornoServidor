<?php 

    Class Usuario{
        //atributos
        private $nombre;
        private $apellido;
        private $deporte;
        private $nivel = 0;
        private $tipoUsuario;
        private const resultadosConsecutivos =6;
        private $contador =0;
        private $historial=[];
        
        //constructor
        public function __construct($nombre, $apellido, $deporte, $tipoUsuario){
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->deporte=$deporte;
            $this->tipoUsuario=$tipoUsuario;
            print "Usuario ". $this->nombre . " ". $this->apellido." creado <br/>";
        }
        //metodos

        public function subirDeNivel(){
            $var="ee";
            if($this->nivel==6) {
                $var= "eres faker no hay más <br/>" ;
            }else {
                $var= $this->nombre." ha subido de nivel <br/>";
                $this->nivel++;
            }
            $this->resultadosConsecutivos=0;
            print $var;
        }
        public function bajarDeNivel(){
            $var="";
            if($this->nivel==0) {
                $var= "oof, we gotta focus up";
            }else {
                $var= $this->nombre." ha bajado de nivel ". $this->nivel ." a nivel ".$this->nivel-1 . " ";
                $this->nivel--;
            }
            print $var;
            $this->resultadosConsecutivos=0;
        }
        public function introducirResultado(String $resultado){
            $mostrar="";
            if(!empty($this->historial)){
                if(strcmp($this->historial[count($this->historial)-1], $resultado)==0){
                    $this->contador++;
                    ($this->contador==self::resultadosConsecutivos-1)? $this->subirDeNivel() : $this->contador=0;
                }
            }
            print $this->nombre . " ". $resultado . " <br/>";
            array_push($this->historial, $resultado);
        }
        public function mostrarDatosUsuario(){
            print "<p class='info'>El usuario: ".$this->nombre . " ". $this->apellido . " practica el deporte: ".$this->deporte . " de nivel ".$this->nivel." </p>";
            $this->mostrarHistorial();
        }
        public function mostrarHistorial(){
            print "<ul > <b>HISTORIAL</b>";
            array_walk($this->historial, function($value, $key){
                print " <li class='info'> ". $value . "</li> ";
            });
            print "</ul>";
        }
    }    

?>