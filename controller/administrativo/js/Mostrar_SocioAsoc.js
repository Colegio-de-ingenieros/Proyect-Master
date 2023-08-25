window.onload = function () {
    obtener_Datos();
    rellenar_tabla();
   
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
            parrafo.innerHTML = data[0];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("ap_paterno");
            parrafo.innerHTML = data[1];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("ap_materno");
            parrafo.innerHTML = data[2];
            var parrafo = document.createElement("p");
            
            var parrafo= document.getElementById("fecha_nacimiento");
            parrafo.innerHTML = data[3];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("tel_fijo");
            parrafo.innerHTML = data[4];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("tel_movil");
            parrafo.innerHTML = data[5];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("correo");
            parrafo.innerHTML = data[6];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("cedula");
            parrafo.innerHTML = data[7];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("codigo_postal");
            parrafo.innerHTML = data[8];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("calle_numero");
            parrafo.innerHTML = data[9];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("colonia");
            parrafo.innerHTML = data[10];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("ciudad");
            parrafo.innerHTML = data[11];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("estado");
            parrafo.innerHTML = data[12];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("grado_estudio");
            parrafo.innerHTML = data[13];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("Empresa");
            parrafo.innerHTML = data[14];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("Puesto");
            parrafo.innerHTML = data[15];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("correo_laboral");
            parrafo.innerHTML = data[16];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("tel_oficina");
            parrafo.innerHTML = data[17];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("extension");
            parrafo.innerHTML = data[18];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("funcion");
            parrafo.innerHTML = data[19];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("cedulaSiNo");
            parrafo.innerHTML = data[20];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("pasantia");
            parrafo.innerHTML = data[21];
            var parrafo = document.createElement("p");

            var parrafo= document.getElementById("encabezado");
            parrafo.innerHTML = data[22];
            var parrafo = document.createElement("p");

            if(data[22]=='Datos del asociado'){
                document.getElementById("radio_socio").checked=false;
                document.getElementById("radio_asociado").checked=true;
            }else{
                document.getElementById("radio_asociado").checked=false;
                document.getElementById("radio_socio").checked=true;
            }
        }) 
}

function rellenar_tabla(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idP = split[1];

    $.ajax({
        url: '../../controller/administrativo/Mostrar_SocioAsoc_Individual.php',
        type: 'POST',
        dataType: 'html',
        data: {idP: idP },
    })

        .done(function (respuesta)
        {
            $("#tablaResultado").html(respuesta);
        })
        .fail(function ()
        {
            console.log("error");
        })
}

formulario_usuario.addEventListener('submit', function (e){
    e.preventDefault();
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var idP = split[1];
    let tipo=''
    if(document.getElementById("radio_asociado").checked){
        tipo='asociado'
    }else{
        tipo='socio'
    }

    let url = "../../controller/administrativo/Modificar_Tipo_Usuario.php";

    let form = new FormData(formulario_usuario);
    form.append("tipo", tipo);
    form.append("idP", idP);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
            alert(data);

    }) 
})