        <div>
            <input type="file" id="file-input-<?php echo $id; ?>" name="csv_file" required>
            <label for="file-input-<?php echo $id; ?>" id="drop-area-<?php echo $id; ?>" class="drop-area">
                <i class="bi bi-download"></i><br>
                Selecciona o arrastra un archivo CSV aquí.
            </label>
        </div>
        <div class="hidden" id="file-info-<?php echo $id; ?>">
            <div class="card m-1">
                <i class="bi bi-filetype-csv"></i><span id="file-name-<?php echo $id; ?>"></span>
            </div>
            <button class="btn btn-success pl-2 pr-2" type="button" id="submit-btn-<?php echo $id; ?>">
                <i class="bi bi-cloud-arrow-up-fill mx-2"></i>Subir
            </button>
            <button class="btn btn-success pl-2 pr-2 hidden" id="loading-btn-<?php echo $id; ?>" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Loading...</span>
            </button>
        </div>