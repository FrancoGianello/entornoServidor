<?php

    try{
    $mbd = new PDO('mysql:host=localhost;dbname=mi_primer_db', "franco", "1234");
    }catch(PDOException $e){
        print($e->getMessage());
        die();
    }
    // try{
    //     $mbd = new PDO('mysql:host=localhost;dbname=examen', "examen", "examen");
    //     }catch(PDOException $e){
    //         print($e->getMessage());
    //         die();
    //     }

?>