function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar este participante?")) {
        e.preventDefault();
        var participante = $(this).data('participante');
        var actividad = $(this).data('actividad');

        $.ajax({
            url: '../../controller/administrativo/Eliminar_Participante.php', 
            type: 'GET', 
            data: {participante: participante}, 
            
            success: function (response)
            {
                alert("Eliminado con éxito");
                window.location.href='../../view/administrativo/Accion_Seguimiento.html?actividad='+actividad;

                //location.href = "../../view/administrativo/Accion_Seguimiento.html?actividad='.$actividad.'";
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
     
                alert('Error al eliminar el elemento');
                location.href = '../../view/administrativo/Accion_Seguimiento.html';
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



