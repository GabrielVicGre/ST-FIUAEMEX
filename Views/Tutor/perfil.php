<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Tutor") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'perfil';
}

include_once ("../../Controllers/Tutor/tutorController.php");
include_once ("../../Controllers/UsuarioController.php");

$usuarioController = new UsuarioController();
$tutorController = new tutorController();
$id_usuario = $_SESSION['id_usuario'];

$usuario = $usuarioController->getUsuarioById($id_usuario);
$tutor = $tutorController->getDatosUsuarioTutor($id_usuario);
 
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
                <div class="container bg-light rounded mb-2">
                    <div class="px-sm-1 p-2 p-lg-5">
                        <div class="container-fluid col-lg-8 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center text-secondary"> Datos de tutor </h5>
                                </div>
                                <div class="card-body">
                                    <div class="contaner">
                                        <div class="row">
                                            <div class="mb-3 row">
                                                <div class="container text-center">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/1177/1177568.png"
                                                        style="width: 70px" class="img-fluid" alt="...">
                                                </div>
                                            </div>                                         
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Usuario: </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $usuarioController->getTipoUsuario($usuario); ?>"
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
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Correo: </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text"
                                                        value="<?php echo $usuario->email; ?>"
                                                        aria-label="Disabled input example" disabled readonly>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Clave: </label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext"
                                                        value="<?php echo $tutor->cve_tutor; ?>">
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label">Licenciatura: </label>
                                                <div class="col-sm-9">
                                                    <input type="text" readonly class="form-control-plaintext"
                                                        value="<?php echo $tutorController->getDatosLicById($tutor->id_licenciatura);?>">
                                                </div>
                                            </div>                                           
                                        </div>
                                    </div>
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

</html>