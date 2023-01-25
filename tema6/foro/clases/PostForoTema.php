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
            echo "<section class='img-user'>";
            echo "<img src='".$this->img."' alt=''>";
            echo "<h4>Usuario: <a href='perfil.php?USERNAME=".$this->username."' >".$this->username."</a></h4>";
            echo "</section>";
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
    
    static function pintarBotones($tema, $pagina){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta("SELECT COUNT(*) AS TOTAL FROM POST WHERE TEMA_NOMBRE = ?", $tema);
        $consulta = $DB->obtenDatoUnico();
        $paginaFinal= ceil($consulta["TOTAL"]/DWESBaseDatos::PAGINACION);
        if($pagina!=0)
        echo "<a class='botones ' href='./tema.php?TEMA_NOMBRE=".$tema ."&PAGINA=".($pagina-1)."' >&#60;</a>";
        else echo "<p></p>";
        echo "<h3>Pagina ".($pagina)."</h3>";
        if($pagina+1<$paginaFinal)
        echo "<a class='botones ' href='./tema.php?TEMA_NOMBRE=".$tema ."&PAGINA=".($pagina+1)."' >&#62;</a>";
        else echo "<p></p>";
    }
    static function mostrarPosts($tema, $pagina){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "SELECT * FROM POST WHERE TEMA_NOMBRE = ? ORDER BY ID_POST DESC LIMIT ?, ?", 
            [$tema, $pagina*DWESBaseDatos::PAGINACION, DWESBaseDatos::PAGINACION]
        );
        $consulta = $DB->obtenDatos();
        foreach ($consulta as $value) {
            $post = new PostForoTema($value["ID_POST"], $value["CONTENIDO"], $value["TITULO"], $value["USERNAME"]);
            $DB->ejecuta("SELECT PFP FROM USER WHERE USERNAME=?", $value["USERNAME"]);
            $foto = $DB->obtenDatoUnico();
            $post->setImg($foto["PFP"]);
            $post->pintarObjetos();
        }
    }
}

?>