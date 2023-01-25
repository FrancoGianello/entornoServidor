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
        echo "<section class='img-user'>";
        echo "<img src='".$this->img."' alt=''>";
        echo "<h4>Usuario: <a href='perfil.php?USERNAME=".$this->username."' >".$this->username."</a></h4>";
        echo "</section>";
        echo "<h4>Tema: <a href='tema.php?TEMA_NOMBRE=".$this->tema."' >".$this->tema."</a></h4>";
        echo "<h4>ID_post:".$this->ID_post."</h4>";
        echo "<p>".$this->contenido."</p>";
        echo "<p>Comentarios: ".$this->contarNumeros($this->ID_post)."</p>";
        echo "</div>";
    }
    function pintarComentarios($pagina){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "SELECT * FROM COMMENT WHERE ID_POST = ? ORDER BY ID_COMMENT DESC LIMIT ? , ?",
            [$this->ID_post,  $pagina*DWESBaseDatos::PAGINACION, DWESBaseDatos::PAGINACION]
        );
        $consulta = $DB->obtenDatos();
        foreach ($consulta as $value) {
            
            echo "<div class='comment'>";
            echo "<h4>Usuario: <a href='perfil.php?USERNAME=".$value["USERNAME"]."' >".$value["USERNAME"]."</a></h4>";
            echo "<p>".$value["CONTENIDO"]."</p>";
            echo "</div>";
        }
    }
    function insertarComentario($contenido, $username){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "INSERT INTO COMMENT(ID_POST, CONTENIDO, USERNAME) VALUES(?, ?, ?)",
            [$this->ID_post, $contenido, $username]
        );
    }
    static function pintarBotones($id, $pagina){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta("SELECT COUNT(*) AS TOTAL FROM COMMENT WHERE ID_POST = ?", $id);
        $consulta = $DB->obtenDatoUnico();
        $paginaFinal= ceil($consulta["TOTAL"]/DWESBaseDatos::PAGINACION);
        if($pagina!=0)
        echo "<a class='botones ' href='./post_detalle.php?ID_POST=".$id ."&PAGINA=".($pagina-1)."' >&#60;</a>";
        else echo "<p></p>";
        echo "<h3>Pagina ".($pagina)."</h3>";
        if($pagina+1<$paginaFinal)
        echo "<a class='botones ' href='./post_detalle.php?ID_POST=".$id ."&PAGINA=".($pagina+1)."' >&#62;</a>";
        else echo "<p></p>";
    }
    static function crearObjetoPost($id){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta("SELECT * FROM POST WHERE ID_POST = ?", $id);
        //de [0] porque es un fetchall, cambiar en otro momento
        $value = $DB->obtenDatoUnico();
        $objeto = new PostForoDetalle(
            $value["ID_POST"], 
            $value["CONTENIDO"], 
            $value["TITULO"],
            $value["TEMA_NOMBRE"], 
            $value["USERNAME"]
        );
        $objeto->inicializarImagen($value["USERNAME"]);
        return $objeto;
    }
    function inicializarImagen($username){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta("SELECT PFP FROM USER WHERE USERNAME=?", $username);
        $foto = $DB->obtenDatoUnico();
        if($foto["PFP"]!="")
        $this->setImg($foto["PFP"]);
        else
        $this->setImg("./images/otros.jpg");
    }
}

?>