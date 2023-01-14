<?php

session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Alumno") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'ayuda';
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'layouts/head-layout.php'; ?>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

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
                    <h4 class="h5">Ayuda</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>

                <div class="containeer px-5 py-2">
                    <div class="card">
                        <div class="card-header text-center">
                            Ayuda para alumnos
                        </div>
                        <div class="card-body text-center">
                             <video src="Assets/Videos/Alumno/VID_ALUMNO.mp4" class="img-fluid" style="width: 75%;" controls autoplay loop></video>
                        </div>
                        <div class="card-footer text-center">
                            Semestre 2022B
                        </div>
                    </div>
                </div>
                <br>
                <?php include "layouts/footer-layout.php"; ?>


            </main>
        </div>
    </div>

</body>

</html>