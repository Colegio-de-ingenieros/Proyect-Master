function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar esta certificación? Tenga en cuenta que si ya hay un seguimiento existente, la certificación no será eliminada totalmente, y en su lugar su estatus cambiará de 1 a 0")) {
        
        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            //manda a llamar al php que tiene la logica para eliminar
            url: '../../controller/administrativo/Eliminar_Certificaciones.php', 
            type: 'GET', 
            data: {}, 
            success: function (response)
            {
                // Procesar la respuesta del servidor en caso de éxito
                alert('Eliminado con éxito');
                // volver a la pagina de vista
                location.href = '../../view/administrativo/Vista_Certificaciones.php';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // psrocesar la respuesta del servidor en caso de error
                alert('Error al eliminar el elemento: ' + textStatus);
            }
        });


    } else {
        e.preventDefault();
    }
}
let linkDelete = document.querySelectorAll(".table_item__link");

for (var i = 0; i < linkDelete.length; i++) {
    linkDelete[i].addEventListener('click', confirmacion);
}

//alert("si entra al js");