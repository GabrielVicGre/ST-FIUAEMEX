<?php

include_once ('../../Config/connectPOO.php');

class TutorAlumno{
    protected $id_tutor;
    protected $id_alumno;

    function getLicAlumnos($id_usuario){
        global $connection;       
        $plan = array(); 
        $query = "SELECT l.nombre 
                  FROM usuario u, tutor t, tutor_alumno ta, alumno a, licenciatura l 
                  WHERE l.id_licenciatura = a.id_licenciatura AND
                                   a.id_alumno = ta.id_alumno AND
                                   ta.id_tutor =  t.id_tutor  AND
                                  t.id_usuario = u.id_usuario AND
                                  u.id_usuario =".$id_usuario;                 
        $result = $connection->query($query);
        while($act = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($plan, $act);
        }
        return $plan[0]['nombre'];
    }

    /*
    function getActividades_Por_Plan($plan){
        global $connection;       
        $act_plan = array(); 
       $query = "SELECT * FROM actividad a, plan_trabajo pt, licenciatura l 
                  WHERE a.id_actividad = pt.id_actividad AND
                                   pt.id_licenciatura = l.id_licenciatura AND
                                   l.nombre LIKE '".$plan."'"; 
                       
        $result = $connection->query($query);
        while($act = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($act_plan, $act);
        }
        return $act_plan;
    }
  */

}

?>