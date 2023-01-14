<?php
session_start();

include_once ("../../Models/MateriaCRUD.php");

$csv = fopen($_FILES['csv_file']['tmp_name'], "r");
$model_materia = new MateriaCRUD();

//Ignora encabezados
fgetcsv($csv, 1000, ",");

while (($row = fgetcsv($csv, 1000, ",") ) !== FALSE) {
    $materia = new Materia();
    $materia->clave = $row[0];
    $materia->nombre = $row[1];
    //echo $row[1];  
    $model_materia->createMateriaSinRetorno($materia);
}

fclose($csv);

header("Location: ../../Views/Administrador/cargar_informacion.php?tab=materias&msg=3");