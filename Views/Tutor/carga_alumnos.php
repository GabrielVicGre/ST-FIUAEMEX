<?php

session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Tutor") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'carga_alumnos';
}

require_once "../../Controllers/Tutor/AlumInscritosController.php";
$alumnInscritosController = new AlumInscritosController();

$result = $alumnInscritosController->getMateriasTutorByIdUser($_SESSION['id_usuario']);


if (isset($_GET['delete'])) {
    $alumnInscritosController->deleteGroupAndAlumInscritos($_GET['id_grupo']);
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
                    <h4 class="h5">Carga de alumnos incritos por materia</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>

                <div class="container h-75">
                    <a href="Views/Tutor/nuevo_grupo.php" class="btn btn-sm btn-outline-secondary my-3 ">
                        <i class="bi bi-plus-circle px-1"></i> Registrar grupo
                    </a>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead style="background-color: #008959;">
                                <tr class="text-white">
                                    <th> Grupo </th>
                                    <th> Clave </th>
                                    <th> Materia </th>
                                    <th> Inscritos </th>
                                    <th> Opciones </th>
                                </tr>
                            </thead>
                            <?php
                            $materias = array();
                            while ($materias = $result->fetch_array(MYSQLI_ASSOC)) {
                                $alumInsPerGroup = $alumnInscritosController->getNumAlumnPerGroup($materias['id_grupo']);
                            ?>
                                <tbody>
                                    <form action="Views/Tutor/carga_alumnos.php" method="GET">
                                        <tr>
                                            <td><?php echo $materias['nombre_gpo']; ?></td>
                                            <td><?php echo $materias['clave']; ?></td>
                                            <td><?php echo $materias['nombre']; ?></td>
                                            <td><?php echo $alumInsPerGroup ?> Alumnos </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="Views/Tutor/estatus_alumnos.php?id_grupo=<?php echo $materias['id_grupo'] ?>" class="btn btn-sm text-white" style="background-color: #C5A42A;"> <i class="bi bi-plus-square"></i> </a>
                                                    <button class="btn btn-sm text-white" style="background-color:#85929E" type="submit" name="delete" value="delete">
                                                        <i class='bi bi-x-circle'></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <input type="hidden" name="id_grupo" value="<?php echo $materias['id_grupo'] ?>">
                                        </tr>
                                    </form>
                                </tbody>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <?php include "layouts/footer-layout.php"; ?>
            </main>
        </div>
    </div>
</body>



</html>