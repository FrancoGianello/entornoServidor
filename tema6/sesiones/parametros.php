<?php

session_name("francis");
session_start();

$color = "#ffffff";
$font = "#000000";
$usuario = "anonimo";
$intentos = 3;
$aciertos = 0;
$adivinar = random_int(0, 10);
if(isset($_SESSION["bgColor"])) {
    $color = $_SESSION["bgColor"];
}
if(isset($_SESSION["fColor"])) {
    $font = $_SESSION["fColor"];
}
if(isset($_SESSION["nombre"])) {
    $usuario = $_SESSION["nombre"];
}
if(isset($_SESSION["intentos"])) {
    $intentos = $_SESSION["intentos"];
}
if(isset($_SESSION["aciertos"])) {
    $aciertos = $_SESSION["aciertos"];
}
if(isset($_SESSION["adivinar"])) {
    $adivinar = $_SESSION["adivinar"];
}
?>