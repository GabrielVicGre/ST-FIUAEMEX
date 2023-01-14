<form enctype="multipart/form-data" action="" method="POST">
    <div class="col-sm-6 m-auto">
        <div>
            <input type="hidden" name="id_actividad" value="<?php echo $_POST['id_actividad'];?>">
            <input type="file" id="file-input" name="file">
            <label for="file-input" id="drop-area" class="drop-area">
                <i class="bi bi-download"></i><br>
                Selecciona o arrastra un archivo aquí. <br>
                Los archivos permitidos son: PDF, WORD, JPG, PNG y JPEG.

            </label>
        </div>
        <div class="hidden" id="file-info">
            <div class="card m-1">
                <span id="file-name"></span>
            </div>
            <input class="btn btn-success" type="submit" name="submit" value="Enviar">
        </div>
    </div>
</form>