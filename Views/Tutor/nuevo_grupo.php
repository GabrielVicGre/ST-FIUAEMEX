<?php

session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Tutor") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'carga_alumnos';
}

include_once "../../Controllers/Tutor/AlumInscritosController.php";
$alumnInscritosController = new AlumInscritosController();
$result = $alumnInscritosController->getMateriasTutorByIdUser($_SESSION['id_usuario']);
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
                    <h4 class="h5">Registro de grupos</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>


                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="Views/Tutor/carga_alumnos.php">Grupos</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registro de grupos</li>
                    </ol>
                </nav>
                
                <br>

                <div class="p-1">
                    <?php
                    $id = 0;
                    ?>
                    <form id="drag-and-drop-form-<?php echo $id; ?>" enctype="multipart/form-data" action="Controllers/Tutor/uploadAlumnosMateria.php" method="POST" autocomplete="off">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            Nuevo registro
                                        </div>
                                        <div class="card-body">

                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-8 col-sm-12 ">
                                                        <label for="campo" class="form-label">Materia:</label><br>
                                                        <div class="btn-group w-100">
                                                            <input type="text" class="form-control" style="border-radius: 8px 0 0 8px;" name="nom_materia" id="nom_materia" placeholder="Ingresa nombre o clave de la materia">
                                                            <button class="btn text-white mx-1" onclick="limpiar()" style="background-color: #C1C1C1;"> Limpiar </button>
                                                        </div>
                                                        <ul class="list-group mt-2" id="lista">
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12">
                                                        <label for="grupo" class="form-label">Grupo:</label><br>
                                                        <input type="text" class="form-control" name="grupo" id="grupo" placeholder="Ingresa el nombre del grupo">
                                                        <input type="hidden" name="id_materia" id="id_materia">
                                                        <input type="hidden" name="clv_materia" id="clv_materia">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card text-center my-4 mx-3 p-3 ">
                                                <h5 class="card-title">Sube la lista de los alumnos inscritos</h5>
                                                <p class="card-text">Asegurate que el archivo que subas tenga la extención .csv</p>
                                                <div class="col-sm-6 m-auto">
                                                    <?php
                                                    include "layouts/drag_and_drop_csv.php";
                                                    if (isset($_GET['msg'])) {
                                                        if ($_GET['msg'] == 0) {
                                                            include 'layouts/upload_success.php';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <br><a href="Views/Tutor/carga_alumnos.php" class="btn btn-sm btn-success"><i class="bi bi-arrow-left-circle mx-1"></i>Regresar </a>
                </div>
                <br> <br> <br>
                <?php include "../layouts/footer-layout.php"; ?>
            </main>
        </div>
    </div>
</body>
    <script src="Assets/Scripts/peticiones.js"></script>
    <script src="Assets/Scripts/drag_and_drop_csv.js"></script>
    <script>
        new DragAndDrop(0);
    </script>

</html>