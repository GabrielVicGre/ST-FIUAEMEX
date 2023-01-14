<?php

/*$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root . "/SistemaTutoriaFIUAEMex/Views/Graphics/Displayable.php");*/

require 'Displayable.php';


/**
 * Grados para el formato condicional.
 */
/*
enum grade {
    case LOW;
    case HIGH;
}
*/
Class PercentBar implements Displayable{
    /**
     * Valor del relleno de la barra de porcentaje.
     * 
     * @var int
     */
    public $value;

    /**
     * Grado del formato condicional.
     * "low" es menor o igual a 50 y "high" es mayor a 50.
     * 
     * @var string;
     */
    public $grade;

    /**
     * Constructora de barra de porcentaje.
     * 
     * Crea una nueva barra de porcentaje con base en el valor dado.
     * 
     * @param int $value Valor de porcentaje que se desea mostrar entre 0 y 100.
     * 
     * @return PercentBar
     */
    function __construct($value) {
        $this -> value = $value;

        //$this->grade = $value > 50 ? grade::HIGH : grade::LOW;
        $this->grade = $value > 50 ? "HIGH" : "LOW";
    }

    /**
     * Implementacion de metodo abstracto.
     * 
     * Implementacion del metodo display de la interfaz Displayable. 
     * Renderiza la imagen de la barra de porcentaje considerando el formato condicional.
     */
    function display() {
        ?>
            <div class="percent-bar percent-bar-<?php echo $this->grade == "HIGH" ? "high" : "low"; ?>">
                <div class="percent-fill percent-fill-<?php echo $this->grade == "HIGH" ? "high" : "low"; ?>" 
                style="width:<?php echo $this -> value; ?>%">
                    <?php echo $this -> value; ?>%
                </div>
            </div>
        <?php
    }
}

