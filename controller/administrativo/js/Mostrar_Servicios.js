let tipo;
window.onload = function () {
    console.log("cargar")
    document.getElementById("radio_headhunter").checked=false;
    document.getElementById("radio_outplacement").checked=false;
    
    tipo=document.getElementById("oculto").value;
    $(buscar_datos());
}

const radioButtons = document.querySelectorAll('input[name="radio"]');
for (const radioButton of radioButtons) {
  radioButton.addEventListener('change', verSeleccion);
}

function verSeleccion(e){
    if (this.checked) {
        tipo=this.value
        $(buscar_datos());
    }
}

function buscar_datos(consulta){
    console.log(consulta)
    console.log(tipo)
    $.ajax({
        url: '../../controller/administrativo/Mostrar_Servicios.php',
        type: 'POST',
        dataType: 'html',
        data: { consulta: consulta,  tipo:tipo},
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

$(document).on('keyup', '#busqueda', function (){
    var valorBusqueda = $(this).val();
    if (valorBusqueda != "") {
        buscar_datos(valorBusqueda);
    } else {
        buscar_datos();
    }
})