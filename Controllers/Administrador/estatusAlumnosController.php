<?php
include_once "../../Models/TutorCRUD.php";
include_once "../../Models/PlanTrabajoCRUD.php";
include_once "../../Models/AlumnoCRUD.php";
include_once "../../Models/EntregaCRUD.php";

class estatusAlumnosController
{
    private $model_tutor;
    private $model_plan_trabajo;
    private $model_alumno;
    private $model_entrega;

    function __construct()
    {
        $this->model_tutor = new TutorCRUD();

        $this->model_plan_trabajo = new PlanTrabajoCRUD();

        $this->model_alumno = new AlumnoCRUD();

        $this->model_entrega = new EntregaCRUD();
    }

    function tablaEstatusAlumnos($id_licenciatura) {
        $alumnos = $this->model_alumno->getAlumnosByLicenciatura($id_licenciatura);
        $actividades = $this->model_plan_trabajo->getActividadesPorLicenciatura($id_licenciatura);
        ?>
        <table class="table">
            <thead>
                <th>No. Cuenta</th>
                <th>Alumno</th>
                <?php
                foreach ($actividades as $actividad) {
                ?>
                    <th><?php echo $actividad->clave_actividad; ?></th>
                <?php
                }
                ?>
            </thead>
            <tbody>
                <?php
                foreach ($alumnos as $alumno) {
                ?>
                <tr>
                    <td><?php echo $alumno->no_cuenta; ?></td>
                    <td><?php echo $alumno->nombre; ?></td>
                    <?php
                    foreach ($actividades as $actividad) {
                        if ($this->model_entrega->getEntregaActividadByAlumno($actividad->id_actividad, $alumno->id_alumno) != null) {
                            echo "<td><div class='bg-success disabled'>Sí</div></td>";
                        } else {
                            echo "<td><div>No</div></td>";
                        }
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

    function getTotalEntregas($id_actividad, $alumnos)
    {
        $count = 0;

        foreach ($alumnos as $alumno) {
            if ($this->model_entrega->getEntregaActividadByAlumno($id_actividad, $alumno->id_alumno) != NULL) {
                $count++;
            }
        }

        return $count;
    }
}