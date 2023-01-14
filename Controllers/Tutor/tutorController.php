<?php

include_once ("../../Models/TutorCRUD.php");
include_once ("../../Models/UsuarioIniciar.php");
include_once ("../../Models/LicenciaturaCRUD.php");

class tutorController {
    private $model_tutor;
    private $model_Usuario;
    private $model_licenciatura;

    function __construct() {
        $this->model_Usuario = new UsuarioIniciar();
        $this->model_tutor = new TutorCRUD();
        $this->model_licenciatura = new LicenciaturaCRUD();
    }

    function getDatosUsuarioTutor($id_user) {
        //return $this->model_Usuario->getDatosDeUsuarioTutor($id_user);
        return $this->model_tutor->getTutorByUserId($id_user);
    }

    function getDatosLicById($id_lic){
        $datosLic = $this->model_licenciatura->getLicenciaturaById($id_lic);
        return $datosLic->siglas.' - '.$datosLic->nombre;
    }


}