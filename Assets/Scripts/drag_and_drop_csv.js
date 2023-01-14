class DragAndDrop {
    constructor(id) {
        this.id = id;
        this.dropArea = document.getElementById("drop-area-" + id);
        this.fileInput = document.getElementById("file-input-" + id);
        this.submitBtn = document.getElementById("submit-btn-" + id);
        this.loadingBtn = document.getElementById("loading-btn-" + id);
        this.dropArea.addEventListener("mouseenter", this.highlight.bind(this));
        this.dropArea.addEventListener("mouseover", this.highlight.bind(this));
        this.dropArea.addEventListener("mouseleave", this.unhighlight.bind(this));
        this.dropArea.addEventListener("dragenter", this.highlight.bind(this));
        this.dropArea.addEventListener("dragover", this.highlight.bind(this));
        this.dropArea.addEventListener("dragleave", this.unhighlight.bind(this));
        this.dropArea.addEventListener("drop", this.handleDrop.bind(this));

        this.fileInput.addEventListener("change", this.handleSelect.bind(this));

        this.submitBtn.addEventListener("click", this.loading.bind(this));

        console.log("Todo bien D&D - " + id);
    }

    highlight(e) {
        e.preventDefault();
        e.stopPropagation();
        this.dropArea.classList.add('highlight');
    }

    unhighlight(e) {
        e.preventDefault();
        e.stopPropagation();
        this.dropArea.classList.remove('highlight');
    }

    handleDrop(e) {
        e.preventDefault();

        let files = e.dataTransfer.files;

        this.fileInput.files = files;

        this.handleFiles(files);
    }

    handleSelect() {
        let files = this.fileInput.files;

        this.handleFiles(files);
    }

    handleFiles(files) {

        let allowedExtensions = [
            "text/csv"
        ]

        if (files.length > 1) {
            window.alert("Debes subir un solo archivo como evidencia.");
            return;
        }

        let file = files[0];

        console.log(file.type);

        if (!allowedExtensions.some(function (value) {
            return value === file.type;
        })) {
            window.alert("La extension del archivo es incorrecta");
            return;
        }

        this.showSubmitBtn(file.name);
    }

    showSubmitBtn(fname) {
        document.getElementById("file-name-" + this.id).innerHTML = fname;
        document.getElementById("file-info-" + this.id).classList.remove("hidden");
    }

    loading(e) {
        this.submitBtn.classList.add('hidden');
        this.loadingBtn.classList.remove("hidden");

        document.getElementById("drag-and-drop-form-" + this.id).submit();
    }
}