<?php 
$cosas = [
    3,
    "frutas"  => ["a" => "naranja", "b" => [1, 2], "c" => "manzana"],
    "números" => [1, 2, 3, 4, 5, 6],
    "hoyos"   => ["primero", 5 => "segundo", "tercero"],
    "asd"
];
foreach ($cosas as $key => $value) 
{
    if(gettype($value)!='array'){
        echo $value;
    }else
    while(gettype($value)=='array')
    {
        print_r($value);
    }
}

?>