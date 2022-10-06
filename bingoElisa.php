<?php
    //proporciona array de n posiciones aleatorias ordenadas
    function generaValoresAleatorios ($inicioSerie,$finSerie,$numeroDeValores){
        $serieAleatoria=[];
        for ($i=$inicioSerie; $i <=$finSerie ; $i++) {
            $serieAleatoria[$i]="";
        }
        return array_rand($serieAleatoria,$numeroDeValores);
    }
    //cuenta los ceros en una fila
    function cuentaCeros($array){
        return array_count_values($array)[0];
    }
    //devuelve array con posibles posiciones
    function generaPosiciones($array,$aleatorias){
        $arrayPosiciones=[];
        for ($i=0; $i <count($array) ; $i++) {
            if (in_array($i,$aleatorias)&& $array[$i]==0 ||((!(in_array($i,$aleatorias))&& $array[$i]!=0))) {
                array_push($arrayPosiciones,$i);
            }
         }
         return $arrayPosiciones;
    }
    //coloca ceros en la fila del medio
    function ceros2(&$matriz,$arrayPosiciones){
        $veces=4-cuentaCeros($matriz[1]);
        //coge las columnas disponibles de manera alternativa para introducir 0 sin crear columnas repetidas
            for ($i=0,$j=0; $j <count($arrayPosiciones),$i<$veces;$i++, $j=$j+2) {
                $posicion=$arrayPosiciones[$j];
                $matriz[1][$posicion]=0;
            }
    }
    //evalua los valores de la tercera fila
    function teceraFila(&$matriz,$arrayPosiciones){
        for ($i=0; $i <count($arrayPosiciones) ; $i++) {
            $posicion=$arrayPosiciones[$i];
           $matriz[2][$posicion]=($matriz[1][$posicion]==0)?$matriz[2][$posicion]:0;
        }
    }
  
    //genera un carton de bingo
    function generaCarton(){
        $carton=[];
        $aleatorias=generaValoresAleatorios(0,8,4);
        for ($i=0; $i <3 ; $i++) {
            $carton[$i]=generaValoresAleatorios(1,90,9);
        }
        primeraPasada($carton,$aleatorias);
        $arrayPosiciones=generaPosiciones($carton[0],$aleatorias);
        ceros2($carton,$arrayPosiciones);
        teceraFila($carton,$arrayPosiciones);
        return $carton;
    }
    //hace cosas pero no se pq
    function primeraPasada(&$matriz,$aleatorias){
        for ($i=0; $i <count($aleatorias) ; $i++) {
            $posicion=$aleatorias[$i];
            $matriz[0][$posicion]=0;
        }
    }
    //imprime el carton
    function imprimeCarton($carton){
        for ($i=0; $i <3 ; $i++) {
            for ($j=0; $j <9 ; $j++) {
                echo "<div class='cosa'>";
                 if(comprobarHueco($carton[$i][$j])){echo $carton[$i][$j];}
                 echo "</div>";
            }
            
        }
   }
   function comprobarHueco($dato){
    $comprobante = true;
        if($dato==0){
            $comprobante=false;
        }
        return $comprobante;
   }
    //genera un carton y lo imprime
    $carton=generaCarton();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./csss/cssElisa.css">
    <title>Document</title>
</head>
<body>
    <div class="max">
        <?php imprimeCarton($carton) ?>
    </div>
</body>
</html>