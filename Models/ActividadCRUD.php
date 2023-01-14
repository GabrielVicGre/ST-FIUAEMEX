<?php

include_once ("../../Config/connectPOO.php");
include_once ("../../Models/Actividad.php");

class ActividadCRUD {

//CREATE
function createActividad($act) {
    global $connection;

    $query = "INSERT INTO actividad VALUES (NULL,'$act->clave_actividad', '$act->desc_actividad', '$act->fecha_alta')";
    $connection->query($query);
}

//REPORT
function getActividadById($id) {
    global $connection;

    $query = "SELECT * FROM actividad WHERE id_actividad = $id";
    $result = $connection->query($query);
    $actividad = $result->fetch_array(MYSQLI_ASSOC);

    $act = new Actividad; 
    $act->id_actividad = $actividad['id_actividad'];
    $act->clave_actividad = $actividad['clave_actividad'];
    $act->desc_actividad = $actividad['desc_actividad'];
    $act->fecha_alta = $actividad['fecha_alta'];

    return $act;
}

function getActividades() {
    global $connection;

    $acts = array();

    $query = "SELECT * FROM actividad";
    $result = $connection->query($query);
    while($act = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($acts, $act);
    }

    return $acts;
}

function getActividadesAvailable($id_licenciatura) {
    global $connection;

    $acts = array();

    $query = "SELECT * FROM actividad WHERE id_actividad NOT IN (SELECT id_actividad FROM plan_trabajo WHERE id_licenciatura = $id_licenciatura)";
    $result = $connection->query($query);
    while($act = $result->fetch_array(MYSQLI_ASSOC)) {
        array_push($acts, $act);
    }

    return $acts;
}

//UPDATE
function updateActividad($id, $act) {
    global $connection;

    $query = "UPDATE actividad".
        " SET clave_actividad = '$act->clave_actividad', desc_actividad = '$act->desc_actividad'".
        " WHERE id_actividad = $id";
    $connection->query($query);
}

//DELETE
function deleteActividad($id) {
    global $connection;

    $query = "DELETE FROM actividad WHERE id_actividad = $id";
    $connection->query($query);
}

}
