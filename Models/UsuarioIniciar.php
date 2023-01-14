<?php

include_once ("../../Config/connectPOO.php");

class UsuarioIniciar {
    protected $id_tutor;
    protected $id_alumno;

    public function getDatosDeUsuarioTutor($id_usuario){
        global $connection;  

        $datosdelUsuario = array(); 
        $query = "SELECT tu.tipo, u.email, t.nombre
                  FROM tipo_usuario tu, usuario u, tutor t 
                  WHERE tu.id_tipo_usuario = u.id_tipo_usuario AND
                                   u.id_usuario = t.id_usuario AND
                                  u.id_usuario =".$id_usuario;                 
        $result = $connection->query($query);
        while($act = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($datosdelUsuario, $act);
        }
        return $datosdelUsuario;

    }


    public function getDatosDeUsuarioAlumno($id_usuario){
        global $connection;  

        $datosdelUsuario = array(); 
        $query = "SELECT tu.tipo, u.email, a.nombre, a.no_cuenta, l.nombre as licenciatura
                  FROM tipo_usuario tu, usuario u, alumno a, licenciatura l 
                  WHERE tu.id_tipo_usuario = u.id_tipo_usuario AND
                                   u.id_usuario = a.id_usuario AND
                                   a.id_licenciatura = l.id_licenciatura AND
                                  u.id_usuario =".$id_usuario;                 
        $result = $connection->query($query);
        while($act = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($datosdelUsuario, $act);
        }
        return $datosdelUsuario;

    }

    public function getDatosTutorDeAlumno($id_usuario) {
        global $connection;  
        $datosdelUsuario = array(); 
        $query = "SELECT  t.nombre as tutor
                  FROM tutor t, alumno a 
                  WHERE t.id_tutor = a.id_tutor AND a.id_usuario =".$id_usuario;                 
        $result = $connection->query($query);
        while($act = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($datosdelUsuario, $act);
        }
        return $datosdelUsuario;
        
    }


  
}

?>