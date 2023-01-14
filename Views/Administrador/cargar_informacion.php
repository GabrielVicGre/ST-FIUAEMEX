<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Administrador") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'cargar_informacion';
}

if (!isset($_GET['tab'])) {
    $_GET['tab'] = "alumnos";
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'layouts/head-layout.php'; ?>
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
                    <h4 class="h5">Cargar Información</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>

                <div class="pt-2">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab">
                                <li class="nav-item">
                                    <a href="#alumnos" style="border-radius: 5px 5px 0px 0px !important; color: gray;" class="nav-link <?php echo $_GET['tab'] == "alumnos" ? "active" : "" ?>" data-bs-toggle="tab">Alumnos inscritos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tutores" style="border-radius: 5px 5px 0px 0px !important; color: gray;" class="nav-link <?php echo $_GET['tab'] == "tutores" ? "active" : "" ?>" data-bs-toggle="tab">Tutores</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#alumno-tutor" style="border-radius: 5px 5px 0px 0px !important; color: gray;" class="nav-link <?php echo $_GET['tab'] == "alumno-tutor" ? "active" : "" ?>" data-bs-toggle="tab">Alumno - Tutor</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#materias" style="border-radius: 5px 5px 0px 0px !important; color: gray;" class="nav-link <?php echo $_GET['tab'] == "materias" ? "active" : "" ?>" data-bs-toggle="tab">Materias</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade <?php echo $_GET['tab'] == "alumnos" ? "show active" : "" ?>" id="alumnos">
                                    <h5 class="card-title">Alumnos Inscritos</h5>
                                    <p class="card-text">Asegurate que el archivo que subas tenga la extención .csv</p>
                                    <div>
                                        <?php $id = 0; ?>
                                        <form id="drag-and-drop-form-<?php echo $id; ?>" enctype="multipart/form-data" action="Controllers/Administrador/uploadAlumnosInscritos.php" method="POST">
                                            <div class="col-sm-6 m-auto">
                                                <?php
                                                include "layouts/drag_and_drop_csv.php";
                                                if (isset($_GET['msg']) ) {
                                                    if ($_GET['msg'] == 0) {
                                                        include 'layouts/upload_success.php';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo $_GET['tab'] == "tutores" ? "show active" : "" ?>" id="tutores">
                                    <h5 class="card-title">Tutores</h5>
                                    <p class="card-text">Asegurate que el archivo que subas tenga la extención .csv</p>
                                    <div>
                                        <?php $id = 1; ?>
                                        <form id="drag-and-drop-form-<?php echo $id; ?>" enctype="multipart/form-data" action="Controllers/Administrador/uploadTutores.php" method="POST">
                                            <div class="col-sm-6 m-auto">
                                                <?php
                                                include "layouts/drag_and_drop_csv.php";
                                                if (isset($_GET['msg']) ) {
                                                    if ($_GET['msg'] == 1) {
                                                        include 'layouts/upload_success.php';
                                                    }
                                                }
                                                ?>
                                            </div>    
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo $_GET['tab'] == "alumno-tutor" ? "show active" : "" ?>" id="alumno-tutor">
                                    <h5 class="card-title">Alumno - Tutor</h5>
                                    <p class="card-text">Asegurate que el archivo que subas tenga la extención .csv</p>
                                    <div>
                                        <?php $id = 2; ?>
                                        <form id="drag-and-drop-form-<?php echo $id; ?>" enctype="multipart/form-data" action="Controllers/Administrador/uploadAlumnoTutor.php" method="POST">
                                            <div class="col-sm-6 m-auto">
                                                <?php
                                                include "layouts/drag_and_drop_csv.php";
                                                if (isset($_GET['msg']) ) {
                                                    if ($_GET['msg'] == 2) {
                                                        include 'layouts/upload_success.php';
                                                    }
                                                }
                                                ?>
                                            </div>    
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade <?php echo $_GET['tab'] == "materias" ? "show active" : "" ?>" id="materias">
                                    <h5 class="card-title">Materias</h5>
                                    <p class="card-text">Asegurate que el archivo que subas tenga la extención .csv</p>
                                    <div>
                                        <?php $id = 3; ?>
                                        <form id="drag-and-drop-form-<?php echo $id; ?>" enctype="multipart/form-data" action="Controllers/Administrador/uploadMaterias.php" method="POST">
                                            <div class="col-sm-6 m-auto">
                                                <?php
                                                include "layouts/drag_and_drop_csv.php";
                                                if (isset($_GET['msg']) ) {
                                                    if ($_GET['msg'] == 3) {
                                                        include 'layouts/upload_success.php';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-secondary btn-sm my-1" href="Config/resetBD.php">Limpiar Base de datos</a>

                </div>
                <?php include "layouts/footer-layout.php"; ?>

            </main>
        </div>
    </div>
</body>

<script src="Assets/Scripts/drag_and_drop_csv.js"></script>
<script>
    new DragAndDrop(0);
    new DragAndDrop(1);
    new DragAndDrop(2);
    new DragAndDrop(3);
</script>

</html>