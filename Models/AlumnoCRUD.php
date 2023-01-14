<?php

include_once("../../Config/connectPOO.php");
include_once("../../Models/Alumno.php");

class AlumnoCRUD
{
    // CREATE
    function createAlumno($alumno)
    {
        global $connection;
        $query = "INSERT INTO alumno VALUES (NULL, '$alumno->nombre', '$alumno->no_cuenta', $alumno->id_usuario, $alumno->id_licenciatura, NULL)";
        $connection->query($query);
    }

    // REPORT
    function getAlumnoById($id)
    {
        global $connection;

        $query = "SELECT * FROM alumno WHERE id_alumno = $id";
        $result = $connection->query($query);
        $alumno = $result->fetch_array(MYSQLI_ASSOC);

        $alu = new Alumno();
        $alu->id_alumno = $alumno['id_alumno'];
        $alu->nombre = $alumno['nombre'];
        $alu->no_cuenta = $alumno['no_cuenta'];
        $alu->id_usuario = $alumno['id_usuario'];
        $alu->id_licenciatura = $alumno['id_licenciatura'];
        $alu->id_tutor = $alumno['id_tutor'];

        return $alu;
    }

    function getAlumnos()
    {
        global $connection;

        $alumnos = array();

        $query = "SELECT * FROM alumno";
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

    function getAlumnosMatch($match)
    {
        global $connection;

        $alumnos = array();

        $query = "SELECT * FROM alumno WHERE nombre LIKE '%$match%' OR no_cuenta LIKE '%$match%' OR no_cuenta LIKE '%$match%' OR id_licenciatura = (SELECT id_licenciatura FROM licenciatura WHERE siglas LIKE '%$match%')";
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

    function getAlumnoByUserId($id_usuario)
    {
        global $connection;

        $query = "SELECT * FROM alumno WHERE id_usuario = $id_usuario";
        $result = $connection->query($query);

        if($result->num_rows == 0) {
            throw new Exception();
        }

        $alumno = $result->fetch_array(MYSQLI_ASSOC);

        $alu = new Alumno();
        $alu->id_alumno = $alumno['id_alumno'];
        $alu->nombre = $alumno['nombre'];
        $alu->no_cuenta = $alumno['no_cuenta'];
        $alu->id_usuario = $alumno['id_usuario'];
        $alu->id_licenciatura = $alumno['id_licenciatura'];
        $alu->id_tutor = $alumno['id_tutor'];

        return $alu;
    }

    function getAlumnosByTutor($id_tutor)
    {
        global $connection;

        $alumnos = array();

        $query = "SELECT * FROM alumno WHERE id_tutor = $id_tutor";
        $result = $connection->query($query);

        /*  if($result->num_rows == 0) {
            throw new Exception();
        }
        */
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($alumnos, $this->getAlumnoById($row['id_alumno']));
        }

        return $alumnos;
    }

    function getAlumnosByIdGrupo($id_grupo){
        global $connection;

        $alumnos = array();

        $query = "SELECT * FROM alumno a INNER JOIN alumnos_inscritos ai 
        ON a.id_alumno = ai.id_alumno WHERE ai.id_grupo = '$id_grupo';";
        
        $result = $connection->query($query);

        /*  if($result->num_rows == 0) {
            throw new Exception();
        }
        */
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($alumnos, $this->getAlumnoById($row['id_alumno']));
        }

        return $alumnos;
    }



    function getAlumnosByLicenciatura($id_licenciatura)
    {
        global $connection;

        $alumnos = array();

        $query = "SELECT * FROM alumno WHERE id_licenciatura = $id_licenciatura";
        $result = $connection->query($query);

      /*  if($result->num_rows == 0) {
            throw new Exception();
        }*/

        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            array_push($alumnos, $this->getAlumnoById($row['id_alumno']));
        }

        return $alumnos;
    }

    function getAlumnoByNoCuenta($no_cuenta)
    {
        global $connection;


        $query = "SELECT * FROM alumno WHERE no_cuenta = '$no_cuenta'";

        $result = $connection->query($query);

        if($result->num_rows == 0) {
            throw new Exception();
        }

        $alumno = $result->fetch_array(MYSQLI_ASSOC);

        $alu = new Alumno();
        $alu->id_alumno = $alumno['id_alumno'];
        $alu->nombre = $alumno['nombre'];
        $alu->no_cuenta = $alumno['no_cuenta'];
        $alu->id_usuario = $alumno['id_usuario'];
        $alu->id_licenciatura = $alumno['id_licenciatura'];
        $alu->id_tutor = $alumno['id_tutor'];

        return $alu;
    }

    // UPDATE
    function updateAlumnoTutor($id_alumno, $id_tutor)
    {
        global $connection;

        $query = "UPDATE alumno SET id_tutor='$id_tutor' WHERE id_alumno = $id_alumno";
        $connection->query($query);
    }

// DELETE
}