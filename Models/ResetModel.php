<?php

include_once ("../Config/connectPOO.php");

class ResetModel {

    function ResetDataBase() {
        global $connection;

        $query = "DELETE FROM alumnos_inscritos;";
        $connection->query($query);

        $query = "DELETE FROM grupo;";
        $connection->query($query);

        $query = "DELETE FROM materia;";
        $connection->query($query);
        
        $query = "DELETE FROM entrega_actividad;";
        $connection->query($query);
        $query = "DELETE FROM plan_trabajo;";
        $connection->query($query);
        $query = "DELETE FROM actividad;";
        $connection->query($query);
        $query = "DELETE FROM alumno WHERE id_alumno > 1;";
        $connection->query($query);
        $query = "DELETE FROM tutor WHERE id_tutor > 1;";
        $connection->query($query);
        $query = "DELETE FROM usuario WHERE id_usuario > 3;";
        $connection->query($query);

       
       // $query = "DELETE FROM usuario WHERE id_usuario > 3;";
       // $connection->query($query);
        header("Location: ../Views/Administrador/cargar_informacion.php");

    }

    

}


?>