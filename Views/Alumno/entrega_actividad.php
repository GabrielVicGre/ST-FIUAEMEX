<?php

session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Alumno") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'actividades';
}

include_once ("../../Controllers/Alumno/alumnoController.php");
include_once ("../../Controllers/Alumno/actividadesController.php");
include_once ("../../Controllers/Alumno/entregaController.php");

$controller_actividades = new actividadesController();
$controller_alumno = new alumnoController();
$controller_entrega = new entregaController();

$id_alumno = $controller_alumno->getAlumnoData()->id_alumno;

$id_actividad = $_POST['id_actividad'];

$actividad = $controller_actividades->getActividadById($id_actividad);

if(isset($_POST['submit'])) {
    $controller_entrega->addEntrega();
} 

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

                <p id="id_actividad" style="display: none;"><?php echo $id_actividad; ?></p>
                <div class="container m-5">
                    <h1><?php echo "Actividad " . $actividad->clave_actividad; ?></h1>
                    <b>Instrucciones: </b><i><?php echo $actividad->desc_actividad; ?></i>
                    <hr>
                    <div>
                        <?php 
                            if($controller_entrega->entregado($id_actividad, $id_alumno)) {
                                echo "La actividad ya ha sido entregada";
                            } else {
                                include "layouts/drag_and_drop_2.php";
                            }
                        ?>
                    </div>
                    <br><a href="Views/Alumno/actividades.php" class="mt-3 btn btn-sm btn-success"><i class="bi bi-arrow-left-circle mx-1"></i>Regresar </a>
                </div>
                <br><br><br>
                <?php include "layouts/footer-layout.php"; ?>
            </main>
        </div>
    </div>

    <script src="Assets/Scripts/drag_and_drop_2.js"></script>

</body>

</html>