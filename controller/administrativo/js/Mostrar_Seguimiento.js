$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        url: '../../controller/administrativo/Mostrar_Seguimiento.php',
        type: 'POST',
        dataType: 'html',
        data: { consulta: consulta },
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


/* const radioButtons = document.querySelectorAll('input[name="radio"]');
for (const radioButton of radioButtons) {
  radioButton.addEventListener('change', verSeleccion);
}

function verSeleccion(e) {
  if (this.checked) {
    let tipo=this.value
    //console.log(this.value)
    let url = '../../controller/administrativo/Mostrar_Seguimiento.php';

    let form = new FormData();
    form.append("tipo", tipo);

    fetch(url, {
      method: "POST",
      body: form
    })
        .then(response => response.json())
        .then(data => {
          console.log(data)
      })
  }
} */