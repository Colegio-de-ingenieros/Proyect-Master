window.onload = function () {
    document.getElementById("radio_gastos").checked=true;
    document.getElementById("radio_ingresos").checked=false;
    obtener_Datos();
    rellenar_tabla("gastos");
}


const radioButtons = document.querySelectorAll('input[name="radio"]');
for (const radioButton of radioButtons) {
  radioButton.addEventListener('change', verSeleccion);
}

function verSeleccion(e){
    if (this.checked) {
        tipo=this.value
        rellenar_tabla(tipo);
    }
}

//Llena las secciones de instructores y participantes
function obtener_Datos(){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var participante = split[1];

    let url = "../../controller/administrativo/Mostrar_Participante.php";

    let form = new FormData();
    form.append("participante", participante);
    fetch(url, {
    method: "POST",
    body: form
    })
        .then(response => response.json())
        .then(data => {
        console.log(data)
        let titulo= "Participante: " + data[0][0]
        document.getElementById('encabezado').innerHTML = titulo;
    }) 
}

function rellenar_tabla(tipo){
    let urlAct = window.location+''
    let split = urlAct.split("=");
    var participante = split[1];
    console.log(participante, tipo)

    $.ajax({
        url: '../../controller/administrativo/Mostrar_Gastos_Ingresos_Tabla.php',
        type: 'POST',
        dataType: 'html',
        data: { participante: participante, tipo: tipo},
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