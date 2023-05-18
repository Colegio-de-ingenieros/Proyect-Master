function confirmacion(e){

    if (confirm("¿Está seguro que desea eliminar esta cuota?")) {
        e.preventDefault();
        var idc = $(this).data('idc');

        // Realizar la solicitud Ajax para eliminar el elemento
        $.ajax({
            //manda a llamar al php que tiene la logica para eliminar
            url: '../../controller/empresa/Eliminar_Cuotas.php', 
            type: 'GET', 
            data: {idc: idc}, 
            success: function (response)
            {
                // Procesar la respuesta del servidor en caso de éxito
                alert('Eliminado con éxito');
                // volver a la pagina de vista
                location.href = '../../view/empresa/Vista_Cuotas.html';
            },
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