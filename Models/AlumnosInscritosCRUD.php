<?php

include_once ("../../Config/connectPOO.php");
//include_once("../../Models/Alumno.php");

class AlumnosInscritosCRUD {

    function createNewgroupRegistration($id_alumno,$id_grupo) {
        global $connection;
        $query = "INSERT INTO alumnos_inscritos VALUES ('$id_alumno','$id_grupo')";
        $connection->query($query);
    }

    function getNumAlumPerGroup($id_grupo){
        global $connection;
        $query = "SELECT COUNT(id_grupo) as total FROM alumnos_inscritos WHERE id_grupo = '$id_grupo' ";
        $total = $connection->query($query);
        $num = $total->fetch_array(MYSQLI_ASSOC);
        return $num['total'];   
    }

    function delAlumInscAndGroup($id_grupo){
        global $connection;
        $query = "DELETE FROM alumnos_inscritos WHERE id_grupo = '$id_grupo'; ";
        $connection->query($query);
        $query = "DELETE FROM grupo WHERE id_grupo = '$id_grupo'; ";
        $connection->query($query);
    }

    function getDataGroupPerId($id_grupo){
        global $connection;
        $query = "SELECT g.*, m.clave, m.nombre FROM grupo g INNER JOIN materia m ON m.id_materia = g.id_materia
        WHERE g.id_grupo = '$id_grupo';";
        $result = $connection->query($query);
        $grupo = $result->fetch_array(MYSQLI_ASSOC);
        return $grupo;  
    }
   
   /* //CREATE
    function createAlumnoProfesor($id_alumno, $id_tutor, $id_materia) {
        global $connection;
    
        $query = "INSERT INTO alumno_profesor VALUES ($id_alumno, $id_tutor, $id_materia)";
        $connection->query($query);
    }

    //REPORT
    function getAlumnosByProfesor($id_tutor) {
        global $connection;

        $alumnos = array();

        $query = "SELECT * FROM alumno INNER JOIN alumno_profesor ON alumno.id_alumno = alumno_profesor.id_alumno WHERE alumno_profesor.id_tutor = $id_tutor";
        $result = $connection->query($query);

        if($result->num_rows == 0) {
            throw new Exception();
        }

        while ($alumno = $result->fetch_array(MYSQLI_ASSOC)) {
            $alu = new Alumno();
            $alu->id_alumno = $alumno['id_alumno'];
            $alu->nombre = $alumno['nombre'];
            $alu->no_cuenta = $alumno['no_cuenta'];
            $alu->id_usuario = $alumno['id_usuario'];
            $alu->id_licenciatura = $alumno['id_licenciatura'];
            $alu->id_tutor = $alumno['id_tutor'];
            array_push($alumnos, $alu);
        }

        return $alumnos;
    }
*/
    //UPDATE
    //DELETE
}