<?php 
$productos = [
    "naranja" => 1.2,
    "manzana" => 1.5,
    "pera" => 1.8,
    "platano" => 0.8,
    "kiwi" => 0.75,
    "macarrones" => 0.5,
    "arroz" => 0.75,
    "salchichas" => 1,
    "patatas_fritas" => 3,
    "paninis" => 1.5,
    "leche_6_uds" => 5,
    "pizza_jamon_serrano" => 2.59,
    "helado_chocolate" => 2.99
];

function pintaOutInputs($item, $key){
    echo "<span>$item ($key €)</span> <input name='$item' type='number' value=0><br>";
}
function pintaFactura(){

    echo "<tr><td>$filafactura[0]</td><td>$filafactura[1]</td><td>$filafactura[2]</td><td>" .$filafactura[1]*$filafactura[2] . "</td></tr>";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./csss/mario.css">
</head>
</head>
<body>
    <?php if(!$comprando) { ?>
        <h1>¡¡¡Ofertas!!!</h1>
        <form>
            <?php array_walk($productos, 'pintaOutInputs') ?>
            <input type="submit" value="¡Compra!">
        </form>
    <?php } else { ?>
        <h1>¡¡¡Comprando!!!</h1>
        <table>
            <tr><td>Producto</td><td>Cantidad</td><td>Precio</td><td>Subtotal</td></tr>
            <?php array_walk($factura, 'pintaFactura') ?>
            <tr><td colspan=4><?= array_reduce($factura, 'total') ?></td></tr>
        </table>
        <a href="ejercicio5.php">Volver a calcular</a>
    <?php } ?>
</body>
</html>