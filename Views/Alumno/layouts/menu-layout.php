<div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column ">
        <li class="nav-item mx-1 mt-3">
            <a class="nav-link text-white <?php echo $_SESSION['seccion_menu'] == 'index' ? 'selected'  : '' ?>" aria-current="page" href="Views/Alumno/index.php">
                <i class="bi bi-house-fill mx-2"></i>
                Inicio
            </a>
        </li>
        <li class="nav-item mx-1">
            <a class="nav-link text-white <?php echo $_SESSION['seccion_menu'] == 'perfil' ? 'selected'  : '' ?>" href="Views/Alumno/perfil.php">
                <i class="bi bi-person-lines-fill mx-2"></i>
                Perfil
            </a>
        </li>

        <li class="nav-item mx-1">
            <a class="nav-link text-white <?php echo $_SESSION['seccion_menu'] == 'actividades' ? 'selected'  : '' ?>" href="Views/Alumno/actividades.php">
                <i class="bi bi-bar-chart-line-fill mx-2"></i>
                Actividades
            </a>
        </li>
    </ul>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 py-2 mt-4 mb-1 text-bg-success text-uppercase">
        <span>Información Adicional</span>
        <a class="link-secondary text-white" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
        </a>
    </h6>
    <ul class="nav flex-column mb-2 mx-1">
        <li class="nav-item">
            <a class="nav-link text-white <?php echo $_SESSION['seccion_menu'] == 'ayuda' ? 'selected'  : '' ?>" href="Views/Alumno/ayuda.php">
                <i class="bi bi-question-octagon mx-2"></i>
                Ayuda
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?php echo $_SESSION['seccion_menu'] == 'acercaDe' ? 'selected'  : '' ?>" href="Views/Alumno/acercaDe.php">
                <i class="bi bi-info-circle mx-2"></i>
                Acerca de
            </a>
        </li>
    </ul>
    <div class="d-grid pt-5 text-center">
        <a href="Config/Salir.php" class="btnSalir">
            <i class="bi bi-box-arrow-right icon-Salir"></i>
        </a>
    </div>
</div>