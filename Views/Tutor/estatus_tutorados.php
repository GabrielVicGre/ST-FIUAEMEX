<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Tutor") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'estatus_tutorados';
}

require_once "../../Controllers/Tutor/estatusController.php";
require_once "../../Controllers/Alumno/actividadesController.php";
//require_once "../../Controllers/Alumno/entregaController.php";
require_once "../../Views/Graphics/PercentBar.php";

$controller_estatus = new estatusController();
$controller_actividades = new actividadesController();
//$controller_entrega = new entregaController();

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'layouts/head-layout.php'; ?>
</head>

<body>
    <?php include "layouts/header-layout.php"; ?>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <?php include 'layouts/menu-layout.php'; ?>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="h5">Estatus entrega de actividades de tutorados</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>
                De click en el nombre de uno de sus tutorados para conocer las actividades que ha entregado.

                <div class="mx-5 h-75">
                    <div class="mt-3 py-3 bg-light text-center text-muted border">
                        <h6> LISTA DE ALUMNOS TUTORADOS</h6>
                    </div>

                    <div class="px-3 py-3 border">
                        <div class="container text-center text-muted">
                            <div class=row>
                                <div class="col-3">NÚMERO DE CUENTA</div>
                                <div class="col-3">NOMBRE DEL ALUMNO</div>
                                <div class="col-6">PROCENTAJE DE AVANCE</div>
                            </div>
                        </div>
                    </div>

                    <div id="accordion">
                        <?php
                        $alumnos = $controller_estatus->getAlumnos();
                        $count = 0;
                        foreach ($alumnos as $alumno) {
                        ?>
                            <div class="py-2 border bg-light" id="heading<?php echo $count; ?>">
                                <h5 class="m-0">
                                    <button class="btn btn-style container" style="border: 0;" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php echo $count; ?>">
                                        <div class=row>
                                            <div class="col-3"><?php echo $alumno->no_cuenta; ?></div>
                                            <div class="col-3"><?php echo $alumno->nombre; ?></div>
                                            <div class="col-6">
                                                <?php
                                                $progress = new PercentBar($controller_actividades->getEntregaRate($alumno->id_alumno));
                                                $progress->display();
                                                ?>
                                            </div>
                                        </div>
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse<?php echo $count; ?>" class="collapse text-center" aria-labelledby="heading<?php echo $count; ?>">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <?php
                                        $actividades = $controller_actividades->getActividadesByAlumno($alumno->id_alumno);
                                        foreach ($actividades as $actividad) {
                                        ?>
                                            <tr>
                                                <td class="col-2"><?php echo $actividad->clave_actividad; ?></td>
                                                <td class="col-8 text-truncate">
                                                    <?php echo $actividad->desc_actividad; ?>
                                                </td>
                                                <td class="col-2">
                                                    <?php
                                                    $status = $controller_actividades->getStatus($actividad->id_actividad, $alumno->id_alumno);
                                                    if ($status == true) {
                                                    ?>
                                                        <h6><span class="badge rounded-pill text-bg-success">Entregado</span></h6>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <h6><span class="badge rounded-pill  text-bg-secondary">Sin entregar</span></h6>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        <?php
                            $count++;
                        }
                        ?>
                    </div>

                </div>

                <?php include "layouts/footer-layout.php"; ?>
            </main>
        </div>
    </div>

</body>

</html>