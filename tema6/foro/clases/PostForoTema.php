<?php
class PostForoTema extends PostForo
{
    public $username;
    function __construct($ID_post, $contenido, $titulo, $username){
        parent::__construct($ID_post, $titulo, $contenido);
        $this->username=$username;
    }
    function pintarObjetos(){
            echo "<div class='post'>";
            echo "<h2>".$this->titulo."</h2>";
            echo "<h4>Usuario: <a href='perfil.php?USERNAME=".$this->username."' >".$this->username."</a></h4>";
            echo "<p>".$this->contenido."</p>";
            echo "<a href='post_detalle.php?ID_POST=".$this->ID_post."' >Comentarios: ".$this->contarNumeros($this->ID_post)."</a>";
            echo "</div>";
    }
    function insertarPost($tema){
        $DB=DWESBaseDatos::obtenerInstancia(); 
        $DB->ejecuta(
            "INSERT INTO POST(TEMA_NOMBRE, USERNAME, TITULO, CONTENIDO) VALUES(?,?,?,?)",
            [$tema, $this->username, $this->titulo, $this->contenido]
        );
    }
}

?>