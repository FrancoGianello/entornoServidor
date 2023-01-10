<?php
class PostForoDetalle extends PostForo
{
    public $tema;
    public $username;
    function __construct($ID_post, $contenido, $titulo,  $tema, $username){
        parent::__construct($ID_post, $titulo, $contenido);
        $this->tema=$tema;
        $this->username=$username;
    }
    function pintarObjetos(){
        echo "<div class='post'>";
        echo "<h2>".$this->titulo."</h2>";
        echo "<h4>Usuario: <a href='perfil.php?USERNAME=".$this->username."' >".$this->username."</a></h4>";
        echo "<h4>Tema: <a href='tema.php?TEMA_NOMBRE=".$this->tema."' >".$this->tema."</a></h4>";
        echo "<h4>ID_post:".$this->ID_post."</h4>";
        echo "<p>".$this->contenido."</p>";
        echo "<p>Comentarios: ".$this->contarNumeros($this->ID_post)."</p>";
        echo "</div>";
    }
    function pintarComentarios(){
        include("./accesoBD.php");
        $consultaAux = $mbd->prepare("SELECT * FROM COMMENT WHERE ID_POST = :ID");
        $consultaAux->bindValue(":ID", $this->ID_post);
        $consultaAux->setFetchMode(PDO::FETCH_ASSOC);
        $consultaAux->execute();
        foreach ($consultaAux as $value) {
            echo "<div class='comment'>";
            echo "<h4>Usuario: <a href='perfil.php?USERNAME=".$value["USERNAME"]."' >".$value["USERNAME"]."</a></h4>";
            echo "<p>".$value["CONTENIDO"]."</p>";
            echo "</div>";
        }
    }
    function insertarComentario($contenido, $username){
        include("./accesoBD.php");
        $inserccion = $mbd->prepare("INSERT INTO COMMENT(ID_POST, CONTENIDO, USERNAME) VALUES(:ID_POST, :CONTENIDO, :USERNAME)");
        $inserccion->bindValue(":ID_POST", $this->ID_post);
        $inserccion->bindValue(":CONTENIDO", $contenido);
        $inserccion->bindValue(":USERNAME", $username);
        $inserccion->execute();
    }
}

?>