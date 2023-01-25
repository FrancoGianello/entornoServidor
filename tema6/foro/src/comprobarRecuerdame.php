<?php
$DB=DWESBaseDatos::obtenerInstancia();
$usuarioToken="";
if(!isset($_SESSION["user"]) || $_SESSION["user"]==""){
    if(isset($_COOKIE["recuerdame"])){
        $DB->ejecuta(
            "SELECT * FROM USER WHERE ID_USER=(SELECT ID_USER FROM TOKEN WHERE VALOR=? AND EXPIRACION>NOW())",
            $_COOKIE["recuerdame"]
        );
        $tokenInfo = $DB->obtenDatoUnico();
        if($tokenInfo!=null){
            $_SESSION["user"] = $tokenInfo["USERNAME"];
            $_SESSION["id"] = $tokenInfo["ID_USER"];
            //ampliar vida de la cookie
            setcookie(
                "recuerdame",
                $_COOKIE["recuerdame"],
                [
                    "expires"=>time() +(7*24*60*60),
                    //"secure"=>true,
                    "httponly"=>true
                ]
            );
            //ampliar la vida del token
            $DB->ejecuta(
                "UPDATE TOKEN SET EXPIRACION= NOW() + INTERVAL 7 DAY WHERE VALOR=?",
                $_COOKIE["recuerdame"]
            );

        }
    }
}

?>