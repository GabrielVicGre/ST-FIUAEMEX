<?php

include_once ("../../Models/PlanTrabajoCRUD.php");

class editarPlanController {
    private $model;

    function __construct() {
        $this->model = new PlanTrabajoCRUD();
    }

    function listPlanesTrabajoPorLic($id_lic) {
        return $this->model->getPlanPorLicenciatura($id_lic);
    }

    function add_Actividad_A_Plan($id_act, $id_lic){
        $this->model->addActPlanLic($id_act,$id_lic);
    }



}