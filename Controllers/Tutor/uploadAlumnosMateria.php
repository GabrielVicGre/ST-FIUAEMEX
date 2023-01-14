<?php
session_start();

include_once("../../Models/GrupoCRUD.php");
include_once("../../Models/TutorCRUD.php");
include_once("../../Models/AlumnoCRUD.php");
include_once("../../Models/AlumnosInscritosCRUD.php");
include_once("../../Models/MateriaCRUD.php");

$model_materia = new MateriaCRUD();
$model_grupo = new GrupoCRUD();
$model_tutor = new TutorCRUD();
$model_alumno = new AlumnoCRUD();
$model_alumnos_inscritos = new AlumnosInscritosCRUD();

$csv = fopen($_FILES['csv_file']['tmp_name'], "r");

// DATOS MATERIA
$id_materia = isset($_POST['id_materia'])?$_POST['id_materia']:0;  // Oculto
$nom_materia = isset($_POST['nom_materia'])?$_POST['nom_materia']:'-'; 
$clv_materia =isset($_POST['clv_materia'])?$_POST['clv_materia']:'-'; // oculto

$existe_materia = $model_materia->getExistenciaMateria($id_materia, $clv_materia, $nom_materia);

if($existe_materia == true){
    // ARRAY DATOS TUTOR
    $tutor = $model_tutor->getTutorByUserId($_SESSION['id_usuario']);

    // DATOS DEL GRUPO
    $nom_grupo = $_POST['grupo'];
    $id_grupo = $model_grupo->createNewGroupAndReturnId($nom_grupo,$tutor->id_tutor,$id_materia);


    //Ignora encabezados
    fgetcsv($csv, 1000, ",");
    while (($row = fgetcsv($csv, 1000, ",")) !== FALSE) {
        $no_cuenta = $row[0];
        //try {
            $alumno = $model_alumno->getAlumnoByNoCuenta($no_cuenta);
            $model_alumnos_inscritos->createNewgroupRegistration($alumno->id_alumno,$id_grupo);
        /*} catch(Exception $e) {
            
        }*/
    }
    fclose($csv);
    header("Location: ../../Views/Tutor/nuevo_grupo.php?msg=0");
}else{
    // NO EXISTE
    header("Location: ../../Views/Tutor/nuevo_grupo.php");
}