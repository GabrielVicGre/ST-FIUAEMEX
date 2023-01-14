<?php
session_start();

include_once ("../../Models/UsuarioCRUD.php");
include_once ("../../Models/TutorCRUD.php");
include_once ("../../Models/LicenciaturaCRUD.php");

$csv = fopen($_FILES['csv_file']['tmp_name'], "r");

$model_usuario = new UsuarioCRUD();
$model_tutor = new TutorCRUD();
$model_licenciatura = new LicenciaturaCRUD();

//Ignora encabezados
fgetcsv($csv, 1000, ",");

while (($row = fgetcsv($csv, 1000, ",")) !== FALSE) {

    $usuario = new Usuario();
    $usuario->email = $row[4];
    //$usuario->password = RandPswd();
    $usuario->password = $row[2];
    $usuario->id_tipo_usuario = 2;

    $id_usuario = $model_usuario->createUsuario($usuario);

    $tutor = new Tutor();
    $tutor->nombre = $row[3];
    $tutor->cve_tutor = $row[2];
    $tutor->id_usuario = $id_usuario;
    $tutor->id_licenciatura = $model_licenciatura->getLicenciaturaBySiglas($row[1])->id_licenciatura;

    $model_tutor->createTutor($tutor);
}

fclose($csv);

header("Location: ../../Views/Administrador/cargar_informacion.php?tab=tutores&msg=1");

function RandPswd() {
    //Genera una contraseña aleatoria de 5 letras y 5 numeros. ej. lsizy64738

    $n = 5;
    $pswd = "";

    //Letras
    for($i = 0; $i < $n; $i++) {
        $pswd .= chr(rand(97,122));
    }

    //Numeros
    for($i = 0; $i < $n; $i++) {
        $pswd .= chr(rand(48,57));
    }

    return $pswd;
}

