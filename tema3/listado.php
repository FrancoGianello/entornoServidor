<?php

$data = file_get_contents( "temazos.csv");
$lines = explode("\n", $data);
array_walk($lines, function($value){
    print "<div>$value</div> ";
});
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            display:grid;
            grid-template-columns:repeat(<?= ceil(count($lines)/2) ?>,1fr);
        }
        div{
            border:1px solid black;
            height:50px;
            text-align:center;
            padding:10px;
        }
    </style>
</head>
<body>
    
</body>
</html>