<?php

//include_once("../../Models/AlumnoProfesor.php");
//include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/AlumnosInscritosCRUD.php");
include_once ("../../Models/TutorCRUD.php");

class AlumInscritosController {
   // private $model_alumno_profesor;
   // private $model_alumno;
    private $model_alumnos_inscritos;
    private $model_tutor;

    function __construct(){
        //$this->model_alumno_profesor = new AlumnoProfesorCRUD();
     //   $this->model_alumno = new AlumnoCRUD();
        $this->model_alumnos_inscritos = new AlumnosInscritosCRUD();
        $this->model_tutor = new TutorCRUD();
    }

    function getMateriasTutorByIdUser($id_usuario){
        $tutor = $this->model_tutor->getTutorByUserId($id_usuario);
        $materiasAndGrupos = $this->model_tutor->getMateriasByIdTutor($tutor->id_tutor);
        return $materiasAndGrupos;
    }

    function getNumAlumnPerGroup($id_grupo){
        $total = $this->model_alumnos_inscritos->getNumAlumPerGroup($id_grupo);
        return $total;
    }

    function deleteGroupAndAlumInscritos($id_grupo){
       $this->model_alumnos_inscritos->delAlumInscAndGroup($id_grupo);
       header("Location: ../../Views/Tutor/carga_alumnos.php");
    }

    function getDatosGrupoPorId($id_grupo){
        $datosgrupo = $this->model_alumnos_inscritos->getDataGroupPerId($id_grupo);
        return $datosgrupo;
    }

   /* function getMateriasTutorByIdUser($id_usuario){
        $tutor = $this->model_tutor->getTutorByUserId($id_usuario);
        $materias = $this->model_tutor->getMateriasByIdTutor($tutor->id_tutor);

    }*/


/*
    function getAlumnos() {
        try{
            $tutor = $this->model_tutor->getTutorByUserId($_SESSION['id_usuario']);
            $alumnos = $this->model_alumno_profesor->getAlumnosByProfesor($tutor->id_tutor);

            return $alumnos;
        } catch(Exception $e) {
            return array();
        }
    }
    */
}


