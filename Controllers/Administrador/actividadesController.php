<?php

include_once ("../../Models/ActividadCRUD.php");

class actividadesController{
    private $model;

    function __construct() {
        $this->model = new ActividadCRUD();
    }

    function listActividades() {
        return $this->model->getActividades();
    }

    function listActividadesAvailable($id_licenciatura) {
        return $this->model->getActividadesAvailable($id_licenciatura);
    }

    function addActividad() {
        date_default_timezone_set('America/Mexico_City');
        $act = new Actividad();
        $act->clave_actividad = $_POST['clave_actividad'];
        $act->desc_actividad = $_POST['desc_actividad'];
        $act->fecha_alta = date("Y-m-d");
        $this->model->createActividad($act);
        header("Location: ../../Views/Administrador/actividades.php?action=new&status=correcto");
    }

    function editActividad() {
        $id = $_POST['id_actividad'];
        $act = new Actividad();

        $act->clave_actividad = $_POST['clave_actividad'];
        $act->desc_actividad = $_POST['desc_actividad'];
        //$act->fecha_alta = $_POST['fecha_alta'];

        $this->model->updateActividad($id, $act);

        header("Location: ../../Views/Administrador/actividades.php?action=new&status=correcto");
    }

    function getActividad($id) {
        $act = $this->model->getActividadById($id);
        return array(
            "id_actividad" => $act->id_actividad,
            "clave_actividad" => $act->clave_actividad,
            "desc_actividad" => $act->desc_actividad,
            "fecha_alta" => $act->fecha_alta
        );
    }

    function deleteActividad() {
        $id = $_GET['id_actividad'];

        $this->model->deleteActividad($id);

        header("Location: ../../Views/Administrador/actividades.php?action=new&status=correcto");
    }
}