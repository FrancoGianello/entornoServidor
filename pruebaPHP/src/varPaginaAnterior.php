<?php
$paginaAnterior = (isset($_SESSION["anterior"]))? $_SESSION["anterior"]:"";
//no se como controlarlo por ahora.
//lo dejo asi de momento: mientras no sea login ni register, no me actualices $session anterior
if($_SERVER["REQUEST_URI"]!="/login.php" && $_SERVER["REQUEST_URI"]!="/register.php" ) $_SESSION["anterior"] = $_SERVER["REQUEST_URI"];
?>