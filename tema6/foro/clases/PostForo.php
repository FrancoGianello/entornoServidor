<?php
abstract class PostForo
{
    public $ID_post;
    public $titulo;
    public $contenido;
    public $img = "https://picsum.photos/100";
    function __construct($ID_post, $titulo, $contenido){
        $this->ID_post=$ID_post;
        $this->titulo=$titulo;
        $this->contenido=$contenido;
    }
    abstract function pintarObjetos();
    static abstract function pintarBotones($var, $pagina);
    function contarNumeros($id){
        $DB= DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "SELECT COUNT(*) as RESULTADO FROM COMMENT WHERE ID_POST = ?",
            $id
        );
        $contarNumeros = $DB->obtenDatoUnico();
        return $contarNumeros["RESULTADO"];
    }
    
    public function getImg()
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }
}

?>