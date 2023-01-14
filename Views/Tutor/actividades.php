<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Tutor") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'actividades';
}

//NOTA: Corregir. La vista se esta comunicando con el modelo!
require_once "../../Models/PlanTrabajoCRUD.php";
require_once "../../Models/UsuarioCRUD.php";
require_once "../../Models/TutorCRUD.php";

$model_tutor = new TutorCRUD();

$model_usuario = new UsuarioCRUD();
$usuario = $model_usuario->getUsuarioById($_SESSION['id_usuario']);

$tutor = $model_tutor->getTutorByUserId($usuario->id_usuario);

$model_plan_trabajo = new PlanTrabajoCRUD();
$plan_trabajo = $model_plan_trabajo->getActividadesPorLicenciatura($tutor->id_licenciatura);
//$actividades_plan = $controller_actividades->getActividadesPorPlan($plan); // contiene las actividaes del plan de trabajo


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
                    <h4 class="h5">Actividaes</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>

                <div class="h-75">
                    <div class="card">
                        <div class="card-header text-center h5 text-muted p-3">
                            Lista de actividades
                        </div>
                        <div class="card-body">
                            <div class="table-responsive px-5 py-4">
                                <table class="table table-bordered text-center">
                                    <thead class="text-white bg-success">
                                        <th> Clave</th>
                                        <th> Descripción </th>
                                        <th> Fecha de Alta </th>
                                    </thead>
                                    <tbody class="bg-white" style="color: black;">
                                        <?php
                                        foreach ($plan_trabajo as $act) {
                                        ?>
                                            <tr>
                                                <td><?php echo $act->clave_actividad; ?></td>
                                                <td>
                                                    <p><?php echo $act->desc_actividad; ?></p>
                                                </td>
                                                <td><?php echo date_format(date_create($act->fecha_alta), "d-m-Y"); ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "layouts/footer-layout.php"; ?>
            </main>
        </div>
    </div>


</body>

</html>