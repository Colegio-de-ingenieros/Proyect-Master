/* let tipo;
window.onload = function () {
    document.getElementById("radio_ingreso").checked=false;
    document.getElementById("egreso").checked=false;
    tipo="egreso";
    $(buscar_datos());
}

const radioButtons = document.querySelectorAll('input[name="radio"]');
for (const radioButton of radioButtons) {
  radioButton.addEventListener('change', verSeleccion);
  
}

function verSeleccion(e){
    if (this.checked) {
        tipo=this.value
        console.log(tipo);
        $(buscar_datos());
    }
}
function buscar_datos(consulta){
    $.ajax({
        url: '../../controller/administrativo/Mostrar_Polizas.php',
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
}) */

window.onload = () => {
  const ingreso = document.getElementById("radio_ingreso");
  const egreso = document.getElementById("egreso");
  let tipo;
  
  ingreso.addEventListener("click", function () {
    tipo="ingreso";
  });

  egreso.addEventListener("click", function () {
    tipo="egreso";
  });
};
