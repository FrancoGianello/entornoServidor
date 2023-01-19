<?php
$DB=DWESBaseDatos::obtenerInstancia();
$usuarioToken="";
if(isset($_COOKIE["recuerdame"])){
    $DB->ejecuta(
        "SELECT * FROM TOKEN WHERE VALOR=?",
        $_COOKIE["recuerdame"]
    );
    $datosToken = $DB->obtenDatoUnico();
    $idToken = $datosToken["ID_USER"];
    if($idToken!=""){
        $DB->ejecuta(
            "SELECT * FROM USER WHERE ID_USER=?",
            $idToken
        );
        if($DB->getExecuted()){
            $usuarioToken = $DB->obtenDatoUnico();
            $_SESSION["user"] = $usuarioToken["USERNAME"];
        }
    }
}


?>