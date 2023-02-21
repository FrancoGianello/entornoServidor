<?php

    $usuario = (isset($_SESSION["nombre"]))? $_SESSION["nombre"]:"";
    $idUsuario = (isset($_SESSION["id"]))?$_SESSION["id"]:"";
    $correo = (isset($_SESSION["correo"]))?$_SESSION["correo"]:"";

?>