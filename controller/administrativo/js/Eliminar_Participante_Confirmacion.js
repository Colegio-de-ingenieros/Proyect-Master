function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar este participante?")) {
        e.preventDefault();
        var participante = $(this).data('idp');
        $.ajax({
            url: '../../controller/administrativo/Eliminar_Participante.php', 
            type: 'GET', 
            data: {participante: participante}, 
            
            success: function (response)
            {

                alert('Eliminado con éxito');

                location.href = '../../view/administrativo/Accion_Seguimiento.html';
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
