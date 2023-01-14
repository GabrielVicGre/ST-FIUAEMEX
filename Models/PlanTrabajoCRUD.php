<?php

include_once ("../../Config/connectPOO.php");
include_once ("../../Models/PlanTrabajo.php");
include_once ("../../Models/Actividad.php");

class PlanTrabajoCRUD {

    function getPlanPorLicenciatura($id_lic) {
        global $connection;
    
        $plan = array(); 
        $query = "SELECT a.clave_actividad,a.desc_actividad FROM plan_trabajo p JOIN actividad a WHERE p.id_actividad = a.id_actividad AND p.id_licenciatura = ".$id_lic;
        $result = $connection->query($query);
        while($act = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($plan, $act);
        }
        return $plan;
    }

    // Sustituir getPlanPorLicenciatura por:
    function getActividadesPorLicenciatura($id_lic) {
        global $connection;
        $plan = array();

        $query = "SELECT * FROM plan_trabajo NATURAL JOIN actividad WHERE id_licenciatura = $id_lic";
        $result = $connection->query($query);
        while($actividad = $result->fetch_array(MYSQLI_ASSOC)) {
            $act = new Actividad();
            $act->id_actividad = $actividad['id_actividad'];
            $act->clave_actividad = $actividad['clave_actividad'];
            $act->desc_actividad = $actividad['desc_actividad'];
            $act->fecha_alta = $actividad['fecha_alta'];
            array_push($plan, $act);
        }
        return $plan;
    }

    function addActPlanLic($id_act,$id_lic){
        global $connection;
        $query = "INSERT INTO plan_trabajo VALUES ('$id_act', '$id_lic')";
        $connection->query($query);    
    }

}


?>