<?php

include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/TutorCRUD.php");
include_once ("../../Models/UsuarioCRUD.php");
include_once("../../Models/LicenciaturaCRUD.php");

class consultarController {
    private $model_alumno;
    private $model_tutor;
    private $model_usuario;
    private $model_licenciatura;

    function __construct() {
        $this->model_alumno = new AlumnoCRUD();
        $this->model_tutor = new TutorCRUD();
        $this->model_usuario = new UsuarioCRUD();
        $this->model_licenciatura = new LicenciaturaCRUD();
    }

    function listaAlumnos($match) {
        if($match == "") {
            $alumnos = $this->model_alumno->getAlumnos();
        } else {
            $alumnos = $this->model_alumno->getAlumnosMatch($match);
        }

        ?>
        <table class="table table-hover mt-3 table-bordered" >
            <thead class="text-white" style="background-color: #1ABC9C;">
                <th class="col-2">No. Cuenta</th>
                <th class="col-4">Nombre del Alumno</th>
                <th class="col-2">Licenciatura</th>
                <th class="col-4">Correo institucional</th>
            </thead>
            <tbody>
                <?php
                foreach($alumnos as $alumno) {
                    $licenciatura = $this->model_licenciatura->getLicenciaturaById($alumno->id_licenciatura);
                    ?>
                    <tr>
                        <td class="col-2"><?php echo $alumno->no_cuenta; ?></td>
                        <td class="col-4 text-center"><?php echo $alumno->nombre; ?></td>
                        <td class="col-2"><?php echo $licenciatura->siglas; ?></td>
                        <td class="col-4"><?php echo $this->model_usuario->getUsuarioById($alumno->id_usuario)->email ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    function listaTutores($match) {
        if($match == "") {
            $tutores = $this->model_tutor->getTutores();
        } else {
            $tutores = $this->model_tutor->getTutoresMatch($match);
        }

        ?>
        <table class="table table-hover table-bordered mt-3">
            <thead class="text-white" style="background-color: #1ABC9C;">
                <th class="col-2">CLAVE</th>
                <th class="col-4">Nombre del Tutor</th>
                <th class="col-2">Licenciatura</th>
                <th class="col-4">Correo institucional</th>
            </thead>
            <tbody>
                <?php
                foreach($tutores as $tutor) {
                    $licenciatura = $this->model_licenciatura->getLicenciaturaById($tutor->id_licenciatura);
                    ?>
                    <tr>
                        <td class="col-2"><?php echo $tutor->cve_tutor; ?></td>
                        <td class="col-4 text-center"><?php echo $tutor->nombre; ?></td>
                        <td class="col-2"><?php echo $licenciatura->siglas; ?></td>
                        <td class="col-4"><?php echo $this->model_usuario->getUsuarioById($tutor->id_usuario)->email ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}

?>