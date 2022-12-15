<?php

class CheckBox extends Campo{
    private $valor;
    function __construct($name, $valor){
        $this->setName($name);
        $this->valor = $valor;
    }
    public function pintar()
    {
        print '<div class="checkbox__' . $this->getName() . '">';
        $checked ="";
        foreach ($this->valor as $value) {
            //si el post no está vacío, compruebo si el valor que voy recorriendo está en el post
            if(!empty($this->getValorPost())) {
                (in_array($value, $this->getValorPost()))? $checked = "checked" : $checked = "";
            }
            print '<label for="' . $this->getName() . '"><input type="checkbox" id="' .$value . '" name="' . $this->getName() . '[]" value="' .$value . '" '.$checked.'>' . $value. '</label>';
        }
        print '</div>';
    }
}

?>