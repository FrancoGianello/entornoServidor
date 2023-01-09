<?php
try {
  $options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];
  $mbd = new PDO('mysql:host=localhost;dbname=mi_primer_db;charset=utf8mb4', "franco", "1234", $options);
  } 
  catch (PDOException $e){
    echo "putadoooon";
    die();
  }

?>