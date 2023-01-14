<?php

include_once ("../../Config/connectPOO.php");
include_once ("../../Models/Licenciatura.php");

class LicenciaturaCRUD{
    //CREATE

    //REPORT
    function getLicenciaturaById($id) {
        global $connection;

        $query = "SELECT * FROM licenciatura WHERE id_licenciatura = $id";
        $result = $connection->query($query);
        $licenciatura = $result->fetch_array(MYSQLI_ASSOC);

        $lic = new Licenciatura();
        $lic->id_licenciatura = $licenciatura['id_licenciatura'];
        $lic->siglas = $licenciatura['siglas'];
        $lic->nombre = $licenciatura['nombre'];

        return $lic;
    }

    function getLicenciaturaBySiglas($siglas) {
        global $connection;

        $query = "SELECT * FROM licenciatura WHERE siglas LIKE '$siglas'";
        $result = $connection->query($query);
        $licenciatura = $result->fetch_array(MYSQLI_ASSOC);

        $lic = new Licenciatura();
        $lic->id_licenciatura = $licenciatura['id_licenciatura'];
        $lic->siglas = $licenciatura['siglas'];
        $lic->nombre = $licenciatura['nombre'];

        return $lic;
    }

  

    //UPDATE

    //DELETE
}