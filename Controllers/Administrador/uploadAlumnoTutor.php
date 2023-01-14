<?php
session_start();

include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/TutorCRUD.php");

$csv = fopen($_FILES['csv_file']['tmp_name'], "r");

$model_alumno = new AlumnoCRUD();
$model_tutor = new TutorCRUD();

//Ignora encabezados
fgetcsv($csv, 1000, ",");

while (($row = fgetcsv($csv, 1000, ",")) !== FALSE) {
    $cve_tutor = $row[5];
    $no_cuenta = $row[2];

    $alumno = $model_alumno->getAlumnoByNoCuenta($no_cuenta);
    $tutor = $model_tutor->getTutorByCveTutor($cve_tutor);

    $alumno->id_tutor = $tutor->id_tutor;

    $model_alumno->updateAlumnoTutor($alumno->id_alumno, $alumno->id_tutor);
}

fclose($csv);

header("Location: ../../Views/Administrador/cargar_informacion.php?tab=alumno-tutor&msg=2");