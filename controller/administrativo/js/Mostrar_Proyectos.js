$(buscar_datos());

function buscar_datos(consulta){
    $.ajax({
        url: '../../controller/administrativo/Mostrar_Proyectos.php',
        type: 'POST',
        dataType: 'html',
        data: { consulta: consulta },
    })

        .done(function (respuesta){
            $("#tablaResultado").html(respuesta);
        })
        .fail(function (){
            console.log("error");
        })
}