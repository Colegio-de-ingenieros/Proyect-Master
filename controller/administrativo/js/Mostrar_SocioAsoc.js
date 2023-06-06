window.onload = function () {
    obtener_Datos()
}

function obtener_Datos(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idP = split[1];
    let url = "../../controller/administrativo/Get_SocioAsoc.php";

    let form = new FormData();
    form.append("idP", idP);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var parrafo= document.getElementById("nombre");
            parrafo.innerHTML = data[0][0];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("ap_paterno");
            parrafo.innerHTML = data[0][1];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("ap_materno");
            parrafo.innerHTML = data[0][2];
            var parrafo = document.createElement("p");
            

            var parrafo= document.getElementById("fecha_nacimiento");
            parrafo.innerHTML = data[0][3];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("tel_fijo");
            parrafo.innerHTML = data[0][4];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("tel_movil");
            parrafo.innerHTML = data[0][5];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("correo");
            parrafo.innerHTML = data[0][6];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("cedula");
            parrafo.innerHTML = data[0][7];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("calle_numero");
            parrafo.innerHTML = data[0][8];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("codigo_postal");
            parrafo.innerHTML = data[1][0];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("colonia");
            parrafo.innerHTML = data[1][1];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("ciudad");
            parrafo.innerHTML = data[1][2];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("estado");
            parrafo.innerHTML = data[1][3];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("grado_estudio");
            parrafo.innerHTML = data[2][0];
            var parrafo = document.createElement("p");


        }) 
}