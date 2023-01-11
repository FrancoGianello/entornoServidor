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
        include("./accesoBD.php");
        $inserccion = $mbd->prepare("INSERT INTO POST(TEMA_NOMBRE, USERNAME, TITULO, CONTENIDO) VALUES(:TEMA_NOMBRE, :USERNAME, :TITULO, :CONTENIDO)");
        $inserccion->bindValue(":TEMA_NOMBRE", $tema);
        $inserccion->bindValue(":USERNAME", $this->username);
        $inserccion->bindValue(":TITULO", $this->titulo);
        $inserccion->bindValue(":CONTENIDO", $this->contenido);
        $inserccion->execute();
    }
}

?>