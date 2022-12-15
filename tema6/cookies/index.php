<?php

$claro = isset($_COOKIE['claro'])?$_COOKIE['claro']:0;
setcookie("galleta", "chichahoy");
setcookie("claro", $claro + 1);
print_r($_COOKIE);

// header("Location: redireccion.php");
// //LAS REDIRECCIONES HAN DE MOSTRAR CUALQUIER TIPO DE CONTENIDO
// die();

?>