<?php

include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/TutorCRUD.php");
include_once ("../../Models/UsuarioIniciar.php");
include_once ("../../Models/LicenciaturaCRUD.php");

class alumnoController {
    private $model;
    private $model_Usuario;
    private $model_tutor;
    private $model_licenciatura;

    function __construct() {
        $this->model = new AlumnoCRUD();
        $this->model_Usuario = new UsuarioIniciar();
        $this->model_tutor = new TutorCRUD();
        $this->model_licenciatura = new LicenciaturaCRUD();
    }

    function getAlumnoData() {
        $id_usuario = $_SESSION['id_usuario'];
        return $this->model->getAlumnoByUserId($id_usuario);
    }

    function getDatosUsuarioAlumno($id_user) {
        return $this->model_Usuario->getDatosDeUsuarioAlumno($id_user);
    }

    function getDatosTutorDeAlumno($id_alumno){
        //return $this->model_Usuario->getDatosTutorDeAlumno($id_user);
        return $this->model_tutor->getTutorByAlumno($id_alumno);
    }

    function getLicenciaturaAlumno($alumno) {
        $licenciatura = $this->model_licenciatura->getLicenciaturaById($alumno->id_licenciatura);
        return $licenciatura->siglas.' - '. $licenciatura->nombre;
    }
}