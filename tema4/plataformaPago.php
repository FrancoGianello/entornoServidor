<?php

    interface PlataformaPago
    {
        public function establecerConexion():bool;
        public function compruebaSeguridad():bool;
        public function pagar(string $cuenta, int $cantidad);
    }
    
    class BancoMalvado implements PlataformaPago{
        public function establecerConexion():bool{
            $conectado = true;
            print "Conexión BancoMalvado <br/>" ;
            return $conectado;
        }
        public function compruebaSeguridad():bool{
            $conectado = true;
            print "Conexión segura BancoMalvado <br/>" ;
            return $conectado;
        }
        public function pagar(string $cuenta, int $cantidad){
            print "Pago de BancoMalvado de".$cantidad." a ".$cuenta." <br/>";
        }
    }
    class BitCoinConan implements PlataformaPago{
        public function establecerConexion():bool{
            $conectado = true;
            print "Conexión BitCoinConan <br/>" ;
            return $conectado;
        }
        public function compruebaSeguridad():bool{
            $conectado = true;
            print "Conexión segura BitCoinConan <br/>" ;
            return $conectado;
        }
        public function pagar(string $cuenta, int $cantidad){
            print "Pago de BitCoinConan de " .$cantidad." a ".$cuenta." <br/>";
        }
    }
    class BancoMaloMalisimo implements PlataformaPago{
        public function establecerConexion():bool{
            $conectado = true;
            print "Conexión BancoMaloMalisimo <br/>" ;
            return $conectado;
        }
        public function compruebaSeguridad():bool{
            $conectado = true;
            print "Conexión segura BancoMaloMalisimo <br/>" ;
            return $conectado;
        }
        public function pagar(string $cuenta, int $cantidad){
            print "Pago de BancoMaloMalisimo de ".$cantidad." a ".$cuenta." <br/>";
        }
    }
    
    
    
    function randomClase(){
        $random = mt_rand(1,3);
        $variable = "";
        if($random==1) $variable = new BancoMalvado();
        else if($random==2) $variable = new BitCoinConan();
        else if($random==3) $variable = new BancoMaloMalisimo();
        return $variable;
    }
    $variable = randomClase();
    $variable->pagar("hola", 20);
    print get_class($variable);
?>