<?php

include_once ("../../Config/connectPOO.php");
include_once ("../../Models/Usuario.php");


class UsuarioCRUD {
    //CREATE
    function createUsuario($usuario) {
        global $connection;
        $query = "INSERT INTO usuario VALUES (NULL, '$usuario->email', '$usuario->password', $usuario->id_tipo_usuario)";
        $connection->query($query);
        return $connection->insert_id;
    }

    //REPORT
    function getUsuarioById($id) {
        global $connection;

        $query = "SELECT * FROM usuario WHERE id_usuario = $id";
        $result = $connection->query($query);
        $usuario = $result->fetch_array(MYSQLI_ASSOC);

        $us = new Usuario();
        $us->id_usuario = $usuario['id_usuario'];
        $us->email = $usuario['email'];
        $us->password = $usuario['password'];
        $us->id_tipo_usuario = $usuario['id_tipo_usuario'];

        return $us;
    }

    function getTipoUsuarioById($id) {
        global $connection;

        $query = "SELECT tipo FROM tipo_usuario WHERE id_tipo_usuario = $id";
        $result = $connection->query($query);
        $tipo_usuario = $result->fetch_array(MYSQLI_ASSOC);

        return $tipo_usuario['tipo'];
    }

    //UPDATE

    //DELETE
}