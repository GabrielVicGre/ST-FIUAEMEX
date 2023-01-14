<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Administrador") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'plan_trabajo';
}

require "../../Controllers/Administrador/actividadesController.php";
$controller = new actividadesController();
if (isset($_POST['add'])) {
    $controller->addActividad();
}
if (isset($_POST['update'])) {
    $controller->editActividad();
}
if (isset($_GET['delete'])) {
    $controller->deleteActividad();
}

?>

<!DOCTYPE html>
<html>

<head>
    <?php include 'layouts/head-layout.php'; ?>
    <link rel="stylesheet" href="Assets/CSS/Administrador/actividades.css">
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
                    <h4 class="h5">Actividades</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="Views/Administrador/plan_trabajo.php?id_licenciatura=1">Plan de trabajo</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Registro de actividades</li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                Registro de actividades
                            </div>
                            <div class="card-body">
                                <?php
                                $action = isset($_GET['action']) ? $_GET['action'] : "new";
                                switch ($action) {
                                    case "new":
                                        include "forms/new_actividad_form.php";
                                        break;
                                    case "edit":
                                        include "forms/edit_actividad_form.php";
                                        break;
                                    case "cancel":
                                    default:
                                        header("Location: ../../Views/Administrador/actividades.php?action=new");
                                }
                                ?>
                            </div>
                        </div>
                        <a class="btn btn-sm btn-success my-4" href="Views/Administrador/plan_trabajo.php?id_licenciatura=1"><i class="bi bi-arrow-left-circle "> </i>Regresar</a>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="card">
                            <div class="card-header text-center">
                                Actividades Registradas
                            </div>
                            <div class="card-body p-0 m-0">
                                <div class="overflow-auto" style="max-height: 358px;">
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead class="bg-secondary text-white">
                                                <th style="width: 15%;"> Clave</th>
                                                <th class="border" style="width: 50%;"> Descripción </th>
                                                <th class="border" style="width: 15%;"> Fecha </th>
                                                <th style="width: 20%;"> Opciones</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $acts = $controller->listActividades();
                                                foreach ($acts as &$act) {
                                                ?>
                                                    <tr class="mb-0 pb-0">
                                                        <form action="Views/Administrador/actividades.php" method="GET">
                                                            <td><?php echo $act['clave_actividad']; ?></td>
                                                            <td class="long border">
                                                                <p class="clamp"><?php echo $act['desc_actividad']; ?></p>
                                                            </td>
                                                            <td class="border"><?php echo date_format(date_create($act['fecha_alta']), "d-m-Y"); ?></td>
                                                            <td>
                                                                <div class="btn-group" role="group" aria-label="Basic example">

                                                                    <button class="btn btn-editar btn-sm submit-btn" type="submit" name="action" value="edit">
                                                                        Editar <i class="fa fa-pencil" aria-hidden="true"></i>
                                                                    </button>

                                                                    <button class="btn btn-borrar btn-sm submit-btn" type="submit" name="delete" value="delete">
                                                                        Borrar<i class="fa fa-times" aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                            <input type="hidden" name="id_actividad" value="<?php echo $act['id_actividad']; ?>">
                                                        </form>
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
                    </div>
                </div>





                <?php include "layouts/footer-layout.php"; ?>

            </main>

        </div>
    </div>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

</body>

</html>