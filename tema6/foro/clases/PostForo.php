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
        $DB= DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "SELECT COUNT(*) as RESULTADO FROM COMMENT WHERE ID_POST = ?",
            $id
        );
        $contarNumeros = $DB->obtenDatos()[0];
        return $contarNumeros["RESULTADO"];
    }
    
}

?>