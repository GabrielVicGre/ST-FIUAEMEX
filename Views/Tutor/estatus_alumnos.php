<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Tutor") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'carga_alumnos';
}

require_once "../../Controllers/Tutor/estatusController.php";
require_once "../../Controllers/Alumno/actividadesController.php";
require_once "../../Views/Graphics/PercentBar.php";
require_once "../../Controllers/Tutor/AlumInscritosController.php";

$controller_estatus = new estatusController();
$controller_actividades = new actividadesController();
$controller_grupo = new AlumInscritosController();


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
                    <h4 class="h5">Estatus entrega de actividades de alumnos</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="Views/Tutor/carga_alumnos.php">Grupos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Estatus de alumnos por grupo</li>
                    </ol>
                </nav>
                De click en el nombre de uno de sus alumnos para conocer las actividades que ha entregado.

                <?php
                if (isset($_GET['id_grupo'])) {
                    $id_grupo = $_GET['id_grupo'];
                    $arraydatosGrupo = $controller_grupo->getDatosGrupoPorId($id_grupo);
                } else {
                    $id_grupo = '';
                }
                ?>

                <div class="mx-5">
                    <div class="mt-3 py-3 bg-light text-center text-muted border">
                        <h6> GRUPO: <?php echo $arraydatosGrupo['nombre_gpo'] ?></h6>
                        <h6> CLAVE MATERIA: <?php echo $arraydatosGrupo['clave'] ?></h6>
                        <h6> MATERIA: <?php echo $arraydatosGrupo['nombre'] ?></h6>
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
                        $alumnos = $controller_estatus->getAlumnosPorGrupo($id_grupo);
                        $count = 0;
                        foreach ($alumnos as $alumno) {
                        ?>
                            <div class="py-2 border bg-light" id="heading<?php echo $count; ?>">
                                <h5 class="m-0">
                                    <button class="btn container" style="border: 0;" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?>" aria-expanded="false" aria-controls="collapse<?php echo $count; ?>">
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
                                                        <h6><span class="badge rounded-pill text-bg-secondary">Sin entregar</span></h6>
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

                <div class="container text-center my-5">
                    <a href="Views/Tutor/carga_alumnos.php" class="btn btn-sm btn-success"><i class="bi bi-arrow-left-circle mx-1"></i>Regresar </a>
                </div>

                <?php include "layouts/footer-layout.php"; ?>
            </main>
        </div>
    </div>



</body>

</html>