<?php
class PostForoPerfil extends PostForo
{
    public $tema;
    function __construct($ID_post, $contenido, $titulo,  $tema){
        parent::__construct($ID_post, $titulo, $contenido);
        $this->tema=$tema;
    }
    function pintarObjetos(){
            echo "<div class='post'>";
            echo "<h2>".$this->titulo."</h2>";
            echo "<h4>Tema: <a href='tema.php?TEMA_NOMBRE=".$this->tema."' >".$this->tema."</a></h4>";
            echo "<h4>ID_post:".$this->ID_post."</h4>";
            echo "<p>".$this->contenido."</p>";
            echo "<a href='post_detalle.php?ID_POST=".$this->ID_post."' >Comentarios: ".$this->contarNumeros($this->ID_post)."</a>";
            echo "</div>";
    }
}

?>