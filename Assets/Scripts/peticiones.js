document.getElementById("nom_materia").addEventListener("keyup", getCodigos);

function getCodigos() {

    let inputCP = document.getElementById("nom_materia").value
    let lista = document.getElementById("lista")
    lista.style.height = '160px';
    lista.style.width = '100%';

    lista.style.overflowY= 'scroll';


    if (inputCP.length > 0) {
        let url = "Assets/inc/getCodigos.php"
        let formData = new FormData()
        formData.append("nom_materia", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors" //Default cors, no-cors, same-origin
        }).then(response => response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))
    } else {
        lista.style.display = 'none'
    }
}

function mostrar(id_materia,clave,nombre) {
    document.getElementById('id_materia').value=id_materia;
    document.getElementById('clv_materia').value=clave;
    document.getElementById('nom_materia').value=nombre;
    lista.style.display = 'none';
}

function limpiar(){
    lista.style.display = 'none';
    document.getElementById('id_materia').value="";
    document.getElementById('clv_materia').value="";
    document.getElementById('nom_materia').value="";
}
