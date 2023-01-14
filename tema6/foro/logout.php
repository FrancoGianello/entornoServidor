<?php
require("./src/init.php");
echo $paginaAnterior;
if(isset($_SESSION["user"]))
    unset($_SESSION["user"]);
session_destroy();
header("Location: ".$paginaAnterior);
die();

?>