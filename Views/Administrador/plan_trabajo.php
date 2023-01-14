<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Administrador" ) {
    header("Location: ../../index.php");
}else{
    $_SESSION['seccion_menu'] = 'plan_trabajo';
}

/* EDITAR PLAN DE TRABJO */
include_once "../../Controllers/Administrador/actividadesController.php";
include_once "../../Controllers/Administrador/editarPlanController.php";

$controllerPlan = new editarPlanController();
$controllerActvidades = new actividadesController();
if (isset($_POST['selectIdAct'])) {
    $id_lic = $_POST['id_licenciatura'];
    $controllerPlan->add_Actividad_A_Plan($_POST['selectIdAct'], $id_lic);
    header("Location: plan_trabajo.php?id_licenciatura=" . $id_lic);
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'layouts/head-layout.php'; ?>
    <link href="Assets/CSS/Administrador/plan_trabajo.css" rel="stylesheet" />
</head>

<body>

    <?php include 'layouts/header-layout.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <?php include 'layouts/menu-layout.php'; ?>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="h5">Plan de Trabajo</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>

                <a href="Views/Administrador/actividades.php" class="btn btn-outline-secondary btn-sm">Actividades Registradas </a>

                <div class="mt-3 card text-center">
                    <div class="card-header">
                        <div class="card-title">
                            <?php include "layouts/lic-nav.php"; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <aside class="bg-light">
                            <div class="container">
                                <div class="row">
                                    <div class="col-2">
                                        <h6>Actividades</h6>
                                        <form action="Views/Administrador/plan_trabajo.php" method="POST">
                                            <button type="submit" class="btn btn-success btn-sm mb-2 mt-4" name="agregar">
                                                <i class="fa-solid fa-plus"></i> Agregar
                                            </button>
                                            <?php
                                            $acts = $controllerActvidades->listActividadesAvailable($_GET['id_licenciatura']);
                                            echo '<select class="form-select form-select-sm" aria-label=".form-select-sm example" name="selectIdAct">';
                                            foreach ($acts as $act) {
                                            ?>
                                                <?php echo '<option value="' . $act['id_actividad'] . '">' . $act['clave_actividad'] . '</option>'; ?>
                                            <?php
                                            }
                                            echo '</select>';
                                            ?>
                                            <input type="hidden" name="id_licenciatura" value="<?php echo $_GET['id_licenciatura']  ?>">
                                        </form>
                                    </div>

                                    <div class="col-10">
                                        <h6>Plan de trabajo</h6>
                                        <table class="table table-bordered text-center table-responsive">
                                            <tr class="text-white" style="background-color: #00BFA0;">
                                                <td> Clave </td>
                                                <td> Descripción</td>
                                            </tr>
                                            <?php
                                            $acts = $controllerPlan->listPlanesTrabajoPorLic($_GET['id_licenciatura']);
                                            foreach ($acts as &$act) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $act['clave_actividad']; ?></td>
                                                    <td>
                                                        <p class="short"><?php echo $act['desc_actividad']; ?></p>
                                                    </td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>

                                    </div>
                                </div>

                            </div>
                        </aside>

                    </div>
                    <div class="card-footer text-muted">
                        Semestre 2022B
                    </div>
                </div>
                <?php include "layouts/footer-layout.php"; ?>

            </main>

        </div>
    </div>


</body>



</html>