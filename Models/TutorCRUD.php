<?php

include_once ("../../Config/connectPOO.php");
include_once ("../../Models/Tutor.php");
include_once ("../../Models/Materia.php");

class TutorCRUD {
    //CREATE
    function createTutor($tutor) {
        global $connection;

        $query = "INSERT INTO tutor VALUES(NULL, '$tutor->nombre', '$tutor->cve_tutor', $tutor->id_usuario, $tutor->id_licenciatura)";
        $connection->query($query);
    }

    //REPORT
    function getTutorByUserId($id) {
        global $connection;

        $query = "SELECT * FROM tutor WHERE id_usuario = $id";
        $result = $connection->query($query);
        $tutor = $result->fetch_array(MYSQLI_ASSOC);

        $tu = new Tutor();
        $tu->id_tutor = $tutor['id_tutor'];
        $tu->nombre = $tutor['nombre'];
        $tu->cve_tutor = $tutor['cve_tutor'];
        $tu->id_usuario = $tutor['id_usuario'];
        $tu->id_licenciatura = $tutor['id_licenciatura'];
        return $tu;
    }

    function getTutorByCveTutor($cve_tutor) {
        global $connection;

        $query = "SELECT * FROM tutor WHERE cve_tutor = '$cve_tutor'";
        $result = $connection->query($query);
        $tutor = $result->fetch_array(MYSQLI_ASSOC);

        $tu = new Tutor();
        $tu->id_tutor = $tutor['id_tutor'];
        $tu->nombre = $tutor['nombre'];
        $tu->cve_tutor = $tutor['cve_tutor'];
        $tu->id_usuario = $tutor['id_usuario'];
        $tu->id_licenciatura = $tutor['id_licenciatura'];
        return $tu;
    }

    function getTutores() {
        global $connection;

        $tutores = array();

        $query = "SELECT * FROM tutor";
        $result = $connection->query($query);
        while($tutor = $result->fetch_array(MYSQLI_ASSOC)) {
            $tu = new Tutor();
            $tu->id_tutor = $tutor['id_tutor'];
            $tu->nombre = $tutor['nombre'];
            $tu->cve_tutor = $tutor['cve_tutor'];
            $tu->id_usuario = $tutor['id_usuario'];
            $tu->id_licenciatura = $tutor['id_licenciatura'];
            array_push($tutores, $tu);
        }

        return $tutores;
    }

    function getTutoresMatch($match) {
        global $connection;

        $tutores = array();

        $query = "SELECT * FROM tutor WHERE nombre LIKE '%$match%' OR cve_tutor LIKE '%$match%' OR id_licenciatura = (SELECT id_licenciatura FROM licenciatura WHERE siglas LIKE '%$match%')";
        $result = $connection->query($query);
        while($tutor = $result->fetch_array(MYSQLI_ASSOC)) {
            $tu = new Tutor();
            $tu->id_tutor = $tutor['id_tutor'];
            $tu->nombre = $tutor['nombre'];
            $tu->cve_tutor = $tutor['cve_tutor'];
            $tu->id_usuario = $tutor['id_usuario'];
            $tu->id_licenciatura = $tutor['id_licenciatura'];
            array_push($tutores, $tu);
        }

        return $tutores;
    }

    function getTutoresByLicenciatura($id_lic) {
        global $connection;

        $tutores = array();

        $query = "SELECT * FROM tutor WHERE id_licenciatura = $id_lic";
        $result = $connection->query($query);
        while($tutor = $result->fetch_array(MYSQLI_ASSOC)) {
            $tu = new Tutor();
            $tu->id_tutor = $tutor['id_tutor'];
            $tu->nombre = $tutor['nombre'];
            $tu->cve_tutor = $tutor['cve_tutor'];
            $tu->id_usuario = $tutor['id_usuario'];
            $tu->id_licenciatura = $tutor['id_licenciatura'];
            array_push($tutores, $tu);
        }

        return $tutores;
    }

    function getTutorByAlumno($id_alumno) {
        global $connection;

        $query = "SELECT * FROM tutor WHERE id_tutor = (SELECT id_tutor FROM alumno WHERE alumno.id_alumno = $id_alumno)";

        $result = $connection->query($query);
        $tutor = $result->fetch_array(MYSQLI_ASSOC);

        $tu = new Tutor();
        $tu->id_tutor = $tutor['id_tutor'];
        $tu->nombre = $tutor['nombre'];
        $tu->cve_tutor = $tutor['cve_tutor'];
        $tu->id_usuario = $tutor['id_usuario'];
        $tu->id_licenciatura = $tutor['id_licenciatura'];
        return $tu;
    }


    
    function getMateriasByIdTutor($id_tutor){
        global $connection;

        $query = "SELECT grupo.*, materia.clave, materia.nombre FROM grupo
        INNER JOIN materia ON grupo.id_materia= materia.id_materia 
        WHERE grupo.id_tutor =  $id_tutor";
        $result = $connection->query($query);

       /*
       $materias = array(); 
       while($materias = $result->fetch_array(MYSQLI_ASSOC)) {
            $tu = new Tutor();
            $tu->id_tutor = $materias['id_tutor'];
            $tu->nombre = $materias['nombre'];
            $tu->cve_tutor = $materias['cve_tutor'];
            array_push($tutores, $tu);
        }*/

        return $result;
    }
    

    
    
}