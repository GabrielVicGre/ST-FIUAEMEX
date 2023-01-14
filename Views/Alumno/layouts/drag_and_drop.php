<div id="drop-area">
    <form class="drop-area-form">
        <input type="file" id="fileElem" accept="image/*" onchange="handleFile(this.files[0])">
        <label id="fileInput" for="fileElem">
            <p>Selecciona o arrastra un archivo</p>
            <p><i class="fa fa-cloud-upload" aria-hidden="true"></i></p>
        </label>
    </form>
</div>
<div id="file-upload" class="hidden">
    <i class="fa fa-file" aria-hidden="true"></i>
    <p id="file-name"></p>
    <progress id="progress-bar" max="100" value="0"></progress>
    <button id="upload-btn" class="submit-btn">Enviar</button>
</div>