<?php
require("./src/init.php");
if(isset($_SESSION["user"]))
    unset($_SESSION["user"]);
if(isset($_COOKIE["recuerdame"])){
    unset($_COOKIE["recuerdame"]);
    setcookie('recuerdame', null, -1);
} 
session_destroy();
header("Location: ".$paginaAnterior);
die();

?>