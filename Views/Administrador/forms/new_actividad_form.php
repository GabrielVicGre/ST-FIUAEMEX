<form action="Views/Administrador/actividades.php" class="needs-validation" novalidate method="POST">
    <div class="row">
        <div class="col-12">
            <label class="form-label" for="clave_actividad">Código:</label><br>
            <input type="text" maxlength="10" class="form-control" name="clave_actividad" id="clave_actividad" required>
            <div class="valid-feedback">
                OK!
            </div>
            <div class="invalid-feedback">
                Ingresa un código de máximo 10 carácteres.
            </div>
        </div>
        <div class="col-12 mt-2">
            <label class="form-label" for="desc_actividad">Descripción:</label><br>
            <textarea name="desc_actividad" maxlength="200" class="form-control" id="desc_actividad" rows="7" required></textarea>
            <div class="valid-feedback">
                OK!
            </div>
            <div class="invalid-feedback">
                Ingresa máximo 200 carácteres.
            </div>
        </div>
        <div class="text-center mt-2">
            <input type="submit" class="btn btn-guardar btn-sm" name="add" value="Guardar">
        </div>
    </div>
</form>