<?php
session_start();
//$ruta =  $_SERVER['DOCUMENT_ROOT'].'/SistemaTutoriaFIUAEMex';
include_once ("../../Models/UsuarioCRUD.php");
include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/LicenciaturaCRUD.php");

$csv = fopen($_FILES['csv_file']['tmp_name'], "r");

$model_usuario = new UsuarioCRUD();
$model_alumno = new AlumnoCRUD();
$model_licenciatura = new LicenciaturaCRUD();

//Ignora encabezados
fgetcsv($csv, 1000, ",");

while (($row = fgetcsv($csv, 1000, ",")) !== FALSE) {

    $usuario = new Usuario();
    $usuario->email = $row[5];
    //$usuario->password = RandPswd();
    $usuario->password = $row[2];
    $usuario->id_tipo_usuario = 3;

    $id_usuario = $model_usuario->createUsuario($usuario);

    $alumno = new Alumno();
    $alumno->nombre = $row[3];
    $alumno->no_cuenta = $row[2];
    $alumno->id_usuario = $id_usuario;
    $alumno->id_licenciatura = $model_licenciatura->getLicenciaturaBySiglas($row[1])->id_licenciatura;

    $model_alumno->createAlumno($alumno);
}

fclose($csv);

header("Location: ../../Views/Administrador/cargar_informacion.php?tab=alumnos&msg=0");

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

