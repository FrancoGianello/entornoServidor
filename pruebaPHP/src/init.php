<?php
require("config.php");
require("DWESBaseDatos.php");

$db = DWESBaseDatos::obtenerInstancia();
$db->inicializa(
    $CONFIG["db_name"],
    $CONFIG["db_user"],
    $CONFIG["db_pass"]
);

session_start();
require("varPaginaAnterior.php");
require("privateArea.php");
print_r($_SERVER)
?>