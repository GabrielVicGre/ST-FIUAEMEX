<?php
session_start();
if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] != "Tutor") {
    header("Location: ../../index.php");
} else {
    $_SESSION['seccion_menu'] = 'acercaDe';
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
                    <h4 class="h5">Acerca de este sistema</h4>
                    <?php include "layouts/user-layout.php"; ?>

                </div>
                

               
                <section class="text-center container">
                    <div class="row py-lg-3">
                        <div class="col-lg-8 col-md-8 mx-auto">
                            <h4 class="fw-bold text-muted">S.T. V.1.0 2022</h4>
                            <p style="font-size: 18px;" class="lead text-muted">
                                Este sistema tiene como objetivo
                                administrar la información de las actividades 
                                que se llevan a cabo en cada semestre por los alumnos de 
                                cada una de las licenciaturas de la 
                                Facultad de Ingeniería - UAEMéx. 
                                <br>
                            <h6 class="pt-0 text-secondary">Semestre 2022B</h6>

                            </p>

                            <div class="text-center p-3">
                                <img src="Assets/Images/imgabout.jpg" style="width: 32%;" class="img-fluid" alt="...">
                            </div>
                            <p>
                                <a href="Views/Tutor/index.php" class="btn btn-secondary my-3">Regresar al inicio</a>
                                <a href="Config/Salir.php" class="btn btn-success my-3">Cerrar sesión</a>
                            </p>
                        </div>
                    </div>
                </section>
                <br>
                <?php include "layouts/footer-layout.php"; ?>

            </main>
        </div>
    </div>


  
</body>

</html>