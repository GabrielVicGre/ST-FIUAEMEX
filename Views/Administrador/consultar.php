<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Administrador") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'consultar';
}

include_once "../../Controllers/Administrador/consultarController.php";

$controller_consulta = new consultarController();

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
                    <h4 class="h5">Consultar Información</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>

                <div class="pt-2">
                    <div class="card text-center">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" id="myTab">
                                <li class="nav-item">
                                    <a href="#alumnos" style="border-radius: 5px 5px 0px 0px !important; color: gray;" class="nav-link <?php echo $_GET['tab'] == "alumnos" ? "active" : "" ?>" data-bs-toggle="tab">Alumnos</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tutores" style="border-radius: 5px 5px 0px 0px !important; color: gray;" class="nav-link <?php echo $_GET['tab'] == "tutores" ? "active" : "" ?>" data-bs-toggle="tab">Tutores</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane pt-0 fade <?php echo $_GET['tab'] == "alumnos" ? "show active" : "" ?>" id="alumnos">
                                    <div class="row col-sm-4">
                                        <form action="Views/Administrador/consultar.php" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="tab" value="alumnos">
                                                <input type="text" name="search" class="form-control" />
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    $search = isset($_GET['search']) && $_GET['tab'] == "alumnos" ? $_GET['search'] : "";

                                    $controller_consulta->listaAlumnos($search);
                                    ?>
                                </div>
                                <div class="tab-pane pt-0 fade <?php echo $_GET['tab'] == "tutores" ? "show active" : "" ?>" id="tutores">
                                    <div class="row col-sm-4">
                                        <form action="Views/Administrador/consultar.php" method="GET">
                                            <div class="input-group">
                                                <input type="hidden" name="tab" value="tutores">
                                                <input type="text" name="search" class="form-control" />
                                                <button type="submit" class="btn btn-success">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php
                                    $search = isset($_GET['search']) && $_GET['tab'] == "tutores" ? $_GET['search'] : "";

                                    $controller_consulta->listaTutores($search);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "../layouts/footer-layout.php"; ?>

            </main>
        </div>
    </div>
</body>


<script src="Assets/Scripts/drag_and_drop_csv.js"></script>
<script>
    new DragAndDrop(0);
    new DragAndDrop(1);
    new DragAndDrop(2);
</script>

</html>