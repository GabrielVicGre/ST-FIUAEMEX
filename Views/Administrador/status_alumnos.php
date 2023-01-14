<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Administrador" ) {
    header("Location: ../../index.php");
}else{
    $_SESSION['seccion_menu'] = 'status_alumnos';
}

if(!isset($_GET['id_licenciatura'])) {
    $_GET['id_licenciatura'] = 1;
}

include_once "../../Controllers/Administrador/estatusAlumnosController.php";

$controller_estatus = new estatusAlumnosController();
?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'layouts/head-layout.php'; ?>
    <link href="Assets/CSS/Administrador/status.css" rel="stylesheet" />
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
                    <h4 class="h5">Status</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>
                <div class="mt-3 card text-center">
                    <div class="card-header">
                        <div class="card-title">
                            <?php include "layouts/lic-nav-status-alumnos.php"; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        $controller_estatus->tablaEstatusAlumnos($_GET['id_licenciatura']);
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>


</html>