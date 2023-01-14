<?php
include_once ("../../Models/UsuarioCRUD.php");

class  UsuarioController {
    private $model_usuario;

    function __construct() {
        $this->model_usuario = new UsuarioCRUD();
    }

    function getUsuarioById($id) {
        return $this->model_usuario->getUsuarioById($id);
    }

    function getTipoUsuario($usuario) {
        return $this->model_usuario->getTipoUsuarioById($usuario->id_tipo_usuario);
    }
}

