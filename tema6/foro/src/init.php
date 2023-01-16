<?php 

session_start();
$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";
require("config.php");

require("./vendor/autoload.php");
require("./clases/Mailer.php");


require("DWESBaseDatos.php");
require("varPaginaAnterior.php");
require("funcionLimpiar.php");
$DB=DWESBaseDatos::obtenerInstancia();
$DB->inicializa(
    $CONFIG["db_name"],
    $CONFIG["db_user"],
    $CONFIG["db_pass"]
);

?>