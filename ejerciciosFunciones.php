<?php 

function concatenar(string $separador, string ...$cadenas): string
{
    $salida = "";
    foreach ($cadenas as $k => $cadena) 
    {
        $salida.=(($k ==0)?"":$separador).$cadena;
    }
    return $salida;
}

echo concatenar(" ","hola","que","tal", "queeeeeee");

function asociar(...$cosa)
{
    $clave ="";
    $array=[];
    $contador=1;
    foreach ($cosa as $key => $value) 
    {
        $clave= gettype($value);
        $array[$clave];
        (array_key_exists($clave, $array))?$array[$clave]+=$contador : $array[$clave]=$contador;
    }
    return $array;    
}
function cambiar($valor1, $valor2){
    $aux = $valor1;
    $valor1=$valor2;
    $valor2=$aux;
    echo "$valor2 ha sido cambiado por $valor1 y viceversa";
}
function arrayRandom(
    $cantidad = 10,
    $max = 10,
    $min = 0 
    )
{
    $array = [];
    for ($i=0; $i < $cantidad; $i++) 
    { 
        array_push($array, mt_rand($min, $max));
    }
    return $array;
}
function mostrar($array)
{
    echo "<br/>";
    foreach ($array as $value) {
        echo "$value ";
    }
}
function arrayTipos(...$valores)
{
    $contador = 1;
    foreach ($valores as &$valor) {
        $tipo = gettype($valor);
        switch ($tipo) {
            case 'integer':
                $valor = pow($valor, $contador);
                $contador++;
                break;
            case 'double':
                    $valor = $valor * -1;
                    break;
            case 'string':
                for ($i=0; $i < strlen($valor); $i++) { 
                    (ctype_upper($valor[$i]))?$valor[$i]=strtolower($valor[$i]) : $valor[$i]=strtoupper($valor[$i]);
                }
                break;
                    
            default:
                
                break;
        }
    }
    return $valores;
}
echo "<br/>";
//ejercicio 8
print_r(asociar("hola", 2, false, true, 3.2, "geee"));
//ejercicio 9
echo "<br/>valores a cambiar: 5 y 'a'<br/>";
cambiar(5, "a");
//ejercicio 10
//sin parámetros
mostrar(arrayRandom());
//con algunos parámetros
mostrar(arrayRandom(4));
//todos los parámetros
mostrar(arrayRandom(4, 100, 10));
//ejercicio 11
mostrar(arrayTipos(20, 5, 3.1, "hoLazzaaZ", 3, -10.1));
?>