$(buscar_datos());

function buscar_datos(consulta){
    const valores = window.location.search;
    const urlParams = new URLSearchParams(valores);
    //Accedemos a los valores
    var producto = urlParams.get('id');
    $.ajax({        
        url: '../../controller/administrativo/Mostrar_Cursos_SocioAsociado.php?id='+producto,
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