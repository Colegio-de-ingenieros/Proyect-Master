function confirmacion(e){
    var tipo = $(this).data('tipo');

    if (confirm("¿Está seguro que desea eliminar este "+ tipo + "?")) {
        e.preventDefault();
        var participante= $(this).data('participante');
        var actividad = $(this).data('actividad');
        
        console.log(participante)
        console.log(actividad)
        console.log(tipo)

        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            url: '../../controller/administrativo/Eliminar_Gasto_Ingreso.php', 
            type: 'GET', 
            data: {participante: participante, actividad: actividad, tipo: tipo}, 
            
            success: function (response)
            {
               
                // Procesar la respuesta del servidor en caso de éxito
                alert('Eliminado con éxito');
                // volver a la pagina de vista
                location.href = '../../view/administrativo/Accion_Participante.html';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // psrocesar la respuesta del servidor en caso de error
                alert('Error al eliminar el elemento');
                location.href = '../../view/administrativo/Accion_Participante.html';
            }
        });

    } else {
        e.preventDefault();
    }
}
var linkDelete = document.querySelectorAll(".table_item__link");

for (var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click', confirmacion);
}