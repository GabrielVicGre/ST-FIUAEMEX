<?php

include_once ("../../Models/EntregaCRUD.php");
include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/ActividadCRUD.php");

class entregaController {

    private $model_entrega;
    private $model_alumno;
    private $model_actividad;
    private $base_url;

    function __construct() {
        $this->model_entrega = new EntregaCRUD();
        $this->model_alumno = new AlumnoCRUD();
        $this->model_actividad = new ActividadCRUD();

        $this->base_url = "../../01_Uploads/Evidencias/";
    }

    function addEntrega() {
        $alumno = $this->model_alumno->getAlumnoByUserId($_SESSION['id_usuario']);
        $actividad = $this->model_actividad->getActividadById($_POST['id_actividad']);

        $url = $this->createDirURL($alumno->no_cuenta, $actividad->clave_actividad)."/".basename($_FILES['file']['name']);

        if($this->uploadEvidencia($url)) {
            $entrega = new Entrega();
            $entrega->id_actividad = $actividad->id_actividad;
            $entrega->id_alumno = $alumno->id_alumno;
            $entrega->url_evid = $url;
            $entrega->fecha_entrega = date("Y-m-d");

            $this->model_entrega->createEntrega($entrega);

            return true;
        }

        return false;
    }

    function uploadEvidencia($url) {
        if(move_uploaded_file($_FILES['file']['tmp_name'], $url)) {
            //echo "Archivo sudido con éxito!!";
            return true;
        } else {
            //echo "Error al subir el archivo";
            return false;
        }
    }

    function createDirURL($no_cuenta, $clave_actividad) {
        // CREA UNA URL DE LA FORMA: url_base/no_cuenta/clave_actividad

        $url = $this->base_url.$no_cuenta."/".$clave_actividad;

        if (!file_exists($url)) {
            mkdir($url, 0777, true);
        }

        return $url;
    }

    function entregado($id_actividad, $id_alumno) {
        $entrega = $this->model_entrega->getEntregaActividadByAlumno($id_actividad, $id_alumno);

        if(isset($entrega)) {
            return true;
        } else {
            return false;
        }
    }


}



