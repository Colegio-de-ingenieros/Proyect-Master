function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar este proyecto?")) {
        e.preventDefault();
        var idp = $(this).data('idp');

        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            //manda a llamar al php que tiene la logica para eliminar
            url: '../../controller/administrativo/Eliminar_Proyectos.php', 
            type: 'GET', 
            data: {idp: idp}, 
            success: function (response)
            {
                // Procesar la respuesta del servidor en caso de éxito
                alert('Eliminado con éxito');
                // volver a la pagina de vista
                location.href = '../../view/administrativo/Vista_Proyectos.html';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // psrocesar la respuesta del servidor en caso de error
                alert('Error, el proyecto no puede ser eliminado porque tiene un seguimiento');
                location.href = '../../view/administrativo/Vista_Proyectos.html';
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
