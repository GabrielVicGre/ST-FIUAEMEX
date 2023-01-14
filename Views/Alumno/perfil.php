<?php

session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Alumno") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'perfil';
}


include_once ("../../Controllers/Alumno/alumnoController.php");
include_once ("../../Controllers/UsuarioController.php");

$id_usuario = $_SESSION['id_usuario'];

$usuarioController = new UsuarioController();
$alumnoController = new alumnoController();

$alumno = $alumnoController->getAlumnoData();
$usuario = $usuarioController->getUsuarioById($id_usuario);

$tutor = $alumnoController->getDatosTutorDeAlumno($alumno->id_alumno);
$usuario_tutor = $usuarioController->getUsuarioById($tutor->id_usuario);

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
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h4 class="h5">Perfil</h4>
                    <?php include "layouts/user-layout.php"; ?>
                </div>


                <div class="container py-3" style="background-image: url('Assets/Images/tapiz.png'); background-size: 100%;">
                    <div class="p-3">
                        <div class="container-fluid col-sm-12 col-lg-8 pb-2">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center text-secondary"> Datos de usuario </h5>
                                </div>
                                <div class="card-body">
                                    <div class="contaner">
                                        <div class="row">
                                            <div class="mb-3 row d-none">
                                                <div class="container text-center">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/1177/1177568.png"
                                                        style="width: 70px" class="img-fluid" alt="...">
                                                </div>
                                            </div>
                                            <?php
                                            //foreach ($datosUsuario as $datos) {
                                            ?>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Correo: </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $usuario->email; ?>"
                                                        aria-label="Disabled input example" disabled readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Nombre: </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $alumno->nombre; ?>"
                                                        aria-label="Disabled input example" disabled readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">No. Cuenta: </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $alumno->no_cuenta; ?>"
                                                        aria-label="Disabled input example" disabled readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Licenciatura: </label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext"
                                                        value="<?php echo $alumnoController->getLicenciaturaAlumno($alumno); ?>">
                                                </div>
                                            </div>
                                            <?php
                                            //}
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="container col-sm-12 col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center text-secondary"> Datos del Tutor </h5>
                                </div>
                                <div class="card-body">
                                    <div class="contaner">
                                        <div class="row">
                                            <div class="mb-3 row d-none">
                                                <div class="container text-center">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/1134/1134762.png"
                                                        style="width: 70px" class="img-fluid" alt="...">
                                                </div>
                                            </div>
                                            <?php
                                            //foreach ($datosTutorDeAlumno as $datos) {
                                            ?>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Correo: </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $usuario_tutor->email; ?>"
                                                        aria-label="Disabled input example" disabled readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Nombre: </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $tutor->nombre; ?>"
                                                        aria-label="Disabled input example" disabled readonly>
                                                </div>
                                            </div>


                                            <?php
                                            //}
                                            ?>
                                        </div>
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

</body>

</html>