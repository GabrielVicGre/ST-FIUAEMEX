<?php

include_once ("../../Models/ActividadCRUD.php");
include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/EntregaCRUD.php");
include_once ("../../Models/PlanTrabajoCRUD.php");
include_once ("../../Models/TutorAlumno.php");

class actividadesController {
    private $model_actividad;
    private $model_alumno;
    private $model_entrega;
    private $model_plan_trabajo;
    private $model_tutor_alumno;

    function __construct() {
        $this->model_actividad = new ActividadCRUD();
        $this->model_alumno = new AlumnoCRUD();
        $this->model_entrega = new EntregaCRUD();
        $this->model_plan_trabajo = new PlanTrabajoCRUD();
        $this->model_tutor_alumno = new TutorAlumno();
    }

    function getLicenciaturaAlumnos($id_usuario){
        return $this->model_tutor_alumno->getLicAlumnos($id_usuario);
    }

    /*function getActividadesPorPlan($plan){
        return $this->model_tutor_alumno->getActividades_Por_Plan($plan);     
    }*/

    function getActividadesByAlumno($id_alumno) {
        $alumno = $this->model_alumno->getAlumnoById($id_alumno);
        return $this->model_plan_trabajo->getActividadesPorLicenciatura($alumno->id_licenciatura);
    }

    function getEntregasByAlumno($id_alumno) {
        return $this->model_entrega->getEntregasByAlumno($id_alumno);
    }

    function getActividadById($id) {
        return $this->model_actividad->getActividadById($id);
    }

    function getStatus($id_actividad, $id_alumno) {
        if($this->model_entrega->getEntregaActividadByAlumno($id_actividad, $id_alumno) != NULL) {
            return true;
        } else {
            return false;
        }
    }

    function getEntregaRate($id_alumno) {
        $total_actividades = count($this->getActividadesByAlumno($id_alumno));
        $total_entregas = count($this->getEntregasByAlumno($id_alumno));
        if($total_actividades != 0) {
            $rate = $total_entregas * 100 / $total_actividades;
        } else {
            $rate = 0;
        }
        return round($rate, 1);
    }
}