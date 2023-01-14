let dropArea = document.getElementById("drop-area");
let fileInput = document.getElementById("file-input");

dropArea.addEventListener("mouseenter", highlight);
dropArea.addEventListener("mouseover", highlight);
dropArea.addEventListener("mouseleave", unhighlight);
dropArea.addEventListener("dragenter", highlight);
dropArea.addEventListener("dragover", highlight);
dropArea.addEventListener("dragleave", unhighlight);
//dropArea.addEventListener("drop", unhighlight);
dropArea.addEventListener("drop", handleDrop);

fileInput.addEventListener("change", handleSelect);

function highlight(e) {
    e.preventDefault();
    e.stopPropagation();
    dropArea.classList.add('highlight');
}

function unhighlight(e) {
    e.preventDefault();
    e.stopPropagation();
    dropArea.classList.remove('highlight');
}

function handleDrop(e) {
    e.preventDefault();

    let files = e.dataTransfer.files;

    fileInput.files = files;

    handleFiles(files);
}

function handleSelect() {
    let files = fileInput.files;

    handleFiles(files);
}

function handleFiles(files) {

    allowedExtensions = [
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "application/pdf",
        "image/png",
        "image/jpeg",
        "image/gif"
    ]

    if(files.length > 1) {
        window.alert("Debes subir un solo archivo como evidencia.");
        return;
    }

    let file = files[0];

    if(!allowedExtensions.some(function (value){
        return value === file.type;
    })) {
        window.alert("La extension del archivo es incorrecta");
        return;
    }

    console.log(file.type);

    showSubmitBtn(file.name);
}

function showSubmitBtn(fname) {
    document.getElementById("file-name").innerHTML = fname;
    document.getElementById("file-info").classList.remove("hidden");
}