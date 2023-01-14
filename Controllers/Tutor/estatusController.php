<?php

include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/EntregaCRUD.php");
include_once ("../../Models/TutorCRUD.php");

class estatusController {
    private $model_alumno;
    private $model_entrega;
    private $model_tutor;

    function __construct(){
        $this->model_alumno = new AlumnoCRUD();
        $this->model_entrega = new EntregaCRUD();
        $this->model_tutor = new TutorCRUD();
    }

    function getAlumnos() {
        $tutor = $this->model_tutor->getTutorByUserId($_SESSION['id_usuario']);
        try{
            $alumnos = $this->model_alumno->getAlumnosByTutor($tutor->id_tutor);

            return $alumnos;
        } catch(Exception $e){
            return array();
        }
    }

    function getAlumnosPorGrupo($id_grupo) {
        try{
            $alumnos = $this->model_alumno->getAlumnosByIdGrupo($id_grupo);
            return $alumnos;
        } catch(Exception $e){
            return array();
        }
    }
}