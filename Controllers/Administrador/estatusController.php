<?php

include_once ("../../Models/TutorCRUD.php");
include_once ("../../Models/PlanTrabajoCRUD.php");
include_once ("../../Models/AlumnoCRUD.php");
include_once ("../../Models/EntregaCRUD.php");

class estatusController {
    private $model_tutor;
    private $model_plan_trabajo;
    private $model_alumno;
    private $model_entrega;

    function __construct() {
        $this->model_tutor = new TutorCRUD();

        $this->model_plan_trabajo = new PlanTrabajoCRUD();

        $this->model_alumno = new AlumnoCRUD();

        $this->model_entrega = new EntregaCRUD();
    }

    function tablaEstatus($id_licenciatura) {
        $tutores = $this->model_tutor->getTutoresByLicenciatura($id_licenciatura);
        $actividades = $this->model_plan_trabajo->getActividadesPorLicenciatura($id_licenciatura);
        ?>
        <table class="table">
            <thead>
                <th>Tutor</th>
                <?php
                foreach($actividades as $actividad) {
                    ?>
                    <th><?php echo $actividad->clave_actividad;?></th>
                    <?php
                }
                ?>
            </thead>
            <tbody>
                <?php
                foreach($tutores as $tutor) {
                    $alumnos = $this->model_alumno->getAlumnosByTutor($tutor->id_tutor);
                    ?>
                    <tr>
                        <td><?php echo $tutor->nombre; ?></td>
                        <?php
                        foreach($actividades as $actividad) {
                            ?>
                            <td>
                                <?php 
                                $total_entregas = $this->getTotalEntregas($actividad->id_actividad, $alumnos);
                                $total_alumnos = count($alumnos);
                                $status = $this->entregaStatus($total_entregas, $total_alumnos);

                                echo "<p class='$status'>$total_entregas/$total_alumnos</p>";
                                ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    function getTotalEntregas($id_actividad, $alumnos) {
        $count = 0;

        foreach($alumnos as $alumno) {
            if($this->model_entrega->getEntregaActividadByAlumno($id_actividad, $alumno->id_alumno) != NULL) {
                $count++;
            }
        }

        return $count;
    }

    function entregaStatus($total_entregas, $total_alumnos) {
        try {
            $rate = 100 * $total_entregas / $total_alumnos;
        } catch(DivisionByZeroError) {
            return "text-muted";
        }
        

        if($rate >= 0 && $rate <=50) {
            return "text-danger";
        } else if ($rate <= 75) {
            return "text-warning";
        } else {
            return "";
        }
    }
}

?>