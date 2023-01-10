<?php
abstract class PostForo
{
    public $ID_post;
    public $titulo;
    public $contenido;
    function __construct($ID_post, $titulo, $contenido){
        $this->ID_post=$ID_post;
        $this->titulo=$titulo;
        $this->contenido=$contenido;
    }
    abstract function pintarObjetos();
    function contarNumeros($id){
        include("./accesoBD.php");
        $contarNumeros = $mbd->prepare("SELECT COUNT(*) as RESULTADO FROM COMMENT WHERE ID_POST = :ID");
        $contarNumeros->bindValue(":ID", $id);
        $contarNumeros->setFetchMode(PDO::FETCH_ASSOC);
        $contarNumeros->execute();
        $contarNumeros = $contarNumeros->fetch();
        return $contarNumeros["RESULTADO"];
    }
}

?>