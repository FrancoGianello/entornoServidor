<?php
    try{
        $mbd = new PDO('mysql:host=localhost;dbname=examen', "examen", "examen");
        }catch(PDOException $e){
            print($e->getMessage());
            die();
        }
?>