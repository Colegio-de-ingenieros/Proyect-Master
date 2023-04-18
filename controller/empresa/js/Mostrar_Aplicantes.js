$(buscar_datos());

//console.log(producto);
function buscar_datos(consulta){
    const valores = window.location.search;
    //console.log(valores);
    const urlParams = new URLSearchParams(valores);
    //Accedemos a los valores
    var producto = urlParams.get('id');
    //console.log(producto);
    $.ajax({
        url: '../../controller/empresa/Mostrar_Aplicante.php?id='+producto,
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