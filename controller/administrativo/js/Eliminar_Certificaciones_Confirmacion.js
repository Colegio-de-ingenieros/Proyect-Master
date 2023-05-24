function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar esta certificación?")) {
        e.preventDefault();
        var idc = $(this).data('idc');

        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            //manda a llamar al php que tiene la logica para eliminar
            url: '../../controller/administrativo/Eliminar_Certificaciones.php', 
            type: 'GET', 
            data: {idc: idc}, 
            success: function (response){
                // Procesar la respuesta del servidor en caso de éxito
                alert('Eliminado con éxito');
                // volver a la pagina de vista
                location.href = '../../view/administrativo/Vista_Certificaciones.html';
            },
            error: function (jqXHR, textStatus, errorThrown){

                if (errorThrown == 'Forbidden') {
                //la certificacion tiene un seguimiento
                alert('Error, la certificación no puede ser eliminada porque tiene un seguimiento');
                }

                else if (errorThrown == 'Method Not Allowed') {
                    //la certificacion esta relacionada con instructores
                    alert('Error, la certificación no puede ser eliminada porque está relacionada con uno o más instructores');
                }

                else {
                    console.log(errorThrown)
                }
                
                location.href = '../../view/administrativo/Vista_Certificaciones.html';
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

//alert("si entra al js");