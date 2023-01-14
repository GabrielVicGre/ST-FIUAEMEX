<?php
$act = $controller->getActividad($_GET['id_actividad']);
?>

<form action="Views/Administrador/actividades.php" class="needs-validation" novalidate method="POST">
    <input type="hidden" name="id_actividad" value="<?php echo $_GET['id_actividad']; ?>">
    <div class="row">
        <div class="col-12">
            <label class="form-label" for="nombre_actividad">Código:</label>
            <input required maxlength="10" type="text" class="form-control" name="clave_actividad" id="clave_actividad" value="<?php echo $act['clave_actividad']; ?>">
            <div class="valid-feedback">
                OK!
            </div>
            <div class="invalid-feedback">
                Ingresa un código de máximo 10 carácteres.
            </div>
        </div>
        <div class="col-12">
            <label class="form-label mt-2" for="desc_actividad">Descripción:</label>
            <textarea required maxlength="200" name="desc_actividad" class="form-control" id="desc_actividad" rows="7"><?php echo $act['desc_actividad']; ?></textarea>
            <div class="valid-feedback">
                OK!
            </div>
            <div class="invalid-feedback">
                Ingresa máximo 200 carácteres.
            </div>
        </div>
    </div>
    <div class="container text-center mt-2">
        <input type="submit" class="btn btn-guardar btn-sm" name="update" value="Guardar">
        <button class="btn btn-borrar submit-btn btn-sm" type="submit" name="action" value="cancel">Cancelar</button>
    </div>
</form>