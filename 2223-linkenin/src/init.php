<?php 
require("config.php");
require("../vendor/autoload.php");

require("DWESBaseDatos.php");
require("Mailer.php");
$DB=DWESBaseDatos::obtenerInstancia();
$DB->inicializa(
    $CONFIG["db_name"],
    $CONFIG["db_user"],
    $CONFIG["db_pass"]
);
CONST LONG_TOKEN = 64;
session_start();

?>