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
            echo "<section class='img-user'>";
            echo "<img src='".$this->img."' alt=''>";
            echo "<h4>Tema: <a href='tema.php?TEMA_NOMBRE=".$this->tema."' >".$this->tema."</a></h4>";
            echo "</section>";
            echo "<p>".$this->contenido."</p>";
            echo "<a href='post_detalle.php?ID_POST=".$this->ID_post."' >Comentarios: ".$this->contarNumeros($this->ID_post)."</a>";
            echo "</div>";
    }
    static function mostrarPosts($perfil, $pagina){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta(
            "SELECT * FROM POST WHERE USERNAME=? ORDER BY ID_POST DESC LIMIT ?, ?",
            [$perfil, $pagina*DWESBaseDatos::PAGINACION, DWESBaseDatos::PAGINACION]
        );
        $consulta = $DB->obtenDatos();
        foreach ($consulta as $value) {
            $objeto = new PostForoPerfil($value["ID_POST"], $value["CONTENIDO"], $value["TITULO"], $value["TEMA_NOMBRE"]);
            $DB->ejecuta("SELECT PFP FROM USER WHERE USERNAME=?", $value["USERNAME"]);
            $foto = $DB->obtenDatoUnico();
            $objeto->setImg($foto["PFP"]);
            $objeto->pintarObjetos();
        }
    }
    static function pintarBotones($perfil, $pagina){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta("SELECT COUNT(*) AS TOTAL FROM POST WHERE USERNAME = ?", $perfil);
        $consulta = $DB->obtenDatoUnico();
        $paginaFinal= ceil($consulta["TOTAL"]/DWESBaseDatos::PAGINACION);
        if($pagina!=0)
        echo "<a class='botones ' href='./perfil.php?USERNAME=".$perfil ."&PAGINA=".($pagina-1)."' >&#60;</a>";
        else echo "<p></p>";
        echo "<h3>Pagina ".($pagina)."</h3>";
        if($pagina+1<$paginaFinal)
        echo "<a class='botones ' href='./perfil.php?USERNAME=".$perfil ."&PAGINA=".($pagina+1)."' >&#62;</a>";
        else echo "<p></p>";
    }
    static function pintarBiografia($perfil){
        $DB=DWESBaseDatos::obtenerInstancia();
        $DB->ejecuta("SELECT PFP, DESCRIPCION FROM USER WHERE USERNAME = ?", $perfil);
        $consulta = $DB->obtenDatoUnico();
        $DB->ejecuta("SELECT PFP FROM USER WHERE USERNAME=?", $perfil);
        $foto = $DB->obtenDatoUnico();
        if($consulta["PFP"]!="")
        echo "<img src='".$consulta['PFP']."' alt='error'>";
        else
        echo '<img src="'.$foto["PFP"].'" alt="">';
        echo "<div>";
        echo "<h1>".$perfil."</h1>";
        echo "<p> ".$consulta["DESCRIPCION"]."</p>";
        echo "</div>";
    }
}

?>