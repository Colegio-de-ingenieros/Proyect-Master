function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar este curso?")) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id);
        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            //manda a llamar al php que tiene la logica para eliminar
            url: '../../administrativo/controller/Eliminar_Cursos.php', 
            type: 'GET', 
            data: {id: id}, 
            success: function (response)
            {
                // Procesar la respuesta del servidor en caso de éxito
                alert('Eliminado con éxito');
                // volver a la pagina de vista
                location.href = '../../view/administrativo/Vista_Cursos.php';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // psrocesar la respuesta del servidor en caso de error
                alert('Error, el curso no puede ser eliminado porque tiene un seguimiento');
                location.href = '../../view/administrativo/Vista_Cursos.php';
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
