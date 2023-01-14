<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Administrador" ) {
    header("Location: ../../index.php");
}else{
    $_SESSION['seccion_menu'] = 'respaldar';
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
                    <h4 class="h5">Respaldar</h4>
                    <?php include "layouts/user-layout.php"; ?>

                </div>
            </main>
        </div>
    </div>

</body>

</html>