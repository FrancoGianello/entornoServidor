<?php

$color = "#ffffff";
$font = "#000000";
$usuario = "anonimo";
if(isset($_COOKIE["bgColor"])) {
    $color = $_COOKIE["bgColor"];
}
if(isset($_COOKIE["fColor"])) {
    $font = $_COOKIE["fColor"];
}
if(isset($_COOKIE["nombre"])) {
    $usuario = $_COOKIE["nombre"];
}

?>