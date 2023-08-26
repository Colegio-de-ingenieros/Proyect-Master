$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        url: '../../controller/socio-asociado/Mostrar_Datos_Perfil_Personal.php',
        type: 'POST',
        dataType: 'html',
        data: { consulta: consulta },
    })

        .done(function (respuesta)
        {
            $("#contenedor_tabla").html(respuesta);
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