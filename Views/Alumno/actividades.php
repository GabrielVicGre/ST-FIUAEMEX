<?php

session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Alumno") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'actividades';
}
include_once ("../../Controllers/Alumno/alumnoController.php");
include_once ("../../Controllers/Alumno/actividadesController.php");
include_once ("../../Views/Graphics/PercentBar.php");
     
$controller_actividades = new actividadesController();
$controller_alumno = new alumnoController();
$id_alumno = $controller_alumno->getAlumnoData()->id_alumno;

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
                    <h4 class="h5">Actividades</h4>
                    <?php include "layouts/user-layout.php"; ?>

                </div>

                <br>
                <div class="p-4 m-4">
                    <?php include "layouts/resumen_actividades.php"; ?> <br>
                    <div class="table-responsive">
                         
                        <table class="table table-bordered text-center">
                            <thead class="bg-success text-white">
                                <th class="short">Clave</th>
                                <th class="long">Descripción</th>
                                <th class="short">Opciones</th>
                            </thead>
                            <tbody class="actividades-list-container">
                                <?php
                                $actividades = $controller_actividades->getActividadesByAlumno($id_alumno);

                                for ($i = 0; $i < sizeof($actividades); $i++) {
                                    $actividad = $actividades[$i];
                                    // $status:true -> entregada
                                    $status = $controller_actividades->getStatus($actividad->id_actividad, $id_alumno);

                                ?>
                                    <form action="Views/Alumno/entrega_actividad.php" method="POST">
                                        <tr class="actividad-resumen">
                                            <td class="act-data short"><?php echo $actividad->clave_actividad; ?></td>
                                            <td class="act-data long"><?php echo $actividad->desc_actividad; ?></td>
                                            <td class="act-data short">
                                                <?php
                                                if ($status == false) { ?>
                                                    <button class="btn-sm turn-in" type="submit">Entregar</button>
                                                <?php
                                                } else { ?>
                                                    <button class="btn-sm turned-in" type="submit" disabled>Entregado</button>
                                                <?php
                                                } ?>
                                                <input type="hidden" name="id_actividad" value="<?php echo $actividad->id_actividad; ?>">
                                            </td>
                                        </tr>
                                    </form>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                    </div>

                </div>

                <br><br>                     
                <?php include "layouts/footer-layout.php"; ?>

            </main>
        </div>
    </div>

</body>

</html>