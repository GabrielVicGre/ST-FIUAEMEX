<?php

include_once ("../../Config/connectPOO.php");
include_once ("../../Models/Entrega.php");

class EntregaCRUD {
    // CREATE
    function createEntrega($ent) {
        global $connection;

        $query = "INSERT INTO entrega_actividad VALUES (NULL, $ent->id_actividad, $ent->id_alumno, '$ent->url_evid', '$ent->fecha_entrega')";
        $connection->query($query);
    }

    // REPORT
    function getEntregaById($id) {
        global $connection;

        $query = "SELECT * FROM entrega_actividad WHERE id_entrega_actividad = $id";
        $result = $connection->query($query);
        $entrega = $result->fetch_array(MYSQLI_ASSOC);

        $ent = new Entrega();
        $ent->id_entrega_actividad = $entrega['id_entrega_actividad'];
        $ent->id_actividad = $entrega['id_actividad'];
        $ent->id_alumno = $entrega['id_alumno'];
        $ent->url_evid = $entrega['url_evid'];
        $ent->fecha_entrega = $entrega['fecha_entrega'];

        return $ent;
    }

    function getEntregasByAlumno($id_alumno) {
        global $connection;

        $entregas = array();

        $query = "SELECT id_entrega_actividad FROM entrega_actividad WHERE id_alumno = $id_alumno";
        $result = $connection->query($query);
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($entregas, $this->getEntregaById($row['id_entrega_actividad']));
        }

        return $entregas;
    }

    function getEntregaActividadByAlumno($id_actividad, $id_alumno) {
        global $connection;

        $query = "SELECT * FROM entrega_actividad WHERE id_actividad = $id_actividad AND id_alumno = $id_alumno";
        $result = $connection->query($query);
        $entrega = $result->fetch_array(MYSQLI_ASSOC);

        return $entrega;
    }

    // UPDATE

    // DELETE
}