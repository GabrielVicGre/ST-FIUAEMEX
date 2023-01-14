
<div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
        <tbody>
            <tr>
                <?php
                $total_actividades = count($controller_actividades->getActividadesByAlumno($id_alumno));
                $total_entregas = count($controller_actividades->getEntregasByAlumno($id_alumno));
                $total_pendientes = $total_actividades - $total_entregas;
                $progress = new PercentBar($controller_actividades->getEntregaRate($id_alumno));
                ?>
                <td class="status-data">Total de actividades: <br> <?php echo $total_actividades; ?></td>
                <td class="status-data">Entregadas: <br> <?php echo $total_entregas; ?></td>
                <td class="status-data">Pendientes: <br> <?php echo $total_pendientes; ?></td>
                <td class="status-data">
                    Porcentaje de entregas:
                    <div class="pt-2">
                        <?php $progress->display(); ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
