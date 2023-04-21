function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar este seguimiento?")) {
        e.preventDefault();
        var clave = $(this).data('clave');
        var tipo = $(this).data('tipo');
        console.log(clave)
        console.log(tipo)

        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            //manda a llamar al php que tiene la logica para eliminar
            url: '../../controller/administrativo/Eliminar_Seguimiento.php', 
            type: 'GET', 
            data: {clave: clave, tipo: tipo}, 
            
            success: function (response)
            {
                console.log("pase")
                console.log("ya  fui")
                // Procesar la respuesta del servidor en caso de éxito
                alert('Eliminado con éxito');
                // volver a la pagina de vista
                location.href = '../../view/administrativo/Vista_Seguimiento.html';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                // psrocesar la respuesta del servidor en caso de error
                alert('Error al eliminar el elemento');
                location.href = '../../view/administrativo/Vista_Seguimiento.html';
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
