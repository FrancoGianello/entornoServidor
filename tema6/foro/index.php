<?php
session_start();
include("./varPaginaAnterior.php");
$username = (isset($_SESSION["user"]))? $_SESSION["user"]:"";

function pintarTemas(){
    include("./accesoBD.php");
    $consulta = $mbd->prepare('SELECT * FROM TEMA');
    $consulta->setFetchMode(PDO::FETCH_ASSOC);
    $consulta->execute();
    foreach ($consulta as $value){
        echo "<div style=' background-image: url"."(./images/".$value["TEMA_NOMBRE"].".jpg)"."' class='tema ".$value['TEMA_NOMBRE']."'>";
        echo "<div class='texto'>";
        echo "<h2 ><a class='titulo ' href='tema.php?TEMA_NOMBRE=".$value['TEMA_NOMBRE']."'>". $value['TEMA_NOMBRE']."</a></h2>";
        echo "<p>".$value['DESCRIPCION']."</p>";
        echo "</div>";
        echo "</div>";
    }
}


$bienvenida = ($username!="")? $username:"ANONIMO";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin:0px;
            padding:0px;
            box-sizing:border-box;
        }
        a{
            text-decoration:none;
            color:white;
            transition: all 0.1s ease-in;
        }
        a:hover{
            color:red;
        }
        .main{
            height:100vh;
            width:100vw;
            display:grid;
            grid-template-rows:1fr 10fr 1fr;
        }
        header{
            border-bottom:1px solid black;
            color:white;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-flow: column;
        }
        .nav, header{
            text-align:center;
            background-color:black;
        }
        .nav{
            border-top:1px solid black;
            display:flex;
            justify-content:space-evenly;
            align-items:center;
        }
        .temas{
            display:grid;
            grid-template-columns:repeat(2, 1fr);
        }
        .tema{
            border:1px solid black;
            display:flex;
            justify-content:center;
            align-items:center;
            flex-flow:column;
        }
        .texto{
            display:flex;
            justify-content:center;
            align-items:center;
            flex-flow:column;
            background: rgba(0, 0, 0, 0.5);
            width:50%;
        }
        .texto>*{
            color:white;
        }
        .nav>a{
            font-size: 24px;
        }
    </style>
</head>
<body>
    <main class="main">
        <header class="encabezado">
            <h1>BIENVENIDO <?=$bienvenida ?></h1>
        </header>
        <div class="temas">
            <?php 
                pintarTemas();
            ?>
        </div>
        <?php include("./navegador.php"); ?>
    </main>
</body>
</html>